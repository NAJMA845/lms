
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
                <!--Cards-->
                <div class="row dashboard-counts">
                    <div class="col-md-12">
                       <h4 class="fw-bold text-uppercase"> Dashboard </h4>
                       <p>Statictis of the our LMS !</p>
                    </div>
                    <div class="col-md-3">
                        <div class="card custom-card">
                            <div class="card-body text-center">
                                <h6 class="card-title text-uppercase">total books</h6>
                                <h1>130</h1>
                                <a href="#" class="card-link link-underline-light text-center">View More</a>
                            </div>
                        </div>                        
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body text-center">
                              <h6 class="card-title text-uppercase">total students</h6>
                              <h1>60</h1>
                              <a href="#" class="card-link link-underline-light text-center">View More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body text-center">
                              <h6 class="card-title text-uppercase">total revenue</h6>
                              <h1>125,000</h1>
                              <a href="#" class="card-link link-underline-light text-center">View More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body text-center">
                              <h6 class="card-title text-uppercase">total book loan</h6>
                              <h1>30</h1>
                              <a href="#" class="card-link link-underline-light text-center">View More</a>
                            </div>
                        </div>
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
                            aria-selected="true">New Students</button>                    
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-uppercase" 
                                id="recent-loans-tab" 
                                data-bs-toggle="tab" 
                                data-bs-target="#recent-loans-tab-pane" 
                                type="button" 
                                role="tab" 
                                aria-controls="recent-loans-tab-pane" 
                                aria-selected="false">Recent Loans</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-uppercase" 
                                id="recent-subs-tab" 
                                data-bs-toggle="tab" 
                                data-bs-target="#recent-subs-tab-pane" 
                                type="button" 
                                role="tab" 
                                aria-controls="recent-subs-tab-pane" 
                                aria-selected="false">New Subscription</button>
                        </li>
                    </ul>
            
                    <!-- Tab Content -->
                    <div class="tab-content mt-3" id="myTabContent">
                        <!-- New Students Content -->
                        <div class="tab-pane fade show active" 
                            id="recent-students-tab-pane" 
                            role="tabpanel" 
                            aria-labelledby="recent-students-tab">
                            <table class="table">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Book Name</th>
                                        <th scope="col">Registered On</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>OOP Concept</td>
                                        <td>10-05-2023, 10:10 AM</td>
                                        <td><span class="badge text-bg-success">Active</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>David</td>
                                        <td>Harry Potter</td>
                                        <td>10-05-2023, 10:10 AM</td>
                                        <td><span class="badge text-bg-success">Active</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Alex</td>
                                        <td>Harry Potter</td>
                                        <td>10-05-2023, 10:10 AM</td>
                                        <td><span class="badge text-bg-success">Active</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4</th>
                                        <td>Alia</td>
                                        <td>DSA</td>
                                        <td>10-05-2023, 10:10 AM</td>
                                        <td><span class="badge text-bg-danger">Inactive</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
            
                        <!-- Recent Loans Content -->
                        <div class="tab-pane fade" 
                            id="recent-loans-tab-pane" 
                            role="tabpanel" 
                            aria-labelledby="recent-loans-tab">
                            <table class="table">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Book Name</th>
                                        <th scope="col">Student Name</th>
                                        <th scope="col">Loan Date</th>
                                        <th scope="col">Due Date</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>OOP Concept</td>
                                        <td>David</td>
                                        <td>25-05-2023</td>
                                        <td>20-06-2023</td>
                                        <td><span class="badge text-bg-warning">Returned</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>DSA</td>
                                        <td>Mark</td>
                                        <td>28-07-2023</td>
                                        <td>24-09-2023</td>
                                        <td><span class="badge text-bg-warning">Returned</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Physical Geography</td>
                                        <td>Marry</td>
                                        <td>27-06-2023</td>
                                        <td>25-07-2023</td>
                                        <td><span class="badge text-bg-success">Active</span></td>
                                    </tr>
                                    <tr></tr>
                                        <th scope="row">4</th>
                                        <td>Php</td>
                                        <td>Ram</td>
                                        <td>27-06-2023</td>
                                        <td>25-07-2023</td>
                                        <td><span class="badge text-bg-success">Active</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
            
                        <!-- New Subscription Content -->
                        <div class="tab-pane fade" 
                            id="recent-subs-tab-pane" 
                            role="tabpanel" 
                            aria-labelledby="recent-subs-tab">
                            <table class="table">
                                <thead class="table-dark">
                                    <th scope="col">#</th>
                                    <th scope="col">Student Name</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">Status</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>RS. 1200</td>
                                        <td>27-06-2023</td>
                                        <td>25-07-2023</td>
                                        <td><span class="badge text-bg-success">Active</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>David</td>
                                        <td>RS. 3200</td>
                                        <td>21-03-2023</td>
                                        <td>21-04-2023</td>
                                        <td><span class="badge text-bg-success">Active</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Max</td>
                                        <td>RS. 2200</td>
                                        <td>21-04-2023</td>
                                        <td>21-05-2023</td>
                                        <td><span class="badge text-bg-success">Active</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4</th>
                                        <td>Alex</td>
                                        <td>RS. 3200</td>
                                        <td>21-03-2023</td>
                                        <td>21-04-2023</td>
                                        <td><span class="badge text-bg-danger">Enquired</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </main>
        <!--main content end-->

        <?php include_once("include/footer.php")?>