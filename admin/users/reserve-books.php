<?php
include_once("../../config/config.php");
include_once("../../config/database.php");
include_once("../models/book.php");


//Add Book Functionality
if (isset($_POST['publish'])) {
    $res = storeBook($conn, $_POST);
    if (isset($res['success'])) {
        $_SESSION['success'] = "Book has been created Successfully";
        header("LOCATION:" . ADMIN_BASE_URL . "books");
    } else {
        $_SESSION['error'] = $res["error"];//"Something went wrong, please try again.";
        //header("LOCATION:" . BASE_URL . "books/add.php");
    }
}

include_once("../../include/header.php");
include_once("../../include/topbar.php");
include_once("../../include/sidebar.php");
?>

        <!--main content start-->
        <main class="mt-1 pt-3">
            <div class="container-fluid">
                <!--Cards-->
                <div class="row dashboard-counts">
                    <div class="col-md-12">
                    <?php include_once("../../include/alerts.php"); ?>
                       <h4 class="fw-bold text-uppercase"> Add Book </h4>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                              Fill the form
                            </div>
                                    <div class="card-body">
                                        <form method="post" action="<?php echo ADMIN_BASE_URL?>books/add.php" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="title">Book Name</label>
                                                        <input type="text" name="title" id="title"
                                                         class="form-control"  title="Enter the title"  />

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="isbn" class="form-label">ISBN Number</label>
                                                        <input type="text" name="isbn" id="isbn" class="form-control" 
                                                        required="required" title="Enter the ISBN number"/>
                                                        
                                                    </div>
                                                </div>
                        
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="author" class="form-label">Author Name</label>
                                                        <input type="text" name="author" id="author" 
                                                        class="form-control" required title="Enter the author's name" />

                                                    </div>
                                                </div>
                        
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="publication_year" class="form-label">Publication Year</label>
                                                        <input type="number" name="publication_year" id="publication_year" 
                                                        class="form-control" required title="Enter the year of publication" 
                                                        />

                                                    </div>
                                                </div>
                        
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="category_id" class="form-label">Category</label>
                                                        <?php 
                                                        $cats = getCategories($conn);
                                                       ?>
                                                            <select name="category_id" id="category_id" 
                                                            class="form-control" required title="Select the category of the item">
                                                                <option value="">Please select</option>
                                                                <?php while ($row = $cats->fetch_assoc()) { ?>
                                                              <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                                              <?php } ?>
                                                            </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="category_id" class="form-label">Upload PDF</label>
                                                        <?php 
                                                        $cats = getCategories($conn);
                                                       ?>
                                                       <br>
                                                            <input type="file" name="pdf" id="pdf" accept="application/pdf">
                                                            
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                    <h5 class="mt-4">Book Copies</h5>
                                    <table class="table table-bordered" id="copiesTable">
                                        <thead>
                                            <tr>
                                                <th>Copy Number</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Initial empty row to add new copies -->
                                            <tr>
                                                <td><input type="text" name="copies[]" class="form-control" placeholder="Enter copy number" /></td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" onclick="editRow(this)">Edit</button>
                                                    <button type="button" class="btn btn-danger" onclick="deleteRow(this)">Delete</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="button" class="btn btn-secondary" onclick="addRow()">Add Copy</button>
                                </div>
                        
                                                <div class="col-md-12">
                                                    <button name="publish" type="submit" class="btn btn-success">
                                                        Publish
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
                        <script>
function addRow() {
    const table = document.getElementById("copiesTable").getElementsByTagName('tbody')[0];
    const newRow = table.insertRow();
    
    // Copy Number Field
    const copyCell = newRow.insertCell(0);
    const copyInput = document.createElement("input");
    copyInput.type = "text";
    copyInput.name = "copies[]";
    copyInput.className = "form-control";
    copyInput.placeholder = "Enter copy number";
    copyCell.appendChild(copyInput);

    // Action Buttons
    const actionCell = newRow.insertCell(1);
    actionCell.innerHTML = `
        <button type="button" class="btn btn-primary" onclick="editRow(this)">Edit</button>
        <button type="button" class="btn btn-danger" onclick="deleteRow(this)">Delete</button>`;
}

function editRow(button) {
    const row = button.closest('tr');
    const input = row.cells[0].getElementsByTagName('input')[0];
    input.focus();
}

function deleteRow(button) {
    const row = button.closest('tr');
    row.remove();
}
</script>
        <!--main content end-->

        <?php
include_once("../../include/footer.php");
?>