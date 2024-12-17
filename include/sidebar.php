<!--Off canvas start-->
<div class="offcanvas offcanvas-start bg-dark text-white sidebar-nav"
     tabindex="-1"
     id="offcanvasExample"
     aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-body">
        <ul class="navbar-nav">
            <li class="nav-item">
                <div class="text-secondary text-uppercase fw-bold">Core</div>
            </li>
            <div class="admin" style="display: block;">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page"
                       href="./subscrption-purchase-history.php"><i class="fas fa-tachometer-alt me-2"></i> Admin Dashboard </a>
                </li>
            </div>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page"
                   href="./subscrption-purchase-history.php"><i class="fas fa-tachometer me-2"></i> User Dashboard </a>
            </li>
            <li>
                <a href="<?php echo ADMIN_BASE_URL ?>search-book/search-books.php" class="nav-link"><i
                class="fas fa-search me-2"></i> Search Books </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page"
                   href="./reserve-books.php"><i class="fas fa-bookmark me-2"></i>  Reserve Books </a>
            </li>
            <li class="nav-item my-0">
                <hr/>
            </li>
            <div class="admin" style="display: block;">
                <li class="nav-item">
                    <div class="text-secondary text-uppercase fw-bold">Library Operation</div>
                </li>
                <li class="nav-item">
                    <a class="nav-link sidebar-link"
                       data-bs-toggle="collapse"
                       href="#BooksLoan"
                       role="button"
                       aria-expanded="false"
                       aria-controls="BooksLoan"
                    >
                        <i class="fa-solid fa-book-open me-2"></i> Burrowing & Returning
                        <span class="right-icon float-end">
                                    <i class="fas fa-chevron-down"></i>
                                </span>
                    </a>
                    <div class="collapse" id="BooksLoan">
                        <div>
                            <ul class="navbar-nav ps-3">
                                <li>
                                    <a href="<?php echo ADMIN_BASE_URL ?>lending/add.php" class="nav-link"><i
                                            class="fas fa-plus me-2"></i> Add New </a>
                                </li>
                                <li>
                                    <a href="<?php echo ADMIN_BASE_URL ?>lending/index.php" class="nav-link"><i
                                            class="fas fa-list me-2"></i> Manage All </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                <li class="nav-item">
                    <a class="nav-link sidebar-link"
                       data-bs-toggle="collapse"
                       href="#subscriptionMgmt"
                       role="button"
                       aria-expanded="false"
                       aria-controls="subscriptionMgmt"
                    > <i class="fa-solid fa-user-plus me-2 "></i> Membership
                        <span class="right-icon float-end">
                                    <i class="fas fa-chevron-down"></i></span>
                    </a>
                    <div class="collapse" id="subscriptionMgmt">
                        <div>
                            <ul class="navbar-nav ps-3">
                                <li>
                                    <a href="<?php echo ADMIN_BASE_URL ?>subscriptions/index.php"
                                       class="nav-link"><i class="fas fa-plus me-2"></i>Membership Plans</a>
                                </li>
                                <li>
                                    <a href="<?php echo ADMIN_BASE_URL ?>subscriptions/subscrption-purchase-history.php"
                                       class="nav-link"><i class="fas fa-list me-2"></i>Manage Membership</a>
                                </li>
                            </ul>

                            <li class="nav-item">
                                <a class="nav-link sidebar-link"
                                   data-bs-toggle="collapse"
                                   href="#MultimediaMgmt"
                                   role="button"
                                   aria-expanded="false"
                                   aria-controls="MultimediaMgmt"> <i class="fas fa-headphones me-2"></i> Multimedia Room
                                    <span class="right-icon float-end"> <i class="fas fa-chevron-down"></i></span>
                                </a>
                                <div class="collapse" id="MultimediaMgmt">
                                    <div>
                                        <ul class="navbar-nav ps-3">
                                            <li>
                                                <a href="<?php echo ADMIN_BASE_URL ?>multimedia/add.php" class="nav-link"><i
                                                        class="fas fa-plus me-2"></i> Add New </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo ADMIN_BASE_URL ?>multimedia/index.php" class="nav-link"><i
                                                        class="fas fa-list me-2"></i> Manage All</a>
                                            </li>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link sidebar-link"
                                   data-bs-toggle="collapse"
                                   href="#LateFee"
                                   role="button"
                                   aria-expanded="false"
                                   aria-controls="LateFee"> <i class="fas fa-hand-holding-dollar me-2"></i> Late Fee
                                    <span class="right-icon float-end"> <i class="fas fa-chevron-down"></i></span>
                                </a>
                                <div class="collapse" id="LateFee">
                                    <div>
                                        <ul class="navbar-nav ps-3">
                                            <li>
                                                <a href="<?php echo ADMIN_BASE_URL ?>late-fee/add.php" class="nav-link"><i
                                                        class="fas fa-plus me-2"></i> Add New </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo ADMIN_BASE_URL ?>late-fee/index.php" class="nav-link"><i
                                                        class="fas fa-list me-2"></i> Manage All</a>
                                            </li>
                                    </div>
                                </div>
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
                                    <div>
                                        <ul class="navbar-nav ps-3">
                                            <li>
                                                <a href="<?php echo ADMIN_BASE_URL ?>books/add.php" class="nav-link"><i
                                                        class="fas fa-plus me-2"></i> Add New </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo ADMIN_BASE_URL ?>books/index.php" class="nav-link"><i
                                                        class="fas fa-list me-2"></i> Manage All</a>
                                            </li>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item my-0">
                                <hr/>
                            </li>
                            <li class="nav-item">
                                <div class="text-secondary text-uppercase fw-bold">User Management</div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link sidebar-link"
                                   data-bs-toggle="collapse"
                                   href="#MemberMgmt"
                                   role="button"
                                   aria-expanded="false"
                                   aria-controls="MemberMgmt">
                                    <i class="fas fa-users me-2"></i> User Management
                                    <span class="right-icon float-end">
                                <i class="fas fa-chevron-down"></i></span>
                                </a>
                                <div class="collapse" id="MemberMgmt">
                                    <div>
                                        <ul class="navbar-nav ps-3">
                                            <li>
                                                <a href="<?php echo ADMIN_BASE_URL ?>users/add.php" class="nav-link"><i
                                                        class="fas fa-plus me-2"></i> Add New </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo ADMIN_BASE_URL ?>users/index.php" class="nav-link"><i
                                                        class="fas fa-list me-2"></i> Manage All </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <a class="nav-item">
                                <a class="nav-link active" aria-current="page" href="<?php echo ADMIN_BASE_URL ?>reports/index.php">
                                    <i class="fa-solid fa-file-contract me-2"></i>  Reports </a>
                            </a>
                            <li class="nav-item my-0">
                                <hr/>
                            </li>
            </div>

                <a class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">
                        <i class="fa-solid fa-right-from-bracket me-2"></i>Log Out </a>
                    </div>
                </div>
                                        <!--off canvas end--> paste this code