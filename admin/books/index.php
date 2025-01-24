<?php
include_once("../../config/config.php");
//include_once("../../config/database.php");
include_once("../../models/book.php");

//## Get Books
//$books = getBooks($conn);
//if (!isset($books->num_rows)) {
//    $_SESSION['error'] = "Error: " . $conn->error;
//}

$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 100;
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
include_once("../../include/header.php");
include_once("../../include/topbar.php");
include_once("../../include/sidebar.php");
?>

<!--main content start-->
<main class="mt-1 pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php include_once("../../include/alerts.php"); ?>
                <h4 class="fw-bold text-uppercase"> Manage Books </h4>
            </div>
            <!--Cards-->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        All Books
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="data-table" class="table table-responsive table-striped" style="width:100%">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Book Name</th>
                                        <th scope="col">Publication Year</th>
                                        <th scope="col">Author Name</th>
                                        <th scope="col">ISBN No</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="data-table-body"></tbody>
<!--                                <tbody>-->
<!--                                    --><?php
//                                    if ($books->num_rows > 0) {
//                                        $i = 1;
//                                        while ($row = $books->fetch_assoc()) {
//                                    ?>
<!--                                    <tr>-->
<!--                                        <th scope="row">--><?php //echo $i++ ?><!--</th>-->
<!--                                        <td>--><?php //echo $row['title'] ?><!--</td>-->
<!--                                        <td>--><?php //echo $row['publication_year'] ?><!--</td>-->
<!--                                        <td>--><?php //echo $row['author'] ?><!--</td>-->
<!--                                        <td>--><?php //echo $row['isbn'] ?><!--</td>-->
<!--                                        <td>--><?php //echo $row['cat_name'] ?><!--</td>-->
<!--                                        <td>-->
<!--                                            --><?php
//                                            if ($row['status'] == 1) {
//                                                echo '<span class="badge text-bg-success">Active</span>';
//                                            } else {
//                                                echo '<span class="badge text-bg-danger">Inactive</span>';
//                                            }
//                                            ?>
<!--                                        </td>-->
<!--                                        <td>--><?php //echo date("d-m-Y h:i A", strtotime($row['created_at'])) ?><!--</td>-->
<!--                                        <td>-->
<!--                                            <a href="--><?php //echo ADMIN_BASE_URL.'books/edit.php?'.$row['guid'] ?><!--" class="btn btn-primary btn-sm">-->
<!--                                                Edit-->
<!--                                            </a>-->
<!--                                            <a href="--><?php //echo ADMIN_BASE_URL.'books/delete.php?'.$row['guid'] ?><!--" class="btn btn-danger btn-sm">-->
<!--                                                Delete-->
<!--                                            </a>-->
<!--                                        </td>-->
<!--                                    </tr>-->
<!--                                    --><?php
//                                        }
//                                    }
//                                    ?>
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
    function loadBooks() {
        if (loading) return;
        loading = true;

        fetch(`../../models/load_books.php?limit=${limit}&offset=${offset}`)
            .then((response) => response.json())
            .then((data) => {
                if (data.length > 0) {
                    const tbody = document.querySelector("#data-table tbody");

                    data.forEach((book, index) => {
                        const row = `
                            <tr>
                                <th scope="row">${offset + index + 1}</th>
                                <td>${book.title}</td>
                                <td>${book.publication_year}</td>
                                <td>${book.author}</td>
                                <td>${book.isbn}</td>
                                <td>${book.cat_name}</td>
                                <td>
                                    ${
                            book.status == 1
                                ? '<span class="badge text-bg-success">Active</span>'
                                : '<span class="badge text-bg-danger">Inactive</span>'
                        }
                                </td>
                                <td>${new Date(book.created_at).toLocaleString()}</td>
                                <td>
                                    <a href="<?php echo ADMIN_BASE_URL; ?>books/edit.php?${book.guid}" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="<?php echo ADMIN_BASE_URL; ?>books/delete.php?${book.guid}" class="btn btn-danger btn-sm">Delete</a>
                                </td>
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
    document.querySelector("#load-more-btn").addEventListener("click", loadBooks);
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
    loadBooks();
</script>

<?php include_once("../../include/footer.php") ?>