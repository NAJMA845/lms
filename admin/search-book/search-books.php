<?php 
include_once("../../config/config.php");
include_once("../../include/header.php");
include_once("../../include/topbar.php");
include_once("../../include/sidebar.php");
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

    <!-- Search Filters -->
    <div class="row">
        <div class="col-md-3">
            <label for="genre">Genre:</label>
            <select name="genre" id="genre" class="form-select">
                <option value="">All</option>
                <option value="fiction">Fiction</option>
                <option value="non-fiction">Non-Fiction</option>
                <option value="science">Science</option>
                <option value="history">History</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="year">Publication Year:</label>
            <input type="number" name="year" id="year" class="form-control" placeholder="e.g., 2020">
        </div>
        <div class="col-md-3">
            <label for="availability">Availability:</label>
            <select name="availability" id="availability" class="form-select">
                <option value="">All</option>
                <option value="available">Available</option>
                <option value="reserved">Reserved</option>
                <option value="borrowed">Out on Loan</option>
            </select>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-success mt-4">
                <i class="fas fa-filter"></i> Apply Filters
            </button>
        </div>
    </div>

    <!-- Display Search Result -->
    <div class="mt-4">
        <h5>Search Results</h5>
        <?php if (empty($searchResults)): ?>
            <p class="text-muted">No books found matching your search criteria.</p>
        <?php else: ?>
            <div class="list-group">
                <?php foreach ($searchResults as $book): ?>
                    <div class="list-group-item">
                        <!-- Display Book Image -->
                        <div class="d-flex align-items-center mb-1">
                            <img src="<?= htmlspecialchars($book['image_url']) ?>" alt="<?= htmlspecialchars($book['title']) ?>" class="img-thumbnail" width="50" height="75">
                            <h6 class="ml-3"><?= htmlspecialchars($book['title']) ?></h6>
                        </div>
                        <p class="mb-1">
                            <strong>Author:</strong> <?= htmlspecialchars($book['author']) ?> |
                            <strong>Year:</strong> <?= $book['publication_year'] ?> |
                            <strong>Genre:</strong> <?= $book['genre'] ?> |
                            <strong>Availability:</strong> <?= ucfirst($book['availability']) ?>
                        </p>
                        <!-- Show Rate and Review Form for Found Books -->
                        <div class="mt-3">
                            <form method="POST" action="submit-review.php">
                                <input type="hidden" name="book_id" value="<?= $book['id'] ?>">

                                <!-- Star Rating -->
                                <div class="mb-2">
                                    <label class="form-label fw-bold">Rate this book:</label>
                                    <div>
                                        <input type="radio" name="rating" value="5" required> ⭐⭐⭐⭐⭐  
                                        <input type="radio" name="rating" value="4"> ⭐⭐⭐⭐  
                                        <input type="radio" name="rating" value="3"> ⭐⭐⭐  
                                        <input type="radio" name="rating" value="2"> ⭐⭐  
                                        <input type="radio" name="rating" value="1"> ⭐  
                                    </div>
                                </div>

                                <!-- Review Text Area -->
                                <div class="mb-3">
                                    <label for="review" class="form-label fw-bold">Write a Review:</label>
                                    <textarea name="review" id="review" rows="3" class="form-control" placeholder="Share your thoughts about the book..." required></textarea>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fas fa-paper-plane"></i> Submit Review
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</main>
<!-- Main content end -->

<?php include_once("../../include/footer.php"); ?>
