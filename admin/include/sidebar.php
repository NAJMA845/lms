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
                                <a href="<?php echo BASE_URL ?>books/add.php" class="nav-link" ><i class="fas fa-plus me-2"></i> Add New Books</a>
                            </li>
                            <li>
                                <a href="<?php echo BASE_URL ?>books/index.php" class="nav-link"><i class="fas fa-list me-2"></i> Manage All Books</a>
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