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
                <h4 class="fw-bold text-uppercase">Membership Plan</h4>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        All Plans
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="data-table" class="table table-responsive table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Duration</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Example Row -->
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Basic Plan</td>
                                        <td><i class="fa-solid fa-rupee-sign me-2"></i> 500</td>
                                        <td>12 months</td>
                                        <td><span class="badge text-bg-success">Active</span></td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                            <a onclick="return confirm('Do you want to delete this?')" href="#" class="btn btn-danger btn-sm">Delete</a>
                                            <a href="#" class="btn btn-warning btn-sm">Inactive</a>
                                        </td>
                                    </tr>
                                    <!-- Add more rows as needed -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Add New Plan
                    </div>
                    <div class="card-body">
                        <form method="post" action="#">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control" name="title" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Amount</label>
                                        <input type="text" class="form-control" name="amount" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Duration</label>
                                        <select class="form-control" name="duration">
                                            <option value="">Please select</option>
                                            <!-- Duration options -->
                                            <option value="1">1 month</option>
                                            <option value="12">12 months</option>
                                            <!-- Add more options as needed -->
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" name="submit" class="btn btn-success">Save</button>
                                    <button type="reset" class="btn btn-secondary">Cancel</button>
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