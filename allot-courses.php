<?php
session_start();
if (!isset($_SESSION['granted'])) {
    header("location: login");
} else { ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="assets/images/uniabuja-logo.jpg" type="image/x-icon">
        <title>Allot Courses</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <style>
            label {
                color: gray;
            }
        </style>
    </head>

    <body>
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
            </div>
            <div class="mt-5">
                <h1>Allot courses</h1>
                <p>Allot courses to teachers</p>
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
            <form action="allot-courses-process" method="POST" class="row g-3 needs-validation" novalidate>

                <div class="col-md-6">
                    <label for="tobealloted" class="form-label">Select subject*</label>
                    <select name="tobealloted" class="form-select" required>
                    <?php
                    include 'connection.php';
                    $q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
                        "SELECT * FROM subjects");
                    $row_count = mysqli_num_rows($q);
                    if ($row_count) {
                        $mystring = '
                    <option selected disabled value="">Choose...</option>';
                        while ($row = mysqli_fetch_assoc($q)) {
                            if ($row['isAlloted'] == 1 || $row['course_type'] == "LAB")
                                continue;
                            $mystring .= '<option value="' . $row['subject_code'] . '">' . $row['subject_name'] . '</option>';
                        }

                        echo $mystring;
                    }
                    ?>
                    </select>
                    <div class="invalid-feedback">
                        Select subject
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="toalloted" class="form-label">Select teacher*</label>
                    <select name="toalloted" class="form-select" required>
                    <?php
                    include 'connection.php';

                    $q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
                        "SELECT * FROM teachers ");
                    $row_count = mysqli_num_rows($q);
                    if ($row_count) {
                        $mystring = '
                    <option selected disabled value="">Choose...</option>';
                        while ($row = mysqli_fetch_assoc($q)) {
                            $mystring .= '<option value="' . $row['faculty_number'] . '">' . $row['name'] . '</option>';
                        }

                        echo $mystring;
                    }
                    ?>
                    </select>
                    <div class="invalid-feedback">
                        Select teacher
                    </div>
                </div>

                <div class="col-12 mt-5">
                    <button class="btn btn-success" type="submit" name="allotcourse">Allot course</button>
                </div>
            </form>
            <hr>
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

        <script>
            function deleteHandlers() {
                var table = document.getElementById("allotedsubjectstable");
                var rows = table.getElementsByTagName("tr");
                for (i = 0; i < rows.length; i++) {
                    var currentRow = table.rows[i];
                    //var b = currentRow.getElementsByTagName("td")[0];
                    var createDeleteHandler =
                        function (row) {
                            return function () {
                                var cell = row.getElementsByTagName("td")[0];
                                var id = cell.innerHTML;
                                var x;
                                if (confirm("Are You Sure?") == true) {
                                    window.location.href = "deleteallotment.php?name=" + id;
                                
                                }
                            
                            };
                        };
                    
                    currentRow.cells[4].onclick = createDeleteHandler(currentRow);
                }
            }
        </script>

        <div class="container mt-5 mb-5">
            <h1 class="mb-5">View allotment</h1>
            <table class="table" id=allotedsubjectstable>
                <thead>
                    <tr>
                        <th>Course Code</th>
                        <th>Course Title</th>
                        <th>Teader Id No</th>
                        <th>Teacher's Name</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                include 'connection.php';
                $q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
                    "SELECT * FROM subjects ");

                while ($row = mysqli_fetch_assoc($q)) {
                    if ($row['isAlloted'] == 0 || $row['course_type'] == 'LAB')
                        continue;
                    $teacher_id = $row['allotedto'];
                    $t = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
                        "SELECT name FROM teachers WHERE faculty_number = '$teacher_id'");
                    $trow = mysqli_fetch_assoc($t);
                    echo "<tr><td>{$row['subject_code']}</td>
                                <td>{$row['subject_name']}</td>
                                <td>{$row['allotedto']}</td>
                                <td>{$trow['name']}</td>
                               <td>
                                <button class='btn btn-danger btn-sm'>Delete</button></td>
                                </tr>\n";
                }
                echo "<script>deleteHandlers();</script>";
                ?>
                </tbody>
            </table>
        </div>
    </body>

    </html>
<?php } ?>