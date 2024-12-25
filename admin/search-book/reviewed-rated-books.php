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
                                        <label class="form-label">Rating</label><br>
                                        <div class="star-rating">
                                            <!-- Radio buttons for each star -->
                                            <input type="radio" id="star5" name="rating" value="5"><label for="star5" class="star">★</label>
                                            <input type="radio" id="star4" name="rating" value="4"><label for="star4" class="star">★</label>
                                            <input type="radio" id="star3" name="rating" value="3"><label for="star3" class="star">★</label>
                                            <input type="radio" id="star2" name="rating" value="2"><label for="star2" class="star">★</label>
                                            <input type="radio" id="star1" name="rating" value="1"><label for="star1" class="star">★</label>
                                        </div>
                                    </div>
                               </div>
                                <div class="col-md-12">
                                    <button type="submit" name="submit" class="btn btn-success">Save</button>
                                    <button type="reset" class="btn btn-secondary">Cancel</button>
                                </div>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Table Section -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="bookTable">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>ISBN</th>
                                            <th>Book Title</th>
                                            <th>Review</th>
                                            <th>Rating</th>
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>1234567890</td>
                                            <td>Sample Book 1</td>
                                            <td>Amazing read!</td>
                                            <td>⭐⭐⭐⭐⭐</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>0987654321</td>
                                            <td>Sample Book 2</td>
                                            <td>Very informative.</td>
                                            <td>⭐⭐⭐⭐</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content End -->


            <?php include_once("../../include/footer.php"); ?>


            <script>
    // JavaScript to capture the selected rating
    const stars = document.querySelectorAll('input[name="rating"]');

    stars.forEach(star => {
      star.addEventListener('change', () => {
        const selectedRating = document.querySelector('input[name="rating"]:checked').value;
        console.log(`Selected Rating: ${selectedRating} stars`);
      });
    });
  </script>

