<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/config.php");

if (!isset($_SESSION['user_email'])) {
    header('Location: index.php');
}
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/header.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/topbar.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/sidebar.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/models/book.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/models/users.php");

// Fetch total books
$total_books = getTotalBooks($conn);

// Fetch total active members

$total_members = getActiveMembers($conn);
$total_borrowed = getTotalBorrowedBooks($conn);

// Fetch total overdue books
$total_overdue = getTotalOverdueBooks($conn);
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
                                $new_members_query = "SELECT id, name, email, created_at,is_blocked 
                                FROM users 
                                where is_default=0
                                ORDER BY created_at DESC LIMIT 5";
                                $new_members_result = mysqli_query($conn, $new_members_query);
                                while ($member = mysqli_fetch_assoc($new_members_result)) {
                                    echo "<tr>
                                        <th>{$member['id']}</th>
                                        <td>{$member['name']}</td>
                                        <td>{$member['email']}</td>
                                        <td>{$member['created_at']}</td>
                                        <td><span class='badge " . ($member['is_blocked'] ? "text-bg-secondary" : "text-bg-success") . "'>" . ($member['is_blocked'] ? "Blocked" : "Active") . "</span></td>
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
<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/footer.php"); ?>


