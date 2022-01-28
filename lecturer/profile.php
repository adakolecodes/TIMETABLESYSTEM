<?php
session_start();
if (!isset($_SESSION['lecturer'])) {
    header("location: ../login");
} else { ?>
    <?php
    require "dbconn1.php";
    $result1 = $mysql->query("SELECT * FROM teachers") or die($mysql->error);
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="assets/images/uniabuja-logo.jpg" type="image/x-icon">
        <title>Profile</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
                <h1>My profile</h1>
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


        <script>
        function deleteHandlers() {
            var table = document.getElementById("teacherstable");
            var rows = table.getElementsByTagName("tr");
            for (i = 0; i < rows.length; i++) {
                var currentRow = table.rows[i];
                //var b = currentRow.getElementsByTagName("td")[0];
                var createDeleteHandler =
                    function(row) {
                        return function() {
                            var cell = row.getElementsByTagName("td")[0];
                            var id = cell.innerHTML;
                            var x;
                            if (confirm("Are You Sure?") == true) {
                                window.location.href = "deleteteacher.php?name=" + id;

                            }

                        };
                    };
                currentRow.cells[7].onclick = createDeleteHandler(currentRow);
            }
        }
    </script>

        <div class="container mt-5 mb-5">
            <!-- <h3>300 Level</h3>
            <p>First Semester</p> -->

            <table class="table" id=teacherstable>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Alias</th>
                        <th>Designation</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                
                <tbody>
                <?php
                include 'connection.php';
                if(isset($_SESSION['lecturer'])){
                    $facultynum = $_SESSION['faculty_number'];
                }
                $q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
                "SELECT * FROM teachers WHERE faculty_number = '$facultynum'");

                while ($row = mysqli_fetch_assoc($q)) {
                echo "<tr><td>{$row['faculty_number']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['contact_number']}</td>
                    <td>{$row['emailid']}</td>
                    <td>{$row['alias']}</td>
                    <td>{$row['designation']}</td>
                    <td><a href='update-profile?edit={$row['faculty_number']}' class='btn btn-primary btn-sm'>Edit</a></td>
                    
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