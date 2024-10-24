<?php
include_once("../../config/database.php");
include_once("../models/book.php");
include_once("../../config/config.php");

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
include_once("../../include/header.php");
include_once("../../include/topbar.php");
include_once("../../include/sidebar.php");

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
                              Fill the form
                            </div>
                                    <div class="card-body">
                                        <form method="post" action="<?php echo ADMIN_BASE_URL?>books/edit.php">
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
                                                        <label for="publication_year" class="form-label">Publication Year</label>
                                                        <input type="number" name="publication_year" id="publication_year" 
                                                        class="form-control" required title="Enter the year of publication"
                                                               value="<?php echo $publicationYear ?>"/>

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
                                                                <?php
                                                                while ($row = $cats->fetch_assoc()) {
                                                                    if($row['id']==$category){
                                                                        echo "<option value=".$row['id']." selected >".$row['name']."</option>";
                                                                    }
                                                                    else{
                                                                        echo "<option value=".$row['id'].">".$row['name']."</option>";
                                                                    }
                                                                    } ?>
                                                            </select>
                                                    </div>
                                                </div>

                                                    
                        
                                                <div class="col-md-12">
                                                    <button name="publish" type="submit" class="btn btn-success">
                                                        Publish
                                                    </button>
                        
                                                    <button type="reset" class="btn btn-secondary">
                                                        Cancel
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
include_once("../../include/footer.php");
?>

