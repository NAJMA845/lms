<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="<?php echo BASE_URL ?>assets/js/a0c7076c1c.js"></script>
    <link rel="stylesheet" href="<?php echo BASE_URL ?>assets/css/style.css"/>

    <link rel="stylesheet" href="<?php echo BASE_URL ?>assets/css/bootstrap.min.css"/>
    <script src="<?php echo BASE_URL ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo BASE_URL ?>assets/js/bootstrap.min.js"></script>


    <title>Dashboard | Online Library Management System</title>
    <style>
    /* Style the star ratings */
    .star-rating {
      direction: rtl; /* Align the stars from right to left */
      display: inline-block;
    }

    input[type="radio"] {
      display: none;
    }

    .star {
      font-size: 30px;
      color: #ccc; /* Default color of stars */
      cursor: pointer;
    }

    input:checked ~ label.star {
      color: gold; /* Highlight selected stars */
    }

    /* Change color of stars on hover */
    label.star:hover,
    input:checked ~ label.star:hover {
      color: #ffcc00;
    }

    input:checked ~ label.star:active {
      color: #ff9900;
    }

    /* Move the close button to the extreme right */
    .modal-header {
        position: relative;
    }
    .modal-header .close {
        position: absolute;
        right: 15px; /* Adjust the value as per your need */
        top: 15px;   /* Adjust the value as per your need */
    }
  </style>
    <script>
        function addRow(guid) {
            const table = document.getElementById("copiesTable").getElementsByTagName('tbody')[0];
            const newRow = table.insertRow();

            // Copy Number Field
            const copyCell = newRow.insertCell(0);
            const copyInput = document.createElement("input");
            copyInput.type = "text";
            copyInput.name = "copies[]";
            copyInput.className = "form-control";
            copyInput.placeholder = "Enter copy number";
            copyInput.readOnly = true; // Initially disabled
            // Set the guide attribute if guid is provided
            if (guid) {
                copyInput.setAttribute("guid", guid);
            }
            copyCell.appendChild(copyInput);

            // Action Buttons
            const actionCell = newRow.insertCell(1);
            actionCell.innerHTML = `
                <button type="button" class="btn btn-primary" onclick="toggleEdit(this)">Edit</button>
                <button type="button" class="btn btn-danger" onclick="deleteRow(this)">Delete</button>`;
        }

        function editRow(button) {

            const row = button.closest('tr');
            const input = row.cells[0].getElementsByTagName('input')[0];

            if (input.readOnly) {
                input.readOnly = false; // Enable the input field
                input.focus();
                button.textContent = "Save"; // Change button text to "Save"
            } else {
                input.readOnly = true; // Disable the input field
                button.textContent = "Edit"; // Change button text back to "Edit"
            }
        }

        function deleteRow(button) {
            const row = button.closest('tr');
            const input = row.querySelector('input[name="copies[]"]');
            const guid = input.getAttribute('guid');
            const copy_no = input.getAttribute('copy_no');

            // AJAX call to delete the book copy
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "<?php echo BASE_URL?>models/delete_copy.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                if (xhr.status === 200) {

                    row.remove();  // Remove the row from the table
                } else {

                }
            };
            xhr.send(`guid=${encodeURIComponent(guid)}&copy_no=${encodeURIComponent(copy_no)}`);
        }

        function toggleEdit(button) {
            const row = button.closest('tr');
            const input = row.querySelector('input[name="copies[]"]');

            if (button.textContent === "Edit") {
                // Switch to 'Done' state
                input.readOnly = false; // Enable the input for editing
                button.textContent = "Save"; // Change button text to 'Done'

            } else if (button.textContent === "Save") {
                // Trigger AJAX and switch back to 'Edit' state
                const guid = input.getAttribute('guid');
                const copy_no = input.getAttribute('copy_no');
                const updatedValue = input.value;
                // AJAX call to update the database
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "<?php echo BASE_URL?>models/update_copy.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                xhr.onload = function () {
                    if (xhr.status === 200) {
                        if (xhr.responseText === "success") {
                            alert("Updated successfully");
                        } else {
                            alert("Duplicate entry found.");
                        }
                    } else {
                        alert("Update failed: " +xhr.responseText);
                    }
                };
                input.readOnly = true; // Disable the input after updating
                button.textContent = "Edit"; // Change button text back to 'Edit'
                xhr.send(`guid=${encodeURIComponent(guid)}&copy_no=${encodeURIComponent(copy_no)}&updatedValue=${encodeURIComponent(updatedValue)}`);
            }
        }

        function showDeleteConfirmation(button) {
            $('#deleteConfirmationModal').modal('show');
            $('#confirmDelete').off('click').on('click', function() {
                deleteRow(button);
                $('#deleteConfirmationModal').modal('hide');
            });
        }
    </script>
    </head>
    <body>
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Confirm Action</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body" id="modalMessage">
                    Are you sure you want to proceed with this action?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancelDelete">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>
