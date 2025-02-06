<?php
include_once("../../config/config.php");
include_once("../../config/utility.php");
include_once("../../include/header.php");
include_once("../../include/topbar.php");
include_once("../../include/sidebar.php");

// Fetch subscriptions with search functionality
$where = "1=1";
if (isset($_GET['search'])) {
    if (!empty($_GET['from'])) {
        $from = $conn->real_escape_string($_GET['from']);
        $where .= " AND s.start_date >= '$from'";
    }
    if (!empty($_GET['to'])) {
        $to = $conn->real_escape_string($_GET['to']);
        $where .= " AND s.start_date <= '$to'";
    }
}

$sql = "SELECT u.guid,u.name as member_name,u.id as membership_no, 
       sp.title as plan_name, s.start_date,s.end_date,u.subscription_active,u.is_blocked 
        FROM subscriptions s 
        JOIN users u ON s.member_id = u.id 
        JOIN subscription_plans sp ON s.plan_id = sp.id 
        WHERE $where 
        ORDER BY s.created_at DESC";
$result = $conn->query($sql);

// Fetch all active users for dropdown
$users_sql = "SELECT id, name,nic_no FROM users WHERE is_blocked = 0  AND is_default<>1 and subscription_active <>1 ORDER BY created_at desc";
$users_result = $conn->query($users_sql);

$plans_sql = "SELECT id, title, amount FROM subscription_plans WHERE status = 1 ORDER BY title";
$plans_result = $conn->query($plans_sql);
?>

<!--Main content start-->
<main class="mt-1 pt-3">
    <div class="container-fluid">
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
                                    <input type="date" class="form-control" name="from" value="<?php echo $_GET['from'] ?? ''; ?>" />
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">To</label>
                                    <input type="date" class="form-control" name="to" value="<?php echo $_GET['to'] ?? ''; ?>" />
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
                                        <th scope="col" hidden="hidden">id</th>
                                        <th scope="col">#</th>
                                        <th scope="col">Member Name</th>
                                        <th scope="col">Membership No</th>
                                        <th scope="col">Plan</th>
                                        <th scope="col">Start Date</th>
                                        <th scope="col">End Date</th>
                                        <th scope="col">Subscription</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if ($result->num_rows > 0) {
                                        $counter = 1;
                                        while($row = $result->fetch_assoc()) {
                                            $subscription = $row['subscription_active'] == 1;
                                            $blocked = $row['is_blocked'] == 1;

                                    ?>
                                    <tr>
                                        <td hidden="hidden"><?php echo htmlspecialchars($row['guid']); ?></td>
                                        <th scope="row"><?php echo $counter++; ?></th>
                                        <td><?php echo htmlspecialchars($row['member_name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['membership_no']); ?></td>
                                        <td>
                                            <span class="badge text-bg-info me-1"><?php echo htmlspecialchars($row['plan_name']); ?></span>
                                        </td>
                                        <td><?php echo date('d-m-Y', strtotime($row['start_date'])); ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($row['end_date'])); ?></td>
                                        <td>
                                            <span class="badge text-bg-<?php echo $subscription ? 'success':'danger' ; ?>">
                                                <?php echo $subscription ? 'Active' : 'Expired'; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge text-bg-<?php echo $blocked ? 'danger' : 'success'; ?>">
                                                <?php echo $blocked ? 'Blocked' : 'Active'; ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php 
                                        }
                                    } else {
                                        echo "<tr><td colspan='9' class='text-center'>No subscriptions found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal to create subscription -->
<div class="modal fade" id="subsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create Subscription</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo BASE_URL?>/models/subscription.php">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Select User</label>
                                <select name="member_id" class="form-control" required>
                                    <option value="">Please select</option>
                                    <?php while($user = $users_result->fetch_assoc()) { ?>
                                        <option value="<?php echo $user['id']; ?>">
                                            <?php echo htmlspecialchars($user['nic_no']." - ".$user['name']); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Select Plan</label>
                                <select name="plan_id" class="form-control" required>
                                    <option value="">Please select</option>
                                    <?php while($plan = $plans_result->fetch_assoc()) { ?>
                                        <option value="<?php echo $plan['id']; ?>">
                                            <?php echo htmlspecialchars($plan['title']) . ' - Rs. ' . number_format($plan['amount'], 2); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" name="submit-membership" class="btn btn-success">Save</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once("../../include/footer.php"); ?>