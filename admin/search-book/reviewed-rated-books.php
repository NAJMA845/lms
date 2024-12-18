<?php 
include_once("../../config/config.php");
include_once("../../include/header.php");
include_once("../../include/topbar.php");
include_once("../../include/sidebar.php");
?>

<style>
.stars {
  font-size: 2.5rem;
  color: #ddd;
  cursor: pointer;
  user-select: none;
  display: inline-block;
}

.star {
  display: inline-block;
  transition: color 0.2s ease, transform 0.2s ease;
}

.star:hover,
.star.filled {
  color: #ffc107; /* Filled star color */
  transform: scale(1.2); /* Slight zoom effect */
}

.status-available {
  background-color: #28a745; /* Green */
}

.status-reserved {
  background-color: #ffc107; /* Yellow */
}

.status-loan {
  background-color: #007bff; /* Blue */
}

.status-overdue {
  background-color: #dc3545; /* Red */
}
</style>

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
                            <div class="mb-3">
                                <label for="isbn" class="form-label fw-bold">ISBN</label>
                                <input type="text" class="form-control" id="isbn" name="isbn" placeholder="Enter ISBN" required>
                            </div>
                            <div class="mb-3">
                                <label for="book_title" class="form-label fw-bold">Book Title</label>
                                <input type="text" class="form-control" id="book_title" name="book_title" placeholder="Enter Book Title" required>
                            </div>
                            <div class="mb-3">
                                <label for="review" class="form-label fw-bold">Review</label>
                                <textarea class="form-control" id="review" name="review" rows="3" placeholder="Write your review here"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Rating</label>
                                <div class="stars" id="starRating">
                                    <span data-value="1" class="star">★</span>
                                    <span data-value="2" class="star">★</span>
                                    <span data-value="3" class="star">★</span>
                                    <span data-value="4" class="star">★</span>
                                    <span data-value="5" class="star">★</span>
                                </div>
                                <input type="hidden" name="rating" id="ratingInput" value="0">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Feedback</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

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
                                            <button class="btn btn-sm btn-warning">Edit</button>
                                            <button class="btn btn-sm btn-danger">Delete</button>
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
                                            <button class="btn btn-sm btn-warning">Edit</button>
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>1122334455</td>
                                        <td>Sample Book 3</td>
                                        <td>Decent read but could be better.</td>
                                        <td>⭐⭐⭐</td>
                                        <td class="status-loan"><span class="badge text-bg-primary">Loaned</td>
                                        <td>
                                            <button class="btn btn-sm btn-warning">Edit</button>
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>2233445566</td>
                                        <td>Sample Book 4</td>
                                        <td>Not very engaging.</td>
                                        <td>⭐⭐</td>
                                        <td class="status-overdue"><span class="badge text-bg-danger">Overdue</td>
                                        <td>
                                            <button class="btn btn-sm btn-warning">Edit</button>
                                            <button class="btn btn-sm btn-danger">Delete</button>
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

<script>
document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll(".star");
    const ratingInput = document.getElementById("ratingInput");

    stars.forEach((star) => {
        star.addEventListener("click", () => {
            const rating = star.getAttribute("data-value");
            ratingInput.value = rating;

            // Highlight stars based on the clicked rating
            stars.forEach((s) => {
                s.classList.remove("filled");
                if (s.getAttribute("data-value") <= rating) {
                    s.classList.add("filled");
                }
            });
        });

        // Hover effect (optional)
        star.addEventListener("mouseover", () => {
            const hoverRating = star.getAttribute("data-value");
            stars.forEach((s) => {
                s.classList.remove("filled");
                if (s.getAttribute("data-value") <= hoverRating) {
                    s.classList.add("filled");
                }
            });
        });

        star.addEventListener("mouseout", () => {
            const rating = ratingInput.value;
            stars.forEach((s) => {
                s.classList.remove("filled");
                if (s.getAttribute("data-value") <= rating) {
                    s.classList.add("filled");
                }
            });
        });
    });
});

document.querySelector("form").addEventListener("submit", function (e) {
    const rating = document.getElementById("ratingInput").value;
    if (rating === "0") {
        e.preventDefault();
        alert("Please give a star rating before submitting your feedback.");
    }
});
</script>
