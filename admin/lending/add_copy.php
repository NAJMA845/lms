<?php
include_once("../../config/config.php");
include_once("../../include/header.php");
include_once("../../include/topbar.php");
include_once("../../include/sidebar.php");
?>
<!-- Main content start -->
<!-- Main content start -->
<main class="mt-1 pt-3">
    <div class="container-fluid">
        <!-- Book Borrow & Return -->
        <div class="row">
            <div class="col-md-12">
                <h4 class="fw-bold text-uppercase">Library Transaction</h4>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Fill the form
                    </div>
                    <div class="card-body">
                        <form method="post" action="#" id="libraryForm" onsubmit="return validateForm()">
                            <div class="row">
                                <!-- Book No Input -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="bookNo">Book No</label>
                                        <input type="text" name="bookNo" id="bookNo"
                                               class="form-control" onkeydown="validateEntry(event, 'bookNo')"
                                               placeholder="Enter Book No" required />
                                    </div>
                                </div>

                                <!-- Membership No Input (Hidden for Return) -->
                                <div class="col-md-6" id="membershipField" style="display: none;">
                                    <div class="mb-3">
                                        <label for="membershipNo">Membership No</label>
                                        <input type="text" name="membershipNo" id="membershipNo"
                                               class="form-control" placeholder="Enter Membership No"
                                               onkeydown="validateEntry(event, 'membershipNo')" />
                                        <span id="membershipError" class="text-danger" style="display: none;">
                                            Membership No is required for borrowing.
                                        </span>
                                    </div>
                                </div>

                                <!-- Dynamic Action Display -->
                                <div class="col-md-12">
                                    <p><strong>Action:</strong> <span id="actionText">Waiting for input...</span></p>
                                </div>

                                <!-- Submit & Reset Buttons -->
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success" id="submitButton" disabled>
                                        Confirm Action
                                    </button>
                                    <button type="reset" class="btn btn-secondary" onclick="resetForm()">
                                        Reset
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

<?php
include_once("../../include/footer.php");
?>
<!-- JavaScript for Dynamic Behavior -->
<script>
    let isBorrowing = false; // Track if the action is borrowing

    function checkBookStatus() {
        let bookNo = document.getElementById("bookNo").value.trim();
        let membershipField = document.getElementById("membershipField");
        let actionText = document.getElementById("actionText");
        let submitButton = document.getElementById("submitButton");

        if (bookNo === "") {
            actionText.innerHTML = "Waiting for input...";
            membershipField.style.display = "none";
            submitButton.disabled = true;
            isBorrowing = false;
            return;
        }

        try {
            //This method also allowed but I prefer the second one due to formal way
            //const data = await checkBookBorrowStatus(bookNo);
            checkBookBorrowStatus(bookNo)
                .then(result => {
                        if(result){
                            //Someone borrowed but notyet retuend
                            if(result.borrowed_date!=null && result.returned_date==null){
                                actionText.innerHTML = "Returning this book. Membership Card is not required";
                                membershipField.style.display = "none"; // Hide membership input
                                isBorrowing = false;
                                submitButton.disabled = false; // Enable the submit button
                            }
                            //book available
                            else{
                                actionText.innerHTML = "Borrowing this book. Membership Card is required.";
                                membershipField.style.display = "block"; // Show membership input
                                isBorrowing = true;
                                submitButton.disabled = false; // Enable the submit button
                            }
                        }
                        else{
                            console.log("No records");
                        }
                })
                .catch(error => {
                        actionText.innerHTML = "Borrowing this book. Membership No required.";
                        membershipField.style.display = "block";
                        isBorrowing = true;
                        submitButton.disabled = false;
                });
        } catch (error) {
            console.error(error);
            actionText.innerHTML = "Error checking book status.";
            membershipField.style.display = "none";
            submitButton.disabled = true;
        }
    }


    function checkBookBorrowStatus(bookNo) {
        return new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", '<?PHP echo BASE_URL;?>models/book_tran.php', true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function() {
                if (xhr.status === 200) {
                    const data = JSON.parse(xhr.responseText);
                    resolve(data);
                } else {
                    console.error("Request failed with status: " + xhr.statusText);
                    reject("Request failed");
                }
            };
            xhr.onerror = function() {
                console.error("Request failed");
                reject("Request failed");
            };
            const params = `bookNo=${encodeURIComponent(bookNo)}&check=${encodeURIComponent('check')}`;
            xhr.send(params);
        });
    }

    function submitBookTran(bookNo,membershipNo) {
        return new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", '<?PHP echo BASE_URL;?>models/book_tran_submit.php', true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function() {
                if (xhr.status === 200) {
                    const data = JSON.parse(xhr.responseText);
                    resolve(data);
                } else {
                    console.error("Request failed with status: " + xhr.statusText);
                    reject("Request failed");
                }
            };
            xhr.onerror = function() {
                console.error("Request failed");
                reject("Request failed");
            };
            const params = `bookNo=${encodeURIComponent(bookNo)}&membershipNo=${encodeURIComponent(membershipNo)}`;
            xhr.send(params);
        });
    }

    function validateForm() {
        //If it is a borrowing process, then check the membrship status or eligibility
        if (isBorrowing) {
            let membershipNo = document.getElementById("membershipNo").value.trim();
            let membershipError = document.getElementById("membershipError");

            if (membershipNo === "" || !isValidMembership(membershipNo)) {
                membershipError.style.display = "block";
                return false; // Prevent form submission
            } else {
                membershipError.style.display = "none";
                //document.getElementById("submitButton").click(); // Auto-submit for borrowing
                return true;
            }
        }
        return true; // Allow form submission
    }

    function isValidMembership(membershipNo) {
        // Example validation: Must be at least 5 characters long
        return membershipNo.length >= 5;
    }

    function resetForm() {
        document.getElementById("actionText").innerHTML = "Waiting for input...";
        document.getElementById("membershipField").style.display = "none";
        document.getElementById("submitButton").disabled = true;
        document.getElementById("membershipError").style.display = "none";
    }

    async function validateEntry(event, field) {
        if (event.key === "Enter") {
            event.preventDefault(); // Prevent default form submission

            if (field === "bookNo") {
                await checkBookStatus();

                if (!isBorrowing) {
                    console.log("Entering if..");
                    submitBookTran(document.getElementById("bookNo").value.trim(),'')
                        .then(

                        )
                        .catch()
                }
            } else if (field === "membershipNo") {
                console.log("Entering else..");
                if (validateForm()) {
                    submitBookTran(document.getElementById("bookNo").value.trim(),document.getElementById("membershipNo").value.trim())
                        .then()
                        .catch()
                }
            }
        }
    }
</script>