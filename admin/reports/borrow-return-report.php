<?php
include_once("../../config/config.php");
include_once("../../include/header.php");
include_once("../../include/topbar.php");
include_once("../../include/sidebar.php");

// Sample recent borrowing and returning data
$recentReports = [
    [
        'id' => 1,
        'copy_id' => 'C12345',
        'book_name' => 'Introduction to PHP',
        'membership_number' => '5056',
        'loan_date' => '2024-12-01',
        'return_date' => '2024-12-15',
        'status' => 'Returned',
        'created_at' => '2024-12-01 10:00:00',
    ],
    [
        'id' => 2,
        'copy_id' => 'C67890',
        'book_name' => 'Learning JavaScript',
        'membership_number' => '0241',
        'loan_date' => '2024-12-10',
        'return_date' => '2024-12-24',
        'status' => 'Borrowed',
        'created_at' => '2024-12-10 14:30:00',
    ],
];
?>

<main>
    <div class="container">
        <div class="col-md-12 text-end">
            <button id="printReport" class="btn btn-primary btn-sm" onclick="window.print()">
                <i class="fas fa-print"></i> Print Report
            </button>
        </div>

       <!-- Report Form -->
       <div class="row">
            <div class="col-md-12">
                <form method="post" action="" onsubmit="generateReport(event)">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="module" class="form-label">Select Report Module</label>
                                <select name="module" id="module" class="form-control" required>
                                    <option value="">Select Module</option>
                                    <option value="profile">Profile</option>
                                    <option value="admin_dashboard">Admin Dashboard</option>
                                    <option value="user_dashboard">User Dashboard</option>
                                    <option value="reviewed_rated_books">Reviewed & Rated Books</option>
                                    <option value="reserve_books">Reserve Books</option>
                                    <option value="borrow_return">Borrowing & Returning</option>
                                    <option value="membership_plan">Membership Plan</option>
                                    <option value="membership_history">Membership History</option>
                                    <option value="multimedia_room">Multimedia Room</option>
                                    <option value="late_fee">Late Fee</option>
                                    <option value="books_management">Books Management</option>
                                    <option value="user_management">User Management</option>
                                    <!-- Additional modules can be added here -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="startDate" class="form-label">Start Date</label>
                                <input type="date" name="startDate" id="startDate" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="endDate" class="form-label">End Date</label>
                                <input type="date" name="endDate" id="endDate" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-chart-line"></i> Generate Report
                            </button>
                            <button type="reset" class="btn btn-secondary">
                                <i class="fas fa-redo"></i> Reset
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br>

        <!-- Report Overview -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Borrowing & Returning Report Overview
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Copy ID</th>
                                        <th>Book Name</th>
                                        <th>Membership Number</th>
                                        <th>Loan Date</th>
                                        <th>Return Date</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recentReports as $index => $report): ?>
                                        <tr>
                                            <td><?php echo $index + 1; ?></td>
                                            <td><?php echo $report['copy_id']; ?></td>
                                            <td><?php echo $report['book_name']; ?></td>
                                            <td><?php echo $report['membership_number']; ?></td>
                                            <td><?php echo $report['loan_date']; ?></td>
                                            <td><?php echo $report['return_date']; ?></td>
                                            <td><?php echo $report['status']; ?></td>
                                            <td><?php echo $report['created_at']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<script>
function generateReport(event) {
    event.preventDefault(); // Prevent the form from submitting

    var startDate = document.getElementById('startDate').value;
    var endDate = document.getElementById('endDate').value;
    var module = document.getElementById('module').value;

    if (startDate && endDate && module) {
        // Redirect to the specific report page based on the selected module
        var url;
        switch (module) {
            case 'profile':
                url = 'profile-report.php?start=' + startDate + '&end=' + endDate;
                break;
            case 'search_books':
                url = 'search-books-report.php?start=' + startDate + '&end=' + endDate;
                break;
            case 'admin_dashboard':
                url = 'admin-dashboard-report.php?start=' + startDate + '&end=' + endDate;
                break;
            case 'user_dashboard':
                url = 'user-dashboard-report.php?start=' + startDate + '&end=' + endDate;
                break;
            case 'reviewed_rated_books':
                url = 'reviewed-rated-books-report.php?start=' + startDate + '&end=' + endDate;
                break;
            case 'reserve_books':
                url = 'reserve-books-report.php?start=' + startDate + '&end=' + endDate;
                break;
            case 'borrow_return':
                url = 'borrow-return-report.php?start=' + startDate + '&end=' + endDate;
                break;
            case 'membership_plan':
                url = 'membership-plan-report.php?start=' + startDate + '&end=' + endDate;
                break;
            case 'membership_history':
                url = 'membership-history-report.php?start=' + startDate + '&end=' + endDate;
                break;
            case 'multimedia_room':
                url = 'multimedia-room-report.php?start=' + startDate + '&end=' + endDate;
                break;
            case 'late_fee':
                url = 'late-fee-report.php?start=' + startDate + '&end=' + endDate;
                break;
            case 'books_management':
                url = 'books-management-report.php?start=' + startDate + '&end=' + endDate;
                break;
            case 'user_management':
                url = 'user-management-report.php?start=' + startDate + '&end=' + endDate;
                break;
            // Additional cases can be added here
            default:
                alert('Invalid module selected.');
                return;
        }

        window.location.href = url;
    } else {
        alert('Please fill all the required fields.');
    }
}
</script>

<?php include_once("../../include/footer.php"); ?>
