<?php 
include_once("../config/config.php");
include_once(DIR_URL . "include/header.php");
include_once(DIR_URL . "include/topbar.php");
include_once(DIR_URL . "include/sidebar.php");
?>

<!--Main content start-->
<main class="mt-1 pt-3">
    <div class="container-fluid">
        <!--Cards-->
        <div class="row dashboard-counts">
            <div class="col-md-12">
                <h4 class="fw-bold text-uppercase">Manage Books Loan</h4>
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
                                        <th scope="col">Book Name</th>
                                        <th scope="col">Student Name</th>
                                        <th scope="col">Loan Date</th>
                                        <th scope="col">Return Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Replace with dynamic rows as needed -->
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Book Title 1</td>
                                        <td>Student Name 1</td>
                                        <td>01-01-2024</td>
                                        <td>01-02-2024</td>
                                        <td><span class="badge text-bg-warning">Active</span></td>
                                        <td>01-01-2024 10:00 AM</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                            <a href="#" class="btn btn-success btn-sm">Returned</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Book Title 2</td>
                                        <td>Student Name 2</td>
                                        <td>02-01-2024</td>
                                        <td>02-02-2024</td>
                                        <td><span class="badge text-bg-success">Returned</span></td>
                                        <td>02-01-2024 11:00 AM</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                        </td>
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

<?php include_once(DIR_URL . "include/footer.php")?>










