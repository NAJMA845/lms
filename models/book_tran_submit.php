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
    $sql="
            update book_tran 
            set returned_date=?,updated_at=?
            where id=? 
            ";
    $statment = $conn->prepare($sql);
    $statment->bind_param("ssi",$currentDate,$currentDate,$id);
    if($statment->execute()){
        $status="success";
        $info="Returned successfully!";
    }
    else{
        $status="error";
        $info="Error when updating. Check the log!";
    }

    echo json_encode([
        "status" => $status,
        "info" => $info
    ]);
}

function borrowBook($copyId, $membershipNo, $currentDate, $conn) {
    if (empty($membershipNo)) {
        echo json_encode(["status" => "error", "info" => "Membership No required for borrowing."]);
        return;
    }

    $query = "SELECT is_blocked FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $membershipNo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if ($row['is_blocked'] == 1) {
            echo json_encode(["status" => "error", "info" => "Member is blocked, cannot borrow."]);
            return;
        }
    } else {
        echo json_encode(["status" => "error", "info" => "Invalid Membership No."]);
        return;
    }

    // Check how many books the member has already borrowed and not returned
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

    // Check subscription
    $query = "SELECT subsciption_active FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $membershipNo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if ($row['subsciption_active'] == 0) {
            echo json_encode(["status" => "error", "info" => "Subscription is expired. Renew your subscription."]);
            return;
        }
    }

    // Insert borrowing record
    $sql = "INSERT INTO book_tran (copy_id, member_id, borrowed_date, created_at, updated_at) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $copyId, $membershipNo, $currentDate, $currentDate, $currentDate);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "info" => "Borrowed successfully!"]);
    } else {
        echo json_encode(["status" => "error", "info" => "Error when updating. Check the log!"]);
    }
}

?>