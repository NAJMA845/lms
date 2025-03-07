<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/utility.php");

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
        $result['guid']=$guid;

    if (isset($param['copies'])) {
        if ($param['copies']) {
            $sql = "INSERT INTO book_copies (book_guid,copy_no,created_at,updated_at) VALUES";
            foreach ($param['copies'] as $copies) {

                $sql.= "('$guid','$copies','$datetime','$datetime'),";
            }
            if (strlen($sql) > 2) {
                $sql = substr($sql, 0, -1);
                $result['success']=$conn->query($sql);
            }
        }
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
    $sql = "select b.guid,b.id,b.title,b.author,b.publication_year,b.isbn,b.status,b.pdf_url,b.category_id,c.name 
    from books b,categories c where b.category_id=c.id and b.guid='$guid'";
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

function getTotalBooks($conn)
{
    $sql = "SELECT COUNT(*) AS total_books FROM books";
    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        return $row['total_books'];
    }
    //If result has issue, return 0
    return 0;
}

//Get total borrowed books if member_id not supplied, otherwise it will get memberwise
function getTotalBorrowedBooks($conn,$user_id=null)
{
    if($user_id == null)
        $sql = "SELECT COUNT(*) AS total_books FROM book_tran where returned_date is null";
    else
        $sql = "SELECT COUNT(*) AS total_books FROM book_tran where member_id='$user_id' and returned_date is null";

    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        return $row['total_books'];
    }
    //If result has issue, return 0
    return 0;
}

function getTotalOverdueBooks($conn,$user_id=null)
{
    if($user_id == null)
        $sql = "SELECT COUNT(*) AS overdue_books
                FROM book_tran
                WHERE returned_date IS NULL 
                AND borrowed_date <= DATE_SUB(NOW(), INTERVAL 14 DAY)";
    else
        $sql = "SELECT COUNT(*) AS overdue_books
                FROM book_tran
                WHERE member_id='$user_id' and returned_date IS NULL 
                AND borrowed_date <= DATE_SUB(NOW(), INTERVAL 14 DAY)";
    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        return $row['overdue_books'];
    }
    //If result has issue, return 0
    return 0;
}