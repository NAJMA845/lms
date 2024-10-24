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
        <div class="row dashboard-counts">
            <div class="col-md-12">
                <h4 class="fw-bold text-uppercase">Membership List
                    <button type="button" style="float:right" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#subsModal">
                        Create Membership
                    </button>
                </h4>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Membership History
                    </div>
                    <div class="card-body">
                        <!--Search form-->
                        <form method="get">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <h5 class="fw-bold text-uppercase">Search</h5>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">From</label>
                                    <input type="date" class="form-control" name="from" />
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">To</label>
                                    <input type="date" class="form-control" name="to" />
                                </div>

                                <div class="col-md-3">
                                    <button type="submit" name="search" class="btn btn-primary btn-sm" style="margin-top:35px">
                                        Search
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!--Table-->
                        <div class="table-responsive">
                            <table id="data-table" class="table table-responsive table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Student Name</th>
                                        <th scope="col">Plan</th>
                                        <th scope="col">Start Date</th>
                                        <th scope="col">End Date</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Student Name 1</td>
                                        <td><span class="badge text-bg-info me-1">Plan 1</span> 1000</td>
                                        <td>01-01-2024</td>
                                        <td>01-02-2024</td>
                                        <td><span class="badge text-bg-success">Active</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Student Name 2</td>
                                        <td><span class="badge text-bg-info me-1">Plan 2</span> 1500</td>
                                        <td>01-03-2024</td>
                                        <td>01-04-2024</td>
                                        <td><span class="badge text-bg-danger">Expired</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!--Main content end-->

<!-- Modal to create subscription -->
<div class="modal fade" id="subsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create Subscription</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Select Student</label>
                                <select name="student_id" class="form-control">
                                    <option value="">Please select</option>
                                    <option value="1">Student 1</option>
                                    <option value="2">Student 2</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Select Plan</label>
                                <select name="plan_id" class="form-control">
                                    <option value="">Please select</option>
                                    <option value="1">Plan 1</option>
                                    <option value="2">Plan 2</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" name="submit" class="btn btn-success">
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
<?php include_once("../../include/footer.php")?>