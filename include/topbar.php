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

                  <div class="input-group my-3 my-lg-0 ">



                  </div>

                <ul class="navbar-nav mb-2 mb-lg-0">
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" 
                    role="button" data-bs-toggle="dropdown" 
                    aria-expanded="false"
                    >
                    <img src="<?php echo BASE_URL ?>assets/images/user.jpeg" class="user-icon" alt="User icon"/> 
                      <?php echo $_SESSION['user_email'] ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
<!--                      <li><a class="dropdown-item" href="#">My Profile</a></li>-->
                      <li><a class="dropdown-item" href="/lms/change-password.php">Change Password</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item"  href="javascript:void(0);" onclick="confirmLogout()">Log Out</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
        </nav>
        <script>
          function confirmLogout() {
            if (confirm("Are you sure you want to log out?")) {
              window.location.href = "/lms/logout.php"; // Redirect to logout page if confirmed
            }
          }
        </script>

        <!--Top navbar end-->