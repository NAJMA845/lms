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
                <h4 class="fw-bold text-uppercase">Add Loan</h4>
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
                                        <label class="form-label">Select Book</label>
                                        <select name="book_id" class="form-control">
                                            <option value="">Please select</option>
                                            <option value="1">Book Title 1</option>
                                            <option value="2">Book Title 2</option>
                                            <!-- Add more options as needed -->
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Select Student</label>
                                        <select name="student_id" class="form-control">
                                            <option value="">Please select</option>
                                            <option value="1">Student Name 1</option>
                                            <option value="2">Student Name 2</option>
                                            <!-- Add more options as needed -->
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Loan Date</label>
                                        <input type="date" class="form-control" name="loan_date" required />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Return/Due Date</label>
                                        <input type="date" class="form-control" name="return_date" required />
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