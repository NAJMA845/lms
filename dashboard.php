<?php
include_once("config/config.php");

if (!isset($_SESSION['user_email'])) {
    header('Location: index.php');
    exit();
}

include_once("config/utility.php");
include_once("include/header.php");
include_once("include/topbar.php");
include_once("include/sidebar.php");

// Fetch total books
$total_books_query = "SELECT COUNT(*) AS count FROM books";
$total_books_result = mysqli_query($conn, $total_books_query);
$total_books = mysqli_fetch_assoc($total_books_result)['count'];

// Fetch total active members
$total_members_query = "SELECT COUNT(*) AS count FROM users WHERE is_active = 1";
$total_members_result = mysqli_query($conn, $total_members_query);
$total_members = mysqli_fetch_assoc($total_members_result)['count'];

// Fetch total books borrowed
$total_borrowed_query = "SELECT COUNT(*) AS count FROM borrowed_books WHERE status = 'Borrowed'";
$total_borrowed_result = mysqli_query($conn, $total_borrowed_query);
$total_borrowed = mysqli_fetch_assoc($total_borrowed_result)['count'];

// Fetch total overdue books
$total_overdue_query = "SELECT COUNT(*) AS count FROM borrowed_books WHERE due_date < CURDATE() AND status = 'Borrowed'";
$total_overdue_result = mysqli_query($conn, $total_overdue_query);
$total_overdue = mysqli_fetch_assoc($total_overdue_result)['count'];
?>

<!-- Main Content Start -->
<main class="mt-1 pt-3">
    <div class="container-fluid">
        <!-- Dashboard Statistics Cards -->
        <div class="row dashboard-counts">
            <div class="col-md-12">
                <h4 class="fw-bold text-uppercase">Admin Dashboard</h4>
                <p>Statistics of the LMS!</p>
            </div>
            <div class="col-md-3">
                <div class="card custom-card">
                    <div class="card-body text-center">
                        <h6 class="card-title text-uppercase">Total Books</h6>
                        <h1><?php echo $total_books; ?></h1>
                        <a href="books.php" class="card-link link-underline-light text-center">View More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h6 class="card-title text-uppercase">Total Active Members</h6>
                        <h1><?php echo $total_members; ?></h1>
                        <a href="members.php" class="card-link link-underline-light text-center">View More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h6 class="card-title text-uppercase">Total Books Borrowed</h6>
                        <h1><?php echo $total_borrowed; ?></h1>
                        <a href="borrowed_books.php" class="card-link link-underline-light text-center">View More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h6 class="card-title text-uppercase">Overdue Books</h6>
                        <h1><?php echo $total_overdue; ?></h1>
                        <a href="overdue_books.php" class="card-link link-underline-light text-center">View More</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs Section -->
        <div class="row mt-5">
            <div class="col-md-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-uppercase active" 
                            id="recent-students-tab" 
                            data-bs-toggle="tab" 
                            data-bs-target="#recent-students-tab-pane" 
                            type="button" 
                            role="tab" 
                            aria-controls="recent-students-tab-pane"  
                            aria-selected="true">New Members</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-uppercase" 
                            id="recent-loans-tab" 
                            data-bs-toggle="tab" 
                            data-bs-target="#recent-loans-tab-pane" 
                            type="button" 
                            role="tab" 
                            aria-controls="recent-loans-tab-pane" 
                            aria-selected="false">Recent Lendings</button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content mt-3" id="myTabContent">
                    <!-- New Members Content -->
                    <div class="tab-pane fade show active" 
                        id="recent-students-tab-pane" 
                        role="tabpanel" 
                        aria-labelledby="recent-students-tab">
                        <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Registered On</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $new_members_query = "SELECT id, name, email, created_at, is_active FROM users ORDER BY created_at DESC LIMIT 5";
                                $new_members_result = mysqli_query($conn, $new_members_query);
                                while ($member = mysqli_fetch_assoc($new_members_result)) {
                                    echo "<tr>
                                        <th>{$member['id']}</th>
                                        <td>{$member['name']}</td>
                                        <td>{$member['email']}</td>
                                        <td>{$member['created_at']}</td>
                                        <td><span class='badge " . ($member['is_active'] ? "text-bg-success" : "text-bg-danger") . "'>" . ($member['is_active'] ? "Active" : "Inactive") . "</span></td>
                                    </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Recent Lending Content -->
                    <div class="tab-pane fade" 
                        id="recent-loans-tab-pane" 
                        role="tabpanel" 
                        aria-labelledby="recent-loans-tab">
                        <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Book Name</th>
                                    <th>Student Name</th>
                                    <th>Borrow Date</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $recent_loans_query = "SELECT bb.id, b.title AS book_name, u.name AS student_name, bb.borrow_date, bb.due_date, bb.status 
                                    FROM borrowed_books bb 
                                    JOIN books b ON bb.book_id = b.id 
                                    JOIN users u ON bb.user_id = u.id 
                                    ORDER BY bb.borrow_date DESC LIMIT 5";
                                $recent_loans_result = mysqli_query($conn, $recent_loans_query);
                                while ($loan = mysqli_fetch_assoc($recent_loans_result)) {
                                    echo "<tr>
                                        <th>{$loan['id']}</th>
                                        <td>{$loan['book_name']}</td>
                                        <td>{$loan['student_name']}</td>
                                        <td>{$loan['borrow_date']}</td>
                                        <td>{$loan['due_date']}</td>
                                        <td><span class='badge " . ($loan['status'] == 'Borrowed' ? "text-bg-success" : "text-bg-warning") . "'>{$loan['status']}</span></td>
                                    </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>      
        </div>
    </div>
</main>

<?php include_once("include/footer.php"); ?>


