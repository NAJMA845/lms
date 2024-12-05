<?php
include_once("../../config/utility.php");

//store book
function storeBook($conn, $param)
{


    $guid=generateGUID();
    $pdf_name=null;
    if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] == 0) {
        // Specify the directory to store the uploaded file
        $upload_dir = '../../resources/';
        // Generate a unique file name
        $pdf_name = uniqid() . '_' . basename($_FILES['pdf']['name']);
        $pdf_path = $upload_dir . $pdf_name;

        // Check if the file is a PDF
        $file_type = mime_content_type($_FILES['pdf']['tmp_name']);
        if ($file_type !== 'application/pdf') {
            echo "Please upload a valid PDF file.";
            exit;
        }

        // Move the file to the specified directory
        if (!move_uploaded_file($_FILES['pdf']['tmp_name'], $pdf_path)) {
            echo "File upload failed.";
            exit;
        }
    }
    extract($param);
     ## Validation start
     if (empty($title)) {
        $result = array("error" => "Title is required");
        return $result;
    } else if (empty($isbn)) {
        $result = array("error" => "ISBN is required");
        return $result;
    } else if (isIsbnUnique($conn, $isbn)) {
        $result = array("error" => "ISBN is already registered");
        return $result;
    }

    
    ## Validation end

    $datetime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO books (guid,title, author, publication_year, isbn, category_id, created_at,pdf_url)
        VALUES ('$guid','$title', '$author', '$publication_year', '$isbn', $category_id, '$datetime','$pdf_name')";
        $result['success']=$conn->query($sql);

    $sql = "INSERT INTO book_copies (book_guid,copy_no) VALUES";   
    foreach ($param['copies'] as $copy) {
        
        $sql.= "('$guid','$copy'),";
    }
    if (strlen($sql) > 2) {
        $sql = substr($sql, 0, -1);
        $result['success']=$conn->query($sql);
    }
    
    return $result;
}

//update book
function updateBookByGUID($conn, $param)
{
    $pdf_name=null;
    if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] == 0) {
        // Specify the directory to store the uploaded file
        $upload_dir = '../../resources/';
        // Generate a unique file name
        $pdf_name = uniqid() . '_' . basename($_FILES['pdf']['name']);
        $pdf_path = $upload_dir . $pdf_name;

        // Check if the file is a PDF
        $file_type = mime_content_type($_FILES['pdf']['tmp_name']);
        if ($file_type !== 'application/pdf') {
            echo "Please upload a valid PDF file.";
            exit;
        }

        // Move the file to the specified directory
        if (!move_uploaded_file($_FILES['pdf']['tmp_name'], $pdf_path)) {
            echo "File upload failed.";
            exit;
        }
    }
    extract($param);

    ## Validation start
    if (empty($title)) {
        $result = array("error" => "Title is required");
        return $result;
    } else if (empty($isbn)) {
        $result = array("error" => "ISBN is required");
        return $result;
    } else if (isIsbnUnique($conn, $isbn)) {
        $result = array("error" => "ISBN is already registered");
        return $result;
    }
    ## Validation end
    $datetime = date("Y-m-d H:i:s");
    if($pdf_name){
        $sql = "update books 
        set title='$title',
            author='$author', 
            publication_year='$publication_year', 
            isbn='$isbn', 
            category_id='$category_id', 
            updated_at='$datetime',
            pdf_url= '$pdf_name'
        where guid='$guid'";
    }
    else{
        $sql = "update books 
        set title='$title',
        author='$author', 
        publication_year='$publication_year', 
        isbn='$isbn', 
        category_id='$category_id', 
        updated_at='$datetime'
    where guid='$guid'";
    }
    
    $result['success'] = $conn->query($sql);
    return $result;
}

//get all books
function getBooks($conn)
{
    $sql = "select b.*, c.name as cat_name from books b 
        left join categories c on c.id = b.category_id 
        order by id desc";
    $result = $conn->query($sql);
    return $result;
}

//get a book by GUID
function getBookByGUID($conn,$guid)
{
    $sql = "select * from books b where b.guid='$guid'";
    $result = $conn->query($sql);
    return $result;
}

//get a book by GUID
function getBookCopiesByGUID($conn,$guid)
{
    $sql = "select * from book_copies b where book_guid='$guid'";

    $result = $conn->query($sql);
    return $result;
}

//delete a book by GUID
function deleteBookByGUID($conn,$param)
{
    extract($param);
    $sql = "delete from books where guid='$guid';";
    $result['success'] = $conn->query($sql);
    return $result;
}

//Function to get categories
function getCategories($conn){
    $sql = "select id, name from categories";
    $result = $conn->query($sql);
    return $result;
}

// Function to check isbn no
function isIsbnUnique($conn, $isbn, $id = NULL)
{
    $sql = "select id from books where isbn = '$isbn'";
    if ($id) {
        $sql .= " and id != $id";
    }
    $result = $conn->query($sql);
    if ($result->num_rows > 1)
        return true;
    else return false;
}