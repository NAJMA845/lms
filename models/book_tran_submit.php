<?php
include_once("../config/config.php");

if(isset($_POST)){
    $copyId= $_POST['bookNo'];
    $membershipNo= $_POST['membershipNo'];
    $currentDate=date('Y-m-d H:i:s');

    $sql = "SELECT id,borrowed_date, returned_date 
            FROM book_tran 
            WHERE copy_id = ? 
            ORDER BY created_at 
            LIMIT 1";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $copyId);
    $stmt->execute();
    $result = $stmt->get_result();

    $borrowed_date=null;
    $returned_date=null;

    $status="";
    $info="";

    if ($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $borrowed_date = $row["borrowed_date"] ?? null;
        $returned_date = $row["returned_date"] ?? null;
        //Already borrowed, now returning
        if(is_null($returned_date)) {
           returnBook($id,$copyId,$membershipNo,$currentDate,$conn);
        }
        //Already returned, so now borrowing
        else{
            borrowBook($copyId,$membershipNo,$currentDate,$conn);
        }

    } else {
        borrowBook($copyId,$membershipNo,$currentDate,$conn);
    }
}
function returnBook($id,$copyId,$membershipNo,$currentDate,$conn){

    $conn->begin_transaction(); // Start transaction
    try {
        $sql = "
            update book_tran 
            set returned_date=?,updated_at=?
            where id=? 
            ";
        $stmt1 = $conn->prepare($sql);
        $stmt1->bind_param("ssi", $currentDate, $currentDate, $id);
        $stmt1->execute();

        $sql = "update book_copies
        set status='Available'
        where copy_no=?";
        $stmt2 = $conn->prepare($sql);
        $stmt2->bind_param("s", $copyId);
        $stmt2->execute();

        $conn->commit();
        $status = "success";
        $info = "Returned successfully!";
        echo json_encode([
            "status" => $status,
            "info" => $info
        ]);
    } catch (Exception $e) {
        $conn->rollback();
        $status = "error";
        $info = "Error when updating. Check the log!";
        echo json_encode([
            "status" => $status,
            "info" => $info
        ]);
    } finally {
    // Close the prepared statements
    $stmt1->close();
    $stmt2->close();
    }
}

function borrowBook($copyId, $membershipNo, $currentDate, $conn) {
    if (empty($membershipNo)) {
        echo json_encode(["status" => "error", "info" => "Membership No required for borrowing."]);
        return;
    }
    //Check membership no
    $query = "SELECT id FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $membershipNo);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$row = $result->fetch_assoc()) {
        echo json_encode(["status" => "error", "info" => "Invalid Membership ID."]);
        return;
    }
    // Check if the user is blocked
    $query = "SELECT is_blocked, subscription_active FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $membershipNo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if ($row['is_blocked'] == 1) {
            echo json_encode(["status" => "error", "info" => "Member is blocked, cannot borrow."]);
            return;
        }
        if ($row['subscription_active'] == 0) {
            echo json_encode(["status" => "error", "info" => "Subscription expired. Renew your subscription."]);
            return;
        }
    } else {
        echo json_encode(["status" => "error", "info" => "Invalid Membership No."]);
        return;
    }

    // Fetch book_guid for the copy_id
    $query = "SELECT book_guid FROM book_copies WHERE copy_no = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $copyId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $bookGuid = $row['book_guid'];
    } else {
        echo json_encode(["status" => "error", "info" => "Invalid Copy ID."]);
        return;
    }

    // Check if all copies of this book_guid are reserved on the borrowing date
    $query = "SELECT COUNT(*) AS reserved_count 
              FROM book_reservations 
              WHERE book_guid = ? AND reservation_date = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $bookGuid, $currentDate);
    $stmt->execute();
    $result = $stmt->get_result();
    $reservedCount = 0;

    if ($row = $result->fetch_assoc()) {
        $reservedCount = $row['reserved_count'];
    }

    // Check total available copies for this book_guid
    $query = "SELECT COUNT(*) AS available_count 
              FROM book_copies 
              WHERE book_guid = ? AND status = 'Available'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $bookGuid);
    $stmt->execute();
    $result = $stmt->get_result();
    $availableCount = 0;

    if ($row = $result->fetch_assoc()) {
        $availableCount = $row['available_count'];
    }

    // If all available copies are reserved, deny borrowing
    if ($availableCount <= $reservedCount) {
        echo json_encode(["status" => "error", "info" => "All available copies are reserved for today. Cannot borrow."]);
        return;
    }

    // Check if the member already has an unreturned book with the same book_guid
    $query = "SELECT COUNT(*) AS borrowed_count 
              FROM book_tran 
              JOIN book_copies ON book_tran.copy_id = book_copies.copy_no 
              WHERE book_tran.member_id = ? 
                AND book_copies.book_guid = ? 
                AND book_tran.returned_date IS NULL";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $membershipNo, $bookGuid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if ($row['borrowed_count'] > 0) {
            echo json_encode(["status" => "error", "info" => "Cannot borrow another copy of the same book without returning the previous one."]);
            return;
        }
    }

    // Check if the member has already borrowed 2 books
    $query = "SELECT COUNT(*) AS borrowed_count FROM book_tran WHERE member_id = ? AND returned_date IS NULL";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $membershipNo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if ($row['borrowed_count'] >= 2) {
            echo json_encode(["status" => "error", "info" => "Already borrowed up to maximum. Return books before borrowing."]);
            return;
        }
    }

    $conn->begin_transaction(); // Start transaction
    try {
        // Insert borrowing record
        $sql = "INSERT INTO book_tran (copy_id, member_id, borrowed_date, created_at, updated_at) VALUES (?, ?, ?, ?, ?)";
        $stmt1 = $conn->prepare($sql);
        $stmt1->bind_param("sssss", $copyId, $membershipNo, $currentDate, $currentDate, $currentDate);
        $stmt1->execute();

        $sql = "update book_copies
        set status='Unavailable'
        where copy_no=?";
        $stmt2 = $conn->prepare($sql);
        $stmt2->bind_param("s", $copyId);
        $stmt2->execute();
        // Commit the transaction if both queries succeed
        $conn->commit();
        echo json_encode(["status" => "success", "info" => "Borrowed successfully!"]);
     } catch (Exception $e) {
    // Rollback the transaction if any query fails
        $conn->rollback();
        echo json_encode(["status" => "error", "info" => "Error when updating. Check the log!"]);
    } finally {
        // Close the prepared statements
        $stmt1->close();
        $stmt2->close();
    }
}
?>