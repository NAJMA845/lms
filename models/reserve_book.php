<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/utility.php");

//store book
function storeReserveBook($conn, $param)
{
    $guid = generateGUID();
    extract($param);
    $datetime = date("Y-m-d H:i:s");
    ## Validation start
    if (empty($membershipNo)) {
        return array("error" => "Membership No is required");
    } elseif (empty($reservedOn)) {
        return array("error" => "Reservation date is required");
    } elseif (empty($copyNo)) { // Fixed: Ensure consistency with form field names
        return array("error" => "Book No is required");
    }

    // Get GUID of book copy
    $bookSQL = "SELECT book_guid FROM book_copies 
                 WHERE copy_no = ?";
    $stmt = $conn->prepare($bookSQL);
    $stmt->bind_param("s", $copyNo);
    $stmt->execute();
    $result = $stmt->get_result();

    $book = [];
    while ($row = $result->fetch_assoc()) {
        $book[] = $row['book_guid'];
    }
    $stmt->close();
    $bookGuid=$book[0];
    // Get total number of copies for this book_guid
    $copyCountSQL = "SELECT COUNT(*) as total_copies FROM book_copies WHERE book_guid = ?";
    $stmt = $conn->prepare($copyCountSQL);
    $stmt->bind_param("s", $bookGuid);
    $stmt->execute();
    $result = $stmt->get_result();
    $copyData = $result->fetch_assoc();
    $totalCopies = $copyData['total_copies'];
    $stmt->close();

    // Count how many reservations exist for this book_guid on the given date
    $reservationCountSQL = "SELECT COUNT(*) as reserved_count FROM book_reservation WHERE book_guid = ? AND reservation_date = ?";
    $stmt = $conn->prepare($reservationCountSQL);
    $stmt->bind_param("ss", $bookGuid, $reservedOn);
    $stmt->execute();
    $result = $stmt->get_result();
    $reservationData = $result->fetch_assoc();
    $reservedCount = $reservationData['reserved_count'];
    $stmt->close();

    // Check if reservation count exceeds available copies
    if ($reservedCount >= $totalCopies) {
        return array("error" => "All copies of this book are already reserved for the selected date.");
    }


    // Check existing reservations for the member
    $sqlCheck = "SELECT created_at FROM book_reservation 
                 WHERE member_id = ? 
                 ORDER BY created_at DESC";
    $stmt = $conn->prepare($sqlCheck);
    $stmt->bind_param("s", $membershipNo);
    $stmt->execute();
    $result = $stmt->get_result();

    $reservations = [];
    while ($row = $result->fetch_assoc()) {
        $reservations[] = $row['created_at'];
    }
    $stmt->close();

    // Validation: Max 2 reservations allowed
    if (count($reservations) >= 2) {


        // Check if the last reservation was made within the last 30 days
        $lastReservationDate = new DateTime($reservations[0]); // Most recent reservation
        $currentDate = new DateTime($datetime);
        $interval = $lastReservationDate->diff($currentDate)->days;
        if ($interval < 14) {
            return array("error" => "You already have 2 active reservations. You can make a new reservation after 14 days from your last reservation.");
        }
    }

    // Insert reservation
    $sqlInsert = "INSERT INTO book_reservation (guid, book_guid, member_id, copy_no, reservation_date) 
                  VALUES (?, ?, ?, ?,?)";
    $stmt = $conn->prepare($sqlInsert);
    $stmt->bind_param("sssss", $guid, $bookGuid, $membershipNo, $copyNo, $reservedOn);
    $success = $stmt->execute();
    $stmt->close();

    if ($success) {
        return array("success" => "Book reservation successfully made.");
    } else {
        return array("error" => "Something went wrong, please try again.");
    }
}

//get all books
function getAllReservations($conn)
{
    $sql = "SELECT br.guid,b.title,b.isbn,b.author,reservation_date,br.member_id
            FROM book_reservation br JOIN books b
            ON br.book_guid=b.guid 
            ORDER BY reservation_date";
    $result = $conn->query($sql);
    return $result;
}

function getAllReservationsBylimit($conn,$keyword)
{
    if($keyword=='')
        $sql = "SELECT br.guid,b.title,b.isbn,b.author,reservation_date,br.member_id
                FROM book_reservation br JOIN books b
                ON br.book_guid=b.guid 
                ORDER BY reservation_date
                limit 100";
    else
        $sql = "SELECT br.guid,b.title,b.isbn,b.author,reservation_date,br.member_id
                FROM book_reservation br JOIN books b
                ON br.book_guid=b.guid 
                where reservation_date='$keyword'
                ORDER BY reservation_date
                limit 100";
    $result = $conn->query($sql);
    return $result;
}