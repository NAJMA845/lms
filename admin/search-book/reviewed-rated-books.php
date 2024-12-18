<?php 
include_once("../../config/config.php");
include_once("../../include/header.php");
include_once("../../include/topbar.php");
include_once("../../include/sidebar.php");
?>

<!-- Main Content Start -->
<main class="mt-1 pt-3">
    <div class="container-fluid">
        <!-- Section Header -->
        <div class="row">
            <div class="col-md-12">
                <h4 class="fw-bold text-uppercase">Give Feedback For Review</h4>
            </div>
        </div>

        <!-- Feedback Form -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="submit_review.php" method="POST">
                            <div class="row">
                                <!-- ISBN and Book Title Side by Side -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="isbn" class="form-label">ISBN</label>
                                        <input type="text" class="form-control" id="isbn" name="isbn" placeholder="Enter ISBN" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="book_title" class="form-label">Book Title</label>
                                        <input type="text" class="form-control" id="book_title" name="book_title" placeholder="Enter Book Title" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <!-- Review Field -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="review" class="form-label">Review</label>
                                        <textarea class="form-control" id="review" name="review" rows="3" placeholder="Write your review here"></textarea>
                                    </div>
                                </div>
                                
                                <!-- Rating Field -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Rating</label><br><br>
                                        <div class="btn-group" role="group" aria-label="Star Rating">
                                            <button type="button" class="btn btn-outline-primary" data-value="1">★</button>
                                            <button type="button" class="btn btn-outline-primary" data-value="2">★</button>
                                            <button type="button" class="btn btn-outline-primary" data-value="3">★</button>
                                            <button type="button" class="btn btn-outline-primary" data-value="4">★</button>
                                            <button type="button" class="btn btn-outline-primary" data-value="5">★</button>
                                        </div>
                                        <input type="hidden" name="rating" id="ratingInput" value="0">
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-md-12 text-start">
                                    <button type="submit" class="btn btn-success">Submit Feedback</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

        <!-- Table Section -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>ISBN</th>
                                        <th>Book Title</th>
                                        <th>Review</th>
                                        <th>Rating</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>1234567890</td>
                                        <td>Sample Book 1</td>
                                        <td>Amazing read!</td>
                                        <td>⭐⭐⭐⭐⭐</td>
                                        <td class="status-available"><span class="badge text-bg-success">Available</td>
                                        <td>
                                            <button class="btn btn-primary">Edit</button>
                                            <button class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>0987654321</td>
                                        <td>Sample Book 2</td>
                                        <td>Very informative.</td>
                                        <td>⭐⭐⭐⭐</td>
                                        <td class="status-reserved"><span class="badge text-bg-warning">Reserved</td>
                                        <td>
                                            <button class="btn btn-primary">Edit</button>
                                            <button class="btn btn-danger">Delete</button>
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
<!-- Main Content End -->

<?php include_once("../../include/footer.php"); ?>