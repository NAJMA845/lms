<?php
include_once("../config/utility.php");

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
    $stmt->close(); // Close statement after fetching results

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
    $stmt->close(); // Close statement after fetching results

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
    $stmt->bind_param("sssss", $guid, $book[0], $membershipNo, $copyNo, $reservedOn);
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
    $sql = "SELECT br.guid,b.title,b.isbn,b.author,reservation_date 
            FROM book_reservation br JOIN books b
            ON br.book_guid=b.guid 
            ORDER BY reservation_date";
    $result = $conn->query($sql);
    return $result;
}