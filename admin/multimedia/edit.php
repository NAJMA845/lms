<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/config.php");
//include_once("../../config/database.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/models/book.php");


//-----------------------Book edit POST---------------------------//
if (isset($_POST['publish'])) {
    $res = updateBookByGUID($conn, $_POST);
    if (isset($res['success'])) {
        $_SESSION['success'] = "Book has been edited Successfully";
        header("LOCATION:".ADMIN_BASE_URL."books");
    } else {
        $_SESSION['error'] = $res["error"];//"Something went wrong, please try again.";
        //header("LOCATION:" . BASE_URL . "books/add.php");
    }
}
//---------------------------------------------------------------//
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/header.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/topbar.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/sidebar.php");

$bookName='';
$isbn='';
$author='';
$publicationYear='';
$category='';

$guid=$_SERVER['QUERY_STRING'];
$book = getBookByGUID($conn,$guid);
if (!isset($book->num_rows)) {
    $_SESSION['error'] = "Error: " . $conn->error;
}

if ($book->num_rows > 0) {
    while ($row = $book->fetch_assoc()) {
        $bookName=$row['title'];
        $isbn=$row['isbn'];
        $author=$row['author'];
        $publicationYear=$row['publication_year'];
        $category= $row['category_id'];
    }
}

$book_copies = getBookCopiesByGUID($conn,$guid);
?>

        <!--main content start-->
        <main class="mt-1 pt-3">
            <div class="container-fluid">
                <!--Cards-->
                <div class="row dashboard-counts">
                    <div class="col-md-12">
                    <?php include_once("../../include/alerts.php"); ?>
                       <h4 class="fw-bold text-uppercase"> Edit Book </h4>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                              Add book content
                            </div>
                                    <div class="card-body">
                                        <form method="post" action="<?php echo ADMIN_BASE_URL?>books/edit.php"  enctype="multipart/form-data">
                                            <input type="hidden" name="guid" value="<?php echo $guid ?>" />
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="title">Book Name</label>
                                                        <input type="text" name="title" id="title"
                                                         class="form-control"  title="Enter the title"
                                                        value="<?php echo $bookName ?>"/>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="isbn" class="form-label">ISBN Number</label>
                                                        <input type="text" name="isbn" id="isbn" class="form-control" 
                                                        required="required" title="Enter the ISBN number"
                                                               value="<?php echo $isbn ?>"/>
                                                        
                                                    </div>
                                                </div>
                        
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="author" class="form-label">Author Name</label>
                                                        <input type="text" name="author" id="author" 
                                                        class="form-control" required title="Enter the author's name"
                                                               value="<?php echo $author ?>"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="category_id" class="form-label">Category</label>
                                                        <?php
                                                        $cats = getCategories($conn);
                                                        ?>
                                                        <select name="category_id" id="category_id"
                                                                class="form-control" required title="Select the category of the item">
                                                            <option value="">Please select</option>
                                                            <?php while ($row = $cats->fetch_assoc()) {
                                                                // Check if the current category matches the desired value
                                                                $selected = ($row['id'] == $category) ? 'selected' : '';
                                                                ?>
                                                                <option value="<?php echo $row['id'] ?>" <?php echo $selected; ?>>
                                                                    <?php echo $row['name']; ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="publication_year" class="form-label">Published Year</label>
                                                        <input type="text" name="publication_year" id="publication_year"
                                                               class="form-control" required title="Enter the published year"
                                                               value="<?php echo $publicationYear ?>"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="category_id" class="form-label">Upload PDF</label>
                                                        <?php 
                                                        $cats = getCategories($conn);
                                                       ?>
                                                       <br>
                                                            <input type="file" name="pdf" id="pdf" accept="application/pdf">
                                                            
                                                    </div>
                                                </div>

    <!-- <grid> -->
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mt-4">Book Copies</h5>
            <button  type="button" class="btn btn-primary btn-sm right" onclick="addRow('<?php echo $guid; ?>');">Add Copy</button>
        </div>
                                    <table class="table table-bordered" id="copiesTable">
                                        <thead>
                                            <tr>
                                                <th>Copy Number</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        if ($book_copies->num_rows > 0) {
                                            while ($row = $book_copies->fetch_assoc()) {
                                                $book_guid=$row['book_guid'];
                                                $copy_no=$row['copy_no'];
                                                ?>
                                            <tr>
                                                <td><input readonly guid="<?php echo  $book_guid;?>" copy_no="<?php echo $copy_no;?>" type="text" class="form-control" name="copies[]" value="<?php echo $copy_no;?>"></td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" onclick="toggleEdit(this)">Edit</button>
                                                    <button type="button" class="btn btn-danger" onclick="showDeleteConfirmation(this)">Delete</button>
                                                </td>
                                            </tr>
                                        <?php
                                            }
                                        }
                                        ?>

                                        </tbody>
                                    </table>

                                </div>
                                                    
                        
                                                <div class="col-md-12">
                                                    <button name="publish" type="submit" class="btn btn-success">
                                                        Publish
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
        <!--main content end-->

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/footer.php");
?>

