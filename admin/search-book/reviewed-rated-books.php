<?php 
include_once("../../config/config.php");
include_once("../../include/header.php");
include_once("../../include/topbar.php");
include_once("../../include/sidebar.php");
?>

<!-- Main Content Start -->
<main class="mt-1 pt-3">

    <div class="container mt-4">
        <h3 class="text-center">Reviewed & Rated Books</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="bg-primary text-white">
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