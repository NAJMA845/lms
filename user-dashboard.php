<?php
include_once("config/utility.php");
include_once("config/config.php");
include_once("config/database.php");
include_once("include/header.php");
include_once("include/topbar.php");
include_once("include/sidebar.php");
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
                        <h1>5</h1>
                        <a href="#" class="card-link link-underline-light text-center">View Borrowed Books</a>
                    </div>
                </div>                        
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h6 class="card-title text-uppercase">Due Books</h6>
                        <h1>2</h1>
                        <a href="#" class="card-link link-underline-light text-center">View Details</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h6 class="card-title text-uppercase">Total Fines</h6>
                        <h1>Rs. 300</h1>
                        <a href="#" class="card-link link-underline-light text-center">Pay Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h6 class="card-title text-uppercase">Membership Status</h6>
                        <h1>Active</h1>
                        <a href="#" class="card-link link-underline-light text-center">Renew Membership</a>
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
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-uppercase" 
                            id="reading-history-tab" 
                            data-bs-toggle="tab" 
                            data-bs-target="#reading-history-tab-pane" 
                            type="button" 
                            role="tab" 
                            aria-controls="reading-history-tab-pane" 
                            aria-selected="false">Reading History</button>
                    </li>
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
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Introduction to AI</td>
                                    <td>01-12-2023</td>
                                    <td>15-12-2023</td>
                                    <td><span class="badge text-bg-success">On Time</span></td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Python Programming</td>
                                    <td>10-11-2023</td>
                                    <td>25-11-2023</td>
                                    <td><span class="badge text-bg-danger">Overdue</span></td>
                                </tr>
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

<?php include_once("include/footer.php") ?>
