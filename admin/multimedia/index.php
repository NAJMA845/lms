<?php 
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/config.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/header.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/topbar.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/sidebar.php");
?>

<!-- Main content start -->
<main class="mt-1 pt-3">
    <div class="container-fluid">
        <!-- Manage Multimedia Room Bookings Section -->
        <div class="row">
            <div class="col-md-12">
                <?php include_once("../../include/alerts.php"); ?>
                <h4 class="fw-bold text-uppercase">Multimedia Room Booking Hub</h4>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Booking Overview
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="bookingTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Booking ID</th>
                                        <th>NIC No</th>
                                        <th>Booking Date</th>
                                        <th>Time Slot</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr>
                                        <td>001</td>
                                        <td>20004567234</td>
                                        <td>2024-12-15</td>
                                        <td>9:00 AM - 11:00 AM</td>
                                        <td>
                                            <button class="btn btn-primary">
                                                Edit
                                            </button>
                                            <button class="btn btn-danger">
                                               Delete
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>002</td>
                                        <td>19945633567</td>
                                        <td>2024-12-16</td>
                                        <td>11:30 AM - 1:30 PM</td>
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

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/footer.php"); ?>
