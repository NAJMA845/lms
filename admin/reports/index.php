<?php 
include_once("../../config/config.php");
include_once("../../include/header.php");
include_once("../../include/topbar.php");
include_once("../../include/sidebar.php");
?>

<!-- Main content start -->
<main class="mt-1 pt-3">
    <div class="container-fluid">
        <!-- Report Section -->
        <div class="row">
            <div class="col-md-12">
                <h4 class="fw-bold text-uppercase">Library Report</h4>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Fill the form</span>
                        <button id="printReport" class="btn btn-primary btn-sm">
                            <i class="fas fa-print"></i> Print Report
                        </button>
                    </div>
                    <div class="card-body">
                        <form method="post" action="#">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="startDate" class="form-label">Start Date</label>
                                        <input type="date" name="startDate" id="startDate" class="form-control" title="Enter the start date" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="endDate" class="form-label">End Date</label>
                                        <input type="date" name="endDate" id="endDate" class="form-control" title="Enter the end date" required />
                                    </div>
                                </div>

                                <div class="col-md-12 text-end">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-chart-line"></i> Generate Report
                                    </button>

                                    <button type="reset" class="btn btn-secondary">
                                        <i class="fas fa-redo"></i> Reset
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <!-- Report Table -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Report Overview
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="reportTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Transaction ID</th>
                                        <th>Book Number</th>
                                        <th>Member ID</th>
                                        <th>Lend Date</th>
                                        <th>Return Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Example Row -->
                                    <tr>
                                        <td>001</td>
                                        <td>BK1001</td>
                                        <td>MB2023</td>
                                        <td>2024-12-01</td>
                                        <td>2024-12-10</td>
                                        <td><span class="badge bg-success">Returned</span></td>
                                    </tr>
                                    <tr>
                                        <td>002</td>
                                        <td>BK1002</td>
                                        <td>MB2024</td>
                                        <td>2024-12-02</td>
                                        <td>Pending</td>
                                        <td><span class="badge bg-warning">Not Returned</span></td>
                                    </tr>
                                    <!-- Additional rows should be generated dynamically with PHP -->
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
