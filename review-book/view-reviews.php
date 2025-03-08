<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/config.php");
//include_once("../config/database.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/models/review_book.php");

//$reviews = getReviews($conn);
//if (!isset($reviews->num_rows)) {
//    $_SESSION['error'] = "Error: " . $conn->error;
//}
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 100;
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;

include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/header.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/topbar.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/sidebar.php");
?>

<!--main content start-->
<main class="mt-1 pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php include_once("../include/alerts.php"); ?>
                <h4 class="fw-bold text-uppercase">Book reviews</h4>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        All Reviews
                    </div>

                    <div class="card">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="isbn" class="form-label">ISBN</label>
                                    <input type="text" id="isbn" class="form-control" placeholder="Enter ISBN">
                                </div>
                                <div class="col-md-4">
                                    <label for="rating" class="form-label">Star Rating</label>
                                    <select id="rating" class="form-select">
                                        <option value="">All</option>
                                        <option value="1">1 Star</option>
                                        <option value="2">2 Stars</option>
                                        <option value="3">3 Stars</option>
                                        <option value="4">4 Stars</option>
                                        <option value="5">5 Stars</option>
                                    </select>
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                    <button id="search-btn" class="btn btn-primary w-100">Search</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="data-table" class="table table-responsive table-striped" style="width:100%">
                                <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ISBN</th>
                                    <th scope="col">Rating</th>
                                    <th scope="col">Review</th>
                                </tr>
                                </thead>
                                <tbody id="data-table-body"></tbody>
<!--                                <tbody>-->
<!--                                --><?php
//                                if ($reviews->num_rows > 0) {
//                                    $i = 1;
//                                    while ($row = $reviews->fetch_assoc()) {
//                                        ?>
<!--                                        <tr>-->
<!--                                            <td>--><?php //echo $i ?><!--</td>-->
<!--                                            <td>--><?php //echo $row['isbn'] ?><!--</td>-->
<!--                                            <td>-->
<!--                                                --><?php
//                                                $rating = intval($row['rating']); // Convert rating to integer
//                                                for ($j = 1; $j <= 5; $j++) {
//                                                    if ($j <= $rating) {
//                                                        echo '⭐'; // Filled star
//                                                    } else {
//                                                        echo '☆'; // Empty star
//                                                    }
//                                                }
//                                                ?>
<!--                                            </td>-->
<!--                                            <td>--><?php //echo $row['review'] ?><!--</td>-->
<!--                                        </tr>-->
<!--                                        --><?php
//                                        $i++;
//                                    }
//                                } else {
//                                    echo "<tr><td colspan='7'>No reviews found.</td></tr>";
//                                }
//                                ?>
<!--                                </tbody>-->
                            </table>
                            <div class="text-center my-3">
                                <button id="load-more-btn" class="btn btn-primary">Load More...</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!--main content end-->

<script>
    let limit = 100; // Number of books to load per request
    let offset = 0; // Starting point
    let loading = false; // Prevent multiple simultaneous requests

    // Function to fetch and append books
    function loadReviews() {
        if (loading) return;
        loading = true;

        fetch(`../models/load_reviews.php?limit=${limit}&offset=${offset}`)
            .then((response) => response.json())
            .then((data) => {
                if (data.length > 0) {
                    const tbody = document.querySelector("#data-table tbody");

                    data.forEach((review, index) => {
                        let ratingStars = '';
                        let filledStars = review.rating; // The number of filled stars
                        let emptyStars = 5 - review.rating; // The remaining empty stars

                        // Generate the filled stars
                        for (let i = 0; i < filledStars; i++) {
                            ratingStars += '⭐';
                        }

                        // Generate the empty stars
                        for (let i = 0; i < emptyStars; i++) {
                            ratingStars += '☆';
                        }
                        const row = `
                            <tr>
                                <th scope="row">${offset + index + 1}</th>
                                <td>${review.isbn}</td>
                                <td>${ratingStars}</td>
                                <td>${review.review}</td>
                            </tr>
                        `;
                        tbody.innerHTML += row;
                    });

                    offset += limit; // Update the offset for the next load
                    loading = false; // Allow new requests
                } else {
                    // No more data to load
                    loading = false;
                }
            })
            .catch((error) => {
                console.error("Error loading books:", error);
                loading = false;
            });
    }

    function loadReviewsByFilter() {
        if (loading) return;
        loading = true;

        const isbn = document.querySelector("#isbn").value.trim();
        const rating = document.querySelector("#rating").value;
        const tbody = document.querySelector("#data-table tbody");

        // Clear previous results before fetching new ones
        tbody.innerHTML = "";
        offset = 0; // Reset offset for new search
        fetch(`../models/load_reviews_search.php?limit=${limit}&offset=${offset}&isbn=${isbn}&rating=${rating}`)
            .then((response) => response.json())
            .then((data) => {
                if (data.length > 0) {
                    const tbody = document.querySelector("#data-table tbody");

                    data.forEach((review, index) => {
                        let ratingStars = '';
                        let filledStars = review.rating; // The number of filled stars
                        let emptyStars = 5 - review.rating; // The remaining empty stars

                        // Generate the filled stars
                        for (let i = 0; i < filledStars; i++) {
                            ratingStars += '⭐';
                        }

                        // Generate the empty stars
                        for (let i = 0; i < emptyStars; i++) {
                            ratingStars += '☆';
                        }
                        const row = `
                            <tr>
                                <th scope="row">${offset + index + 1}</th>
                                <td>${review.isbn}</td>
                                <td>${ratingStars}</td>
                                <td>${review.review}</td>
                            </tr>
                        `;
                        tbody.innerHTML += row;
                    });

                    offset += limit; // Update the offset for the next load
                    loading = false; // Allow new requests
                } else {
                    // No more data to load
                    loading = false;
                }
            })
            .catch((error) => {
                console.error("Error loading books:", error);
                loading = false;
            });
    }

    //loads per click
    document.querySelector("#load-more-btn").addEventListener("click", loadReviews);
    //Search
    document.querySelector("#search-btn").addEventListener("click", loadReviewsByFilter);
    //Loading without controll, so I commented it out
    // window.addEventListener("scroll", () => {
    //     //Measures the bototm of the page
    //     const scrollPosition = window.scrollY + window.innerHeight;
    //     const bottomPosition = document.body.offsetHeight;
    //
    //     if (scrollPosition >= bottomPosition) {
    //         loadBooks();
    //     }
    // });
    // Initial load
    loadReviews();
</script>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/footer.php") ?>
