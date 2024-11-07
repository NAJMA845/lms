<?php 
include_once("../../config/config.php");
include_once("../../include/header.php");
include_once("../../include/topbar.php");
include_once("../../include/sidebar.php");
?>

<!--Main content start-->
<main class="mt-1 pt-3">
    <div class="container-fluid">
        <!--Cards-->
        <div class="row">
            <div class="col-md-12">
                <h4 class="fw-bold text-uppercase">Book Lending</h4>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Fill the form
                    </div>
                    <div class="card-body">
                        <form method="post" action="#">
                            <div class="row">
                                <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="title">Book No</label>
                                            <input type="text" name="title" id="title"
                                            class="form-control"  title="Enter the title"  />

                                        </div>
                                </div>
                                <div class="col-md-6">
                                <div class="mb-3">
                                            <label for="title">Membership No</label>
                                            <input type="text" name="title" id="title"
                                            class="form-control"  title="Enter the title"  />

                                        </div>
                                </div>


                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success">
                                        Save
                                    </button>

                                    <button type="reset" class="btn btn-secondary">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <hr>
    <br>
    <!-- Return -->

    <div class="container-fluid">
        <!--Cards-->
        <div class="row">
            <div class="col-md-12">
                <h4 class="fw-bold text-uppercase">Book Return</h4>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Fill the form
                    </div>
                    <div class="card-body">
                        <form method="post" action="#">
                        <div class="row">
                                <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="title">Book No</label>
                                            <input type="text" name="title" id="title"
                                            class="form-control"  title="Enter the title"  />

                                        </div>
                                </div>
                            

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success">
                                        Save
                                    </button>

                                    <button type="reset" class="btn btn-secondary">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
<!--Main content end-->

   <?php include_once("../../include/footer.php")?>