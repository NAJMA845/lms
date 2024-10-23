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
                <h4 class="fw-bold text-uppercase">Manage Members</h4>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        All Members
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="data-table" class="table table-responsive table-striped" style="width:100%">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone No</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>John Doe</td>
                                        <td>john@example.com</td>
                                        <td>123-456-7890</td>
                                        <td><span class="badge text-bg-success">Active</span></td>
                                        <td>10-09-2024 02:15 PM</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                            <a onclick="return confirm('Are you sure?')" href="#" class="btn btn-danger btn-sm">Delete</a>
                                            <a href="#" class="btn btn-warning btn-sm">Inactive</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Jane Smith</td>
                                        <td>jane@example.com</td>
                                        <td>987-654-3210</td>
                                        <td><span class="badge text-bg-danger">Inactive</span></td>
                                        <td>05-09-2024 10:30 AM</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                            <a onclick="return confirm('Are you sure?')" href="#" class="btn btn-danger btn-sm">Delete</a>
                                            <a href="#" class="btn btn-success btn-sm">Active</a>
                                        </td>
                                    </tr>
                                    <!-- Add more static student rows as needed -->
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