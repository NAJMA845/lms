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
            
            <li class="nav-item">
                <a class="nav-link active" aria-current="page"
                   href="./user-dashboard.php"><i class="fas fa-tachometer me-2"></i> User Dashboard </a>
            </li>
            <li>
                <a class="nav-link sidebar-link"
                   data-bs-toggle="collapse"
                   href="#SearchBooksOptions"
                   role="button"
                   aria-expanded="false"
                   aria-controls="SearchBooksOptions">
                    <i class="fas fa-search me-2"></i> Search Books
                    <span class="right-icon float-end">
                        <i class="fas fa-chevron-down"></i>
                    </span>
                </a>
                <div class="collapse" id="SearchBooksOptions">
                    <ul class="navbar-nav ps-3">
                        <li>
                            <a href="<?php echo ADMIN_BASE_URL ?>search-book/search-books.php" class="nav-link">
                                <i class="fas fa-search me-2"></i> Search Books
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo ADMIN_BASE_URL ?>search-book/reviewed-rated-books.php" class="nav-link">
                                <i class="fas fa-star me-2"></i> Reviewed & Rated Books
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page"
                   href="./reserve-books.php"><i class="fas fa-bookmark me-2"></i>  Reserve Books </a>
            </li>
            <li class="nav-item my-0">
                <hr/>
            </li>
            <?php 
            if($_SESSION['user_type']=="1"){
                include_once("admin-area.php"); 
            }

            ?>
                <a class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">
                        <i class="fa-solid fa-right-from-bracket me-2"></i>Log Out </a>
                    </div>
                </div>
                                        <!--off canvas end--> paste this code