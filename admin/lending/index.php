<?php 
include_once("../../config/config.php");
include_once("../../include/header.php");
include_once("../../include/topbar.php");
include_once("../../include/sidebar.php");
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
                                        <th scope="col">Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Replace with dynamic rows as needed -->
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Copy ID 1</td>
                                        <td>Book Title 1</td>
                                        <td>5056</td>
                                        <td>01-01-2024</td>
                                        <td>01-02-2024</td>
                                        <td><span class="badge text-bg-danger">Overdue</span></td>
                                        <td>01-01-2024 10:00 AM</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Copy ID 2</td>
                                        <td>Book Title 1</td>
                                        <td>0241</td>
                                        <td>02-01-2024</td>
                                        <td>01-02-2024</td>
                                        <td><span class="badge text-bg-success">Returned</span></td>
                                        <td>02-01-2024 11:00 AM</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Copy ID 1</td>
                                        <td>Book Title 2</td>
                                        <td>7926</td>
                                        <td>02-01-2024</td>
                                        <td>02-02-2024</td>
                                        <td><span class="badge text-bg-success">Returned</span></td>
                                        <td>02-01-2024 02:00 PM</td>
                                    </tr>
                                    <!-- Add more rows as needed -->
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

<?php include_once("../../include/footer.php")?>










