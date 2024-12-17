<?php 
include_once("../../config/config.php");
include_once("../../include/header.php");
include_once("../../include/topbar.php");
include_once("../../include/sidebar.php");
?>

<!-- Main Content Start -->
<main class="mt-1 pt-3">

    <div class="container-fluid">
        <!-- Manage Multimedia Room Bookings Section -->
        <div class="row">
            <div class="col-md-12">
                <h4 class="fw-bold text-uppercase">Reviewed & Rated Books</h4>
    </div>

    <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Rated & Reviewed Books Overview
                    </div>

                    <div class="card-body">
                    <div class="table-responsive">
            <table class="table table-bordered table-striped" id="reviewed&ratedTable">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Book Title</th>
                        <th>Author</th>
                        <th>Reviews</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <!-- <tbody>
                   
                </tbody> -->
            </table>
        </div>
    </div>
</main>
    <!-- Main Content End -->

<?php include_once("../../include/footer.php"); ?>