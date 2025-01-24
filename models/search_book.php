<?php
include_once("../config/utility.php");
//get all books
function findBooks($conn,$query)
{
    $sql = "select b.*, c.name as category from books b 
        left join categories c on c.id = b.category_id
        where b.title like '%$query%' or b.author like '%$query%' or b.isbn like '%$query%' 
        order by id desc";
    return $conn->query($sql);

}
?>