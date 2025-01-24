<?php
include_once("../config/config.php");
include_once("../models/search_book.php");
include_once("../include/header.php");
include_once("../include/topbar.php");
include_once("../include/sidebar.php");

// Initialize searchResults as empty
$searchResults = [];
$query = "";

// Check if the search form is submitted
if (isset($_GET['query']) && !empty(trim($_GET['query']))) {
    $query = trim($_GET['query']);
    //Storing the search result to variable
    $searchResults = findBooks($conn,$query);
}
?>



<!-- Main content start -->

<main class="mt-1 pt-3">
    <!-- Search Form  -->
    <form method="GET" action="search-books.php" class="mb-4">
        <div class="input-group">
            <input type="text" name="query" class="form-control" placeholder="Search books by title, author, or ISBN..." required>
            <button class="btn btn-primary" type="submit">
                <i class="fas fa-search"></i> Search
            </button>
        </div>
    </form>
    <!-- Display Search Result -->
    <!-- Display Search Result only if query exists -->
    <?php if (!empty($query)) { ?>
        <div class="mt-4">
            <h5>Search Results</h5>
            <?php
            if ($searchResults->num_rows>0) {
                ?>
                <div class="list-group">
                    <?php foreach ($searchResults as $book) { ?>
                        <div class="list-group-item">
                            <!-- Display Book Image -->
                            <p class="mb-1">
                                <input type="hidden" name="guid" value="<?= $book['guid'] ?>">
                                <strong>ISBN</strong> <?= htmlspecialchars($book['isbn']) ?> |
                                <strong>Title</strong> <?= $book['title'] ?> |
                                <strong>Category</strong> <?= $book['category'] ?> |
                                <strong>Author</strong> <?= ucfirst($book['author']) ?>
                                <strong>Published On</strong> <?= ucfirst($book['publication_year']) ?>
                            <div class="mt-3">
                                <button class="btn btn-secondary btn-sm" onclick="checkAvailabilityOfBookCopy('<?= $book['guid'] ?>')">Check Availability</button>
                            </div>
                            </p>
                            <!-- Show Rate and Review Form for Found Books -->
                            <div class="mt-3">
                                <form method="POST" action="<?php echo BASE_URL?>review-book/review-book.php">
                                    <input type="hidden" name="isbn" value="<?= $book['isbn'] ?>">

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

                                    <!-- Review Text Area -->
                                    <div class="mb-3">
                                        <label for="review" class="form-label fw-bold">Write a Review:</label>
                                        <textarea name="review" id="review" rows="3" class="form-control" placeholder="Share your thoughts about the book..." required></textarea>
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary btn-sm" name="submit" id="submit" disabled>
                                        <i class="fas fa-paper-plane"></i> Submit Review
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php } ?>
                </div>

            <?php } else {
                ?>
                <p class="text-muted">No books found matching your search criteria.</p>
            <?php } ?>
        </div>
    <?php } ?>
</main>

<!--Modal that opens when user clicks the Check Availability button-->
<div class="modal fade" id="availabilityModal" tabindex="-1" aria-labelledby="availabilityModalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="availabilityModalLabel">Book Availability</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table id="bookCopiesTable" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Copy No</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody id="bookCopiesBody">
                    <!-- Data will be inserted here via JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Main content end -->
<?php include_once("../include/footer.php"); ?>

<script>
    // JavaScript to capture the selected rating
    const stars = document.querySelectorAll('input[name="rating"]');

    stars.forEach(star => {
        star.addEventListener('change', () => {
            const selectedRating = document.querySelector('input[name="rating"]:checked').value;
        });
    });

    document.addEventListener("DOMContentLoaded", () => {
        // Review form logic
        const ratingInputs = document.querySelectorAll('input[name="rating"]');
        const reviewInput = document.getElementById('review');
        const submitButton = document.getElementById('submit');

        function checkFields() {
            const ratingChecked = Array.from(ratingInputs).some(input => input.checked);
            const reviewText = reviewInput.value.trim();

            // Enable submit button only if both rating and review are filled
            submitButton.disabled = !(ratingChecked && reviewText);
        }

        // Add event listeners to rating inputs
        ratingInputs.forEach(input => {
            input.addEventListener('change', checkFields);
        });
        reviewInput.addEventListener('input', checkFields);
        checkFields();
    });

    //**************************** Check Availability logic***********************//
    function checkAvailabilityOfBookCopy(guid) {
        const availabilityModal = new bootstrap.Modal(document.getElementById('availabilityModal'));
        const bookCopiesBody = document.getElementById('bookCopiesBody');
        availabilityModal.show();
        // Fetch book copies from the server
        fetch(`../models/load_book_copies.php?guid=${guid}`)
            .then((response) => response.json())
            .then((data) => {
                // Clear previous data
                bookCopiesBody.innerHTML = '';

                if (data.length > 0) {
                    // Populate the modal with the book copies data
                    data.forEach(copy => {
                        const reserveButton = `<a href="<?php echo BASE_URL; ?>reserve-book/reserve-book.php?copy_no=${copy.copy_no}" class="btn btn-success btn-sm ms-2">
                                Reserve
                            </a>`;

                        // Determine the badge class based on status
                        const badgeClass = copy.status === "Available" ? "text-bg-primary" : "text-bg-danger";

                        const row = `
                            <tr>
                                <td>${copy.copy_no} ${reserveButton}</td>
                                <td>
                                    <span class="badge ${badgeClass}">${copy.status}</span>
                                </td>
                            </tr>
    `;
                        bookCopiesBody.innerHTML += row;
                    });

                } else {
                    // Show a message if no copies found
                    bookCopiesBody.innerHTML = '<tr><td colspan="2" class="text-center">No copies available.</td></tr>';
                }
            })
            .catch((error) => {
                console.error("Error fetching book copies:", error);
                bookCopiesBody.innerHTML = '<tr><td colspan="2" class="text-center text-danger">Error loading data.</td></tr>';
            });
    }

</script>
