<?php 
include_once("../../config/config.php");
include_once("../../config/database.php");
include_once("../models/book.php");

## Get Books
$books = getBooks($conn);
if (!isset($books->num_rows)) {
    $_SESSION['error'] = "Error: " . $conn->error;
}
include_once("../../include/header.php");
include_once("../../include/topbar.php");
include_once("../../include/sidebar.php");
?>

<!--main content start-->
<main class="mt-1 pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php include_once("../../include/alerts.php"); ?>
                <h4 class="fw-bold text-uppercase"> Manage Books </h4>
            </div>
            <!--Cards-->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        All Books
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="data-table" class="table table-responsive table-striped" style="width:100%">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Book Name</th>
                                        <th scope="col">Publication Year</th>
                                        <th scope="col">Author Name</th>
                                        <th scope="col">ISBN No</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($books->num_rows > 0) {
                                        $i = 1;
                                        while ($row = $books->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $i++ ?></th>
                                        <td><?php echo $row['title'] ?></td>
                                        <td><?php echo $row['publication_year'] ?></td>
                                        <td><?php echo $row['author'] ?></td>
                                        <td><?php echo $row['isbn'] ?></td>
                                        <td><?php echo $row['cat_name'] ?></td>
                                        <td>
                                            <?php
                                            if ($row['status'] == 1) {
                                                echo '<span class="badge text-bg-success">Active</span>';
                                            } else {
                                                echo '<span class="badge text-bg-danger">Inactive</span>';
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo date("d-m-Y h:i A", strtotime($row['created_at'])) ?></td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm">
                                                Edit
                                            </a>
                                            <a href="#" class="btn btn-danger btn-sm">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                        }  
                                    } 
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!--main content end-->

<?php include_once("../../include/footer.php") ?>
