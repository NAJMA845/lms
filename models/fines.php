<?php
function getTotalFineByUser($conn,$member)
{
    $sql = "SELECT IFNULL(SUM(amount),0) AS total_fine FROM late_fees WHERE member_id=$member";
    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        return $row['total_fine'];
    }
    //If result has issue, return 0
    return 0;
}
?>