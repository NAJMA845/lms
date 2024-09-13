<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
    <script src="./assets/js/a0c7076c1c.js"></script>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <title>Online Library Management System</title>
    </head>
    <link rel="stylesheet" href="./assets/css/style.css"/>
    <body>
        <!--Top navbar start-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
              <!--offcanvas trigger start-->
                    <button
                    class="navbar-toggler me-2"
                    type="button"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasExample"
                    aria-controls="offcanvasExample"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
              <!--offcanvas trigger end-->
         <a class="navbar-brand text-uppercase fw-bold text-uppercase me-auto " 
         href="#">Smartlib</a>
        <button class="navbar-toggler" type="button" 
              data-bs-toggle="collapse" 
              data-bs-target="#navbarSupportedContent" 
              aria-controls="navbarSupportedContent" 
              aria-expanded="false" 
              aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" 
              id="navbarSupportedContent">
              <form class="d-flex ms-auto" role="search">
                <div class="input-group my-3 my-lg-0 ">
                    <input 
                    type="text" 
                    class="form-control"
                     placeholder="Search..." 
                    aria-describedby="button-addon2"
                    />
                    <button class="btn btn-outline-secondary btn-primary text-white" 
                            type="button" 
                            id="button-addon2"
                            aria-label="Search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>

                  </div>
              </form>
              
                <ul class="navbar-nav mb-2 mb-lg-0">
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" 
                    role="button" data-bs-toggle="dropdown" 
                    aria-expanded="false"
                    >
                    <img src="./assets/images/user.jpeg" class="user-icon" alt="User icon"/>
                      Admin
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                      <li><a class="dropdown-item" href="#">My Profile</a></li>
                      <li><a class="dropdown-item" href="#">Change Password</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">Log Out</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
        </nav>
        <!--Top navbar end-->

        <!--Off canvas start--> 
          <div class="offcanvas offcanvas-start bg-dark text-white sidebar-nav" 
          tabindex="-1" 
          id="offcanvasExample" 
          aria-labelledby="offcanvasExampleLabel">

          <div class ="offcanvas-body">
          <ul class="navbar-nav">
            <li class="nav-item">
                <div class="text-secondary text-uppercase fw-bold">Core</div>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page"  
              href="#"><i class="fas fa-tachometer-alt me-2"></i> Dashboard </a>
            </li>

            <li class="nav-item my-0">
               <hr/>
            </li>
            
            <li class="nav-item">
                <div class="text-secondary text-uppercase fw-bold">Inventory</div>
            </li>
            <li class="nav-item">
                <a class="nav-link sidebar-link" 
                data-bs-toggle="collapse" 
                href="#BooksMgmt" 
                role="button" 
                aria-expanded="false" 
                aria-controls="BooksMgmt"> <i class="fas fa-book me-2"></i> Books Management
                <span class="right-icon float-end"> 
                    <i class="fas fa-chevron-down"></i></span>
                  </a>
                  <div class="collapse" id="BooksMgmt">
                    <div > 
                        <ul class="navbar-nav ps-3">
                            <li>
                                <a href="./add-book.php" class="nav-link" ><i class="fas fa-plus me-2"></i> Add New Books</a>
                            </li>
                            <li>
                                <a href="./manage-books.php" class="nav-link"><i class="fas fa-list me-2"></i> Manage All Books</a>
                            </li>
                    </div>
                  </div>
              </li>

              <li class="nav-item">
                <a class="nav-link sidebar-link" 
                data-bs-toggle="collapse" 
                href="#StudentMgmt" 
                role="button" 
                aria-expanded="false" 
                aria-controls="StudentMgmt"
                > <i class="fas fa-users me-2"></i> Student Management
                <span class="right-icon float-end"> 
                    <i class="fas fa-chevron-down"></i></span>
                  </a>
                  <div class="collapse" id="StudentMgmt">
                    <div > 
                        <ul class="navbar-nav ps-3">
                            <li>
                                <a href="#" class="nav-link" ><i class="fas fa-plus me-2"></i> Add New Books</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link"><i class="fas fa-list me-2"></i> Manage All Books</a>
                            </li>
                        </ul>
                            
                            <li class="nav-item my-0">
                                <hr/>
                            </li>
                             
                            <li class="nav-item">
                                 <div class="text-secondary text-uppercase fw-bold">Bussiness</div>
                            </li>
                               
                            <li class="nav-item">
                                <a class="nav-link sidebar-link" 
                                data-bs-toggle="collapse" 
                                href="#BooksLoan" 
                                role="button" 
                                aria-expanded="false" 
                                aria-controls="BooksLoan"
                                > <i class="fa-solid fa-book-open me-2"></i> Books Loan
                                <span class="right-icon float-end"> 
                                    <i class="fas fa-chevron-down"></i></span>
                                  </a>
                                  <div class="collapse" id="BooksLoan">
                                    <div > 
                                        <ul class="navbar-nav ps-3">
                                            <li>
                                                <a href="#" class="nav-link" ><i class="fas fa-plus me-2"></i> Add New Books</a>
                                            </li>
                                            <li>
                                                <a href="#" class="nav-link"><i class="fas fa-list me-2"></i> Manage All Books</a>
                                            </li>
                                        </ul>
                                        <li class="nav-item">
                                            <a class="nav-link sidebar-link" 
                                            data-bs-toggle="collapse" 
                                            href="#subscriptionMgmt" 
                                            role="button" 
                                            aria-expanded="false" 
                                            aria-controls="subscriptionMgmt"
                                            > <i class="fa-solid fa-rupee-sign me-2 "></i> Subscription
                                            <span class="right-icon float-end"> 
                                                <i class="fas fa-chevron-down"></i></span>
                                              </a>
                                            <div class="collapse" id="subscriptionMgmt">
                                                <div > 
                                                    <ul class="navbar-nav ps-3">
                                                        <li>
                                                            <a href="#" class="nav-link" ><i class="fas fa-plus me-2"></i>Plans</a>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="nav-link"><i class="fas fa-list me-2"></i>Purchase History</a>
                                                        </li>
                                                    </ul>

                                                    <li class="nav-item my-0">
                                                        <hr/>
                                                    </li>
                                                     <a class="nav-item">
                                                        <a class="nav-link active" aria-current="page" href="#">
                                                            <i class="fa-solid fa-right-from-bracket me-2"></i>Log Out </a>
                                                </div>   
                                            </div>
        <!--off canvas end-->

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
    </body>
    </html>