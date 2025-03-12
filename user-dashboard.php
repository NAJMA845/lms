<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/utility.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/config.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/database.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/header.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/topbar.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/sidebar.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/models/book.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/models/book_tran.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/models/users.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/models/fines.php");

$total_borrowed = getTotalBorrowedBooks($conn,$_SESSION['id']);
$total_overdue = getTotalOverdueBooks($conn,$_SESSION['id']);
if($_SESSION['active_status']=="0")
    $active_status="<h1 class='text-bg-info'>Active</h1>";
else
    $active_status="<h1 class='text-bg-danger'>Blocked</h1>";


$book_trans = getBookTranByLimit($conn,$_SESSION['id'],'');
$total_fines = getTotalFineByUser($conn,$_SESSION['id']);
if (!isset($book_trans->num_rows)) {
    $_SESSION['error'] = "Error: " . $conn->error;
}
?>

<!--main content start-->
<main class="mt-1 pt-3">
    <div class="container-fluid">
        <!--Dashboard Header-->

        <div class="row dashboard-counts">
            <div class="col-md-12">
                <h4 class="fw-bold text-uppercase"> User Dashboard </h4>
                <p>Welcome to your personalized LMS Dashboard!</p>
            </div>
        </div>
        
        <!--Cards Section-->
        <div class="row dashboard-counts">
            <div class="col-md-3">
                <div class="card custom-card">
                    <div class="card-body text-center">
                        <h6 class="card-title text-uppercase">Books Borrowed</h6>
                        <h1>
                        <?php echo $total_borrowed;?>
                        </h1>
<!--                        <a href="#" class="card-link link-underline-light text-center">View Borrowed Books</a>-->
                    </div>
                </div>                        
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h6 class="card-title text-uppercase">Due Books</h6>
                        <h1>
                            <?php echo $total_overdue; ?>
                        </h1>
<!--                        <a href="#" class="card-link link-underline-light text-center">View Details</a>-->
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h6 class="card-title text-uppercase">Total Fines</h6>
                        <h1>Rs. <?php echo $total_fines;  ?></h1>
<!--                        <a href="#" class="card-link link-underline-light text-center">Pay Now</a>-->
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h6 class="card-title text-uppercase">Membership Status</h6>
                        <?php echo $active_status; ?>
<!--                        <a href="#" class="card-link link-underline-light text-center">Renew Membership</a>-->
                    </div>
                </div>
            </div>
        </div>
        
        <!--Tabs Section-->
        <div class="row mt-5">
            <div class="col-md-12">
                <ul class="nav nav-tabs" id="userTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-uppercase active" 
                        id="borrowed-books-tab" 
                        data-bs-toggle="tab" 
                        data-bs-target="#borrowed-books-tab-pane" 
                        type="button" 
                        role="tab" 
                        aria-controls="borrowed-books-tab-pane"  
                        aria-selected="true">Borrowed Books</button>                    
                    </li>
<!--                    <li class="nav-item" role="presentation">-->
<!--                        <button class="nav-link text-uppercase" -->
<!--                            id="reading-history-tab" -->
<!--                            data-bs-toggle="tab" -->
<!--                            data-bs-target="#reading-history-tab-pane" -->
<!--                            type="button" -->
<!--                            role="tab" -->
<!--                            aria-controls="reading-history-tab-pane" -->
<!--                            aria-selected="false">Reading History</button>-->
<!--                    </li>-->
                </ul>
        
                <!--Tab Content-->
                <div class="tab-content mt-3" id="userTabContent">
                    <!--Borrowed Books Content-->
                    <div class="tab-pane fade show active" 
                        id="borrowed-books-tab-pane" 
                        role="tabpanel" 
                        aria-labelledby="borrowed-books-tab">
                        <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Book Name</th>
                                    <th scope="col">Borrowed On</th>
                                    <th scope="col">Due Date</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($book_trans->num_rows > 0) {
                                $i = 1;
                                while ($row = $book_trans->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $i++ ?></th>
                                        <td><?php echo $row['title'] ?></td>
                                        <td><?php echo $row['borrowed_date'] ?></td>
                                        <td><?php echo $row['returned_date'] ?></td>
                                        <?php
                                        if($row['STATUS']=="Borrowed"){
                                            echo '<td class="text-bg-info">Borrowed</td>';
                                        }else if (($row['STATUS']=="Returned")){
                                            echo '<td class="text-bg-success">Returned</td>';
                                        }
                                        else{
                                            echo '<td class="text-bg-danger">Overdue</td>';
                                        }
                                        ?>

                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='6'>No transaction found.</td></tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
        
                    <!--Reading History Content-->
                    <div class="tab-pane fade" 
                        id="reading-history-tab-pane" 
                        role="tabpanel" 
                        aria-labelledby="reading-history-tab">
                        <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Book Name</th>
                                    <th scope="col">Borrowed On</th>
                                    <th scope="col">Returned On</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Java Basics</td>
                                    <td>10-09-2023</td>
                                    <td>25-09-2023</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Database Systems</td>
                                    <td>15-10-2023</td>
                                    <td>30-10-2023</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!--main content end-->

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/footer.php") ?>
