<?php
session_start();
if (!isset($_SESSION['lecturer'])) {
    header("location: ../login");
} else { ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="assets/images/uniabuja-logo.jpg" type="image/x-icon">
        <title>Add Courses</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <style>
            label {
                color: gray;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <?php

            $id = 0;
            $update = false;
            $subject_name = '';
            $subject_code = '';
            $semester = '';
            $department = '';

            if (isset($_GET['edit'])) {

                require("dbconn2.php");

                $id = $_GET['edit'];
                $update = true;

                $sql =  "SELECT * FROM subjects WHERE subject_code = '$id'";
                $pds = $pdo->prepare($sql);
                $pds->execute(array("edit" => $_GET["edit"]));
                $row = $pds->fetch(PDO::FETCH_ASSOC);

                $subject_name = $row['subject_name'];
                $subject_code = $row['subject_code'];
                $semester = $row['semester'];
                $department = $row['department'];
            }
            ?>
        </div>
        <div class="container">
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </symbol>
                <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                </symbol>
                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </symbol>
            </svg>
        </div>

        <div class="container mt-5">
            <div>
                <a href="dashboard" class="btn btn-dark">Back to dashboard</a>
                <a href="courses" class="btn btn-success">View courses</a>
            </div>
            <div class="mt-5">
                <h1>Add courses you take</h1>
                <p>Add your course to the system</p>
            </div>
            <hr>
            <?php if (isset($_SESSION['success'])) { ?>
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    <div>
                        <?php echo $_SESSION['success']; ?>
                    </div>
                </div>
                <?php unset($_SESSION["success"]); ?>
            <?php } ?>

            <?php if (isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <div>
                        <?php echo $_SESSION['error']; ?>
                    </div>
                </div>
                <?php unset($_SESSION["error"]); ?>
            <?php } ?>

            <?php if (isset($_SESSION['notice'])) { ?>
                <div class="alert alert-primary d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
                        <use xlink:href="#info-fill" />
                    </svg>
                    <div>
                        <?php echo $_SESSION['notice']; ?>
                    </div>
                </div>
                <?php unset($_SESSION["notice"]); ?>
            <?php } ?>
        </div>

        <div class="container mt-5 mb-5">
            <form action="add-courses-process" method="POST" class="row g-3 needs-validation" novalidate>

                <input type="hidden" name="formid" value="<?php echo $id; ?>" style="color: #ffffff; display: none;">

                <div class="col-md-8">
                    <label for="subjectname" class="form-label">Course Title*</label>
                    <input type="text" name="SN" value="<?php echo $subject_name; ?>" class="form-control" id="subjectname" required>
                    <div class="invalid-feedback">
                        Enter course title
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="subjectcode" class="form-label">Course Code*</label>
                    <?php if ($update == true) : ?>
                    <input type="text" name="SC" value="<?php echo $subject_code; ?>" class="form-control" id="subjectcode" required readonly>
                    <?php else : ?>
                    <input type="text" name="SC" class="form-control" id="subjectcode" required>
                    <?php endif; ?>
                    <div class="invalid-feedback">
                        Enter course code
                    </div>
                </div>

                <input type="hidden" name="formarcid" value="<?php echo $id; ?>" style="color: #ffffff; display: none;">

                <div class="col-md-3" hidden>
                    <label for="subjecttype" class="form-label">Course Type*</label>
                    <input type="text" name="ST" value="THEORY" class="form-control" id="subjecttype" required>
                    <div class="invalid-feedback">
                        Enter course type
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="subjectsemester" class="form-label">Semester*</label>
                    <?php if ($update == true) : ?>
                    <select class="form-select" name="SS" id="subjectsemester" required disabled>
                        <option value="<?php echo $semester; ?>"><?php if($semester == "3"){echo "First";}elseif($semester == "5"){echo "Second";}else{echo "Undefined";}; ?></option>
                    </select>
                    <?php else : ?>
                    <select class="form-select" name="SS" id="subjectsemester" required>
                        <option selected disabled value="">Choose...</option>
                        <option value="3">First</option>
                        <option value="5">Second</option>
                    </select>
                    <?php endif; ?>
                    <div class="invalid-feedback">
                        Select semester
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="subjectdepartment" class="form-label">Level*</label>
                    <select class="form-select" name="SD" id="subjectdepartment" required>
                        <?php if ($update) { ?>
                            <option><?php echo $department; ?></option>
                        <?php } else { ?>
                            <option selected disabled value="">Choose...</option>
                        <?php } ?>
                        <option value="300 Level">300 Level</option>
                        <option value="400 Level">400 Level</option>
                    </select>
                    <div class="invalid-feedback">
                        Select level
                    </div>
                </div>

                <div class="col-12 mt-5">
                    <?php if ($update == true) : ?>
                        <button class="btn btn-success" type="submit" name="updatecourse">Update</button>
                    <?php else : ?>
                        <button class="btn btn-success" type="submit" name="addcourse">Add course</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <script>
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function() {
                'use strict'

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.querySelectorAll('.needs-validation')

                // Loop over them and prevent submission
                Array.prototype.slice.call(forms)
                    .forEach(function(form) {
                        form.addEventListener('submit', function(event) {
                            if (!form.checkValidity()) {
                                event.preventDefault()
                                event.stopPropagation()
                            }

                            form.classList.add('was-validated')
                        }, false)
                    })
            })()
        </script>
    </body>

    </html>
<?php } ?>