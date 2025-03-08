<?php 
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/config.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/models/book_tran.php");
if(isset($_GET['filter'])){
    $book_trans = getBookTranByFilter($conn,$_GET['filter']);
}
else{
    $book_trans = getBookTranByLimit($conn);
}

if (!isset($book_trans->num_rows)) {
    $_SESSION['error'] = "Error: " . $conn->error;
}
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/header.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/topbar.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/sidebar.php");
?>

<!--Main content start-->
<main class="mt-1 pt-3">
    <div class="container-fluid">
        <!--Cards-->
        <div class="row dashboard-counts">
            <div class="col-md-12">
                <?php include_once("../../include/alerts.php"); ?>
                <h4 class="fw-bold text-uppercase">View All Borrowing</h4>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        All Books Loan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="data-table" class="table table-responsive table-striped" style="width:100%">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Copy ID</th>
                                        <th scope="col">Book Name</th>
                                        <th scope="col">Membership Number</th>
                                        <th scope="col">Loan Date</th>
                                        <th scope="col">Return Date</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($book_trans->num_rows > 0) {
                                    $i = 1;
                                    while ($row = $book_trans->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $i++ ?></th>
                                            <td><?php echo $row['copy_id'] ?></td>
                                            <td><?php echo $row['title'] ?></td>
                                            <td><?php echo $row['member_id'] ?></td>
                                            <td><?php echo $row['borrowed_date'] ?></td>
                                            <td><?php echo $row['returned_date'] ?></td>
                                            <?php
                                            if($row['STATUS']=="Borrowed"){
                                                echo '<td class="text-bg-info">Borrowed</td>';
                                            }else if (($row['STATUS']=="Returned")){
                                                echo '<td class="text-bg-success">Returned</td>';
                                            }
                                            else{
                                                echo '<td class="text-bg-danger">Overdue</td>';
                                            }
                                            ?>

                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>No transaction found.</td></tr>";
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
<!--Main content end-->

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/footer.php")?>










