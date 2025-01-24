<?php 
include_once("../../config/config.php");
include_once("../../include/header.php");
include_once("../../include/topbar.php");
include_once("../../include/sidebar.php");
?>

<!-- Main content start -->
<main class="mt-1 pt-3">
    <div class="container-fluid">
        <!-- Manage Late Fee Section -->
        <div class="row">
            <div class="col-md-12">
                <?php include_once("../../include/alerts.php"); ?>
                <h4 class="fw-bold text-uppercase">Manage Late Fees</h4>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Late Fee Overview
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="lateFeeTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Member Type</th>
                                        <th>Late Fee Per Day (Rs)</th>
                                        <th>Maximum Fee (Rs)</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>001</td>
                                        <td>Student</td>
                                        <td>1.5</td>
                                        <td>15.00</td>
                                        <td>
                                            <button class="btn btn-primary">
                                                 Edit
                                            </button>
                                            <button class="btn btn-danger ">
                                                Delete
                                            </button>
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
<!-- Main content end -->

<?php include_once("../../include/footer.php"); ?>
