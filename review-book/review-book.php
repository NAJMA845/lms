<?php
include_once("../config/config.php");
//include_once("../config/database.php");
include_once("../models/review_book.php");

//Add reviews functionality
if (isset($_POST['submit'])) {
    $res = writeReviewToBook($conn, $_POST);
    if (isset($res['success'])) {
        $_SESSION['success'] = "Review has been created Successfully";
        header("LOCATION:" . BASE_URL . "review-book/view-reviews.php");
    } else {
        $_SESSION['error'] = $res["error"];//"Something went wrong, please try again.";
        //header("LOCATION:" . BASE_URL . "books/add.php");
    }
}

include_once("../include/header.php");
include_once("../include/topbar.php");
include_once("../include/sidebar.php");



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
                        <form action="<?php echo BASE_URL?>review-book/review-book.php" method="POST">
                            <div class="row">
                                <!-- ISBN and Book Title Side by Side -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="isbn" class="form-label">ISBN</label>
                                        <input type="text" class="form-control" id="isbn" name="isbn" placeholder="Enter ISBN" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
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
                            </div>
                            <div class="row">
                                <!-- Review Field -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="review" class="form-label">Review</label>
                                        <textarea class="form-control" id="review" name="review" rows="3" placeholder="Write your review here"></textarea>
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

            <!-- Main Content End -->
            <?php include_once("../include/footer.php"); ?>

<script>
    // JavaScript to capture the selected rating
    const stars = document.querySelectorAll('input[name="rating"]');

    stars.forEach(star => {
    star.addEventListener('change', () => {
    const selectedRating = document.querySelector('input[name="rating"]:checked').value;
        });
    });
</script>

