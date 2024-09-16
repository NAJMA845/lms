<?php 
include_once("../config/config.php");
include_once(DIR_URL . "include/header.php");
include_once(DIR_URL . "include/topbar.php");
include_once(DIR_URL . "include/sidebar.php");
?>

        <!--main content start-->
        <main class="mt-1 pt-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
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
                                                    <th scope="col">Publication Name</th>
                                                    <th scope="col">Author Name</th>
                                                    <th scope="col">ISBN No</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>OOP Concept</td>
                                                    <td>NSBM Publisher</td>
                                                    <td>John Doe</td>
                                                    <td>1234567890</td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-sm">
                                                            Edit
                                                        </a>
                                                        <a href="#" class="btn btn-danger btn-sm">
                                                            Delete
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr></tr>
                                                    <th scope="row">2</th>
                                                    <td>Java</td>
                                                    <td>JBM Publisher</td>
                                                    <td>Ram</td>
                                                    <td>1234567890</td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-sm">
                                                            Edit
                                                        </a>
                                                        <a href="#" class="btn btn-danger btn-sm">
                                                            Delete
                                                        </a>
                                                    </td>
                                                </tr>
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

        <?php include_once(DIR_URL . "include/footer.php")?>