
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
    <script src="./assets/js/a0c7076c1c.js"></script>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <title>Login | Online Library Management System</title>
    </head>
    <link rel="stylesheet" href="./assets/css/style.css"/>
    <body style="background:#212529">
        <div class="container d-flex align-items-center justify-content-center vh-100">
            <div class="row">
                <div class="col-md-12 login-form">
                    <div class="card mb-3" style="max-width: 900px;">
                        <div class="row g-0">
                          <div class="col-md-5">
                            <img src="./assets/images/login-bg.jpeg" class="img-fluid rounded-start" alt="...">
                          </div>
                          <div class="col-md-7">
                            <div class="card-body">
                              <h1 class="card-title text-uppercase fw-bold">Smartlib</h1>
                              <p class="card-text">Enter email and password to login</p>
                              <form action="./dashboard.php">
                                <div class="mb-3">
                                  <label for="exampleInputEmail1" 
                                  class="form-label">Email address</label>
                                  <input type="email" 
                                  class="form-control" 
                                  id="exampleInputEmail1" 
                                  aria-describedby="emailHelp">
                                <div class="mb-3">
                                  <label for="exampleInputPassword1" 
                                  class="form-label">Password</label>
                                  <input type="password" 
                                  class="form-control" 
                                  id="exampleInputPassword1">
                                </div>
                                <button type="submit" 
                                class="btn btn-primary">Login Now</button>
                              </form>
                              <hr/>
                              <a href="./forgot-password.php" class="card-link link-underline-light text-center">Forgot Password?</a>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </body>
</html>