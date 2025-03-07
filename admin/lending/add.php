<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/config/config.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/header.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/topbar.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lms/include/sidebar.php");
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
                        <div class="row">
                            <!-- Membership No Input (Hidden for Return) -->
                            <div class="col-md-6" id="membershipField">
                                <div class="mb-3">
                                    <label for="membershipNo">Membership No</label>
                                    <input type="text" name="membershipNo" id="membershipNo"
                                           class="form-control" placeholder="Enter Membership No" onkeydown="goToNextControl(event);">
                                    <span id="membershipMissing" class="text-danger" style="display: none;">
                                        Membership No is required for borrowing.
                                    </span>
                                    <span id="membershipError" class="text-danger" style="display: none;">
                                        Membership No is blocked.
                                    </span>
                                    <span id="membershipExceeded" class="text-danger" style="display: none;">
                                        Member has already borrowed upto permitted limit.
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                           <!-- Book No Input -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="bookNo">Book No</label>
                                    <input type="text" name="bookNo" id="bookNo"
                                           class="form-control" onkeydown="validateEntry(event)"
                                           placeholder="Enter Book No" required />
                                </div>
                            </div>

                            <!-- Dynamic Action Display -->
                            <div class="col-md-12">
                                <p><strong>Action:</strong> <span id="actionText">Waiting for input...</span></p>
                            </div>

                            <!-- Submit & Reset Buttons -->
                            <div class="col-md-12">
                                <button type="button" class="btn btn-success" id="submitButton">
                                    Process
                                </button>
                                <button type="button" class="btn btn-secondary" id="submitButton" onclick="resetForm();">
                                    Clear Form
                                </button>
                            </div>
                        </div>
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
    resetForm();
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

    function resetForm() {
        document.getElementById("actionText").innerHTML = "Waiting for input...";
        document.getElementById("membershipError").style.display = "none";
        document.getElementById("membershipMissing").style.display = "none";
        document.getElementById("membershipExceeded").style.display = "none";
        document.getElementById("membershipNo").value="";
        document.getElementById("bookNo").value="";
        document.getElementById("membershipNo").focus();
    }

    async function validateEntry(event) {
        if (event.key === "Enter") {
            event.preventDefault(); // Prevent default form submission
            submitBookTran(document.getElementById("bookNo").value.trim(),document.getElementById("membershipNo").value.trim())
                .then(result=>{
                    if(result){
                        document.getElementById("bookNo").value="";
                        let infoLabel = document.getElementById("actionText");

                        if (result.status == "success") {
                            infoLabel.classList.remove("text-danger");
                            infoLabel.classList.add("text-success", "fw-bold");
                        } else {
                            infoLabel.classList.remove("text-success");
                            infoLabel.classList.add("text-danger", "fw-bold");
                        }
                        infoLabel.innerHTML = result.info;
                    }
                }
                )
                .catch()
        }
    }

    function goToNextControl(event) {
        if (event.key === "Enter") {
            document.getElementById("bookNo").focus();
        }
    }
</script>