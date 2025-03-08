<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/config.php");

if(isset($_POST['bookNo']) && isset($_POST['check'])){
    $copyId=$_POST['bookNo'];
    $sql = "SELECT borrowed_date, returned_date 
            FROM book_tran 
            WHERE copy_id = ? 
            ORDER BY created_at 
            LIMIT 1";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $copyId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo json_encode([
            "borrowed_date" => $row["borrowed_date"] ?? null,
            "returned_date" => $row["returned_date"] ?? null
        ]);
    } else {
        echo json_encode([
            "borrowed_date" => null,
            "returned_date" => null
        ]);
    }
    $stmt->close();
    $conn->close();
}

function getBookTran($conn,$user_id=null)
{
    if($user_id == null)
        $sql = "SELECT 
        copy_id, 
        title,
        member_id,
        borrowed_date,
        IFNULL(returned_date, '') AS returned_date,
        CASE 
            WHEN returned_date IS NOT NULL THEN 'Returned' 
            WHEN returned_date IS NULL AND DATEDIFF(CURDATE(), borrowed_date) <= 14 THEN 'Borrowed'
            WHEN returned_date IS NULL AND DATEDIFF(CURDATE(), borrowed_date) > 14 THEN 'Overdue'
        END AS STATUS
        FROM 
            book_tran bt 
        left JOIN 
            book_copies bc ON bt.copy_id = bc.copy_no 
        left JOIN 
            books bk ON bc.book_guid = bk.guid
        order by borrowed_date desc
        ";
    else
        $sql = "SELECT 
        copy_id, 
        title,
        member_id,
        borrowed_date,
         IFNULL(returned_date, '') AS returned_date,
        CASE 
            WHEN returned_date IS NOT NULL THEN 'Returned' 
            WHEN returned_date IS NULL AND DATEDIFF(CURDATE(), borrowed_date) <= 14 THEN 'Borrowed'
            WHEN returned_date IS NULL AND DATEDIFF(CURDATE(), borrowed_date) > 14 THEN 'Overdue'
        END AS STATUS
        FROM 
            book_tran bt 
        left JOIN 
            book_copies bc ON bt.copy_id = bc.copy_no 
        left JOIN 
            books bk ON bc.book_guid = bk.guid
        where member_id='$user_id'
        order by borrowed_date desc
        ";

    $result = $conn->query($sql);
    return $result;
}

function getBookTranByLimit($conn,$user_id=null)
{
    if($user_id == null)
        $sql = "SELECT 
        copy_id, 
        title,
        member_id,
        borrowed_date,
        IFNULL(returned_date, '') AS returned_date,
        CASE 
            WHEN returned_date IS NOT NULL THEN 'Returned' 
            WHEN returned_date IS NULL AND DATEDIFF(CURDATE(), borrowed_date) <= 14 THEN 'Borrowed'
            WHEN returned_date IS NULL AND DATEDIFF(CURDATE(), borrowed_date) > 14 THEN 'Overdue'
        END AS STATUS
        FROM 
            book_tran bt 
        left JOIN 
            book_copies bc ON bt.copy_id = bc.copy_no 
        left JOIN 
            books bk ON bc.book_guid = bk.guid
        order by borrowed_date desc
        limit 100";
    else
        $sql = "SELECT 
        copy_id, 
        title,
        member_id,
        borrowed_date,
         IFNULL(returned_date, '') AS returned_date,
        CASE 
            WHEN returned_date IS NOT NULL THEN 'Returned' 
            WHEN returned_date IS NULL AND DATEDIFF(CURDATE(), borrowed_date) <= 14 THEN 'Borrowed'
            WHEN returned_date IS NULL AND DATEDIFF(CURDATE(), borrowed_date) > 14 THEN 'Overdue'
        END AS STATUS
        FROM 
            book_tran bt 
        left JOIN 
            book_copies bc ON bt.copy_id = bc.copy_no 
        left JOIN 
            books bk ON bc.book_guid = bk.guid
        where member_id='$user_id'
        order by borrowed_date desc 
        limit 100";

    $result = $conn->query($sql);
    return $result;
}

function getBookTranByFilter($conn,$filter)
{
    if($filter == 'overdue')
        $sql = "SELECT 
        copy_id, 
        title,
        member_id,
        borrowed_date,
        IFNULL(returned_date, '') AS returned_date,
        CASE 
            WHEN returned_date IS NOT NULL THEN 'Returned' 
            WHEN returned_date IS NULL AND DATEDIFF(CURDATE(), borrowed_date) <= 14 THEN 'Borrowed'
            WHEN returned_date IS NULL AND DATEDIFF(CURDATE(), borrowed_date) > 14 THEN 'Overdue'
        END AS STATUS
        FROM 
            book_tran bt 
        left JOIN 
            book_copies bc ON bt.copy_id = bc.copy_no 
        left JOIN 
            books bk ON bc.book_guid = bk.guid
        having STATUS='Overdue'
        order by borrowed_date desc
        limit 100";
    else if($filter=='borrowed')
        $sql = "SELECT 
        copy_id, 
        title,
        member_id,
        borrowed_date,
         IFNULL(returned_date, '') AS returned_date,
        CASE 
            WHEN returned_date IS NOT NULL THEN 'Returned' 
            WHEN returned_date IS NULL AND DATEDIFF(CURDATE(), borrowed_date) <= 14 THEN 'Borrowed'
            WHEN returned_date IS NULL AND DATEDIFF(CURDATE(), borrowed_date) > 14 THEN 'Overdue'
        END AS STATUS
        FROM 
            book_tran bt 
        left JOIN 
            book_copies bc ON bt.copy_id = bc.copy_no 
        left JOIN 
            books bk ON bc.book_guid = bk.guid
        having STATUS='Borrowed'
        order by borrowed_date desc
        limit 100";

    $result = $conn->query($sql);
    return $result;
}
?>