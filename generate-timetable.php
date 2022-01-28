<?php
session_start();
if (!isset($_SESSION['granted'])) {
    header("location: login");
} else { ?>
<?php
if(isset($_GET['success'])){
    echo "<script type='text/javascript'>alert('Time Table Generated');</script>";
}
?>

<?php
require("dbconn1.php");
$getclass = $mysql->query("SELECT * FROM classrooms LIMIT 7") or die($mysql->error);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="assets/images/uniabuja-logo.jpg" type="image/x-icon">
        <title>Generate Timetable</title>
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

        <div class="container mt-3">
            <div>
                <a href="dashboard" class="btn btn-dark btn-sm">Back to dashboard</a>
            </div>
            <div class="mt-3">
                <h3>Generate timetable</h3>
                <p style="color:red;">Ensure you have added teacher, added courses and alloted courses before you generate the timetable. When that is done, click the button below to generate the timetable before viewing</p>
                <form action="algo.php" method="post">
                    <button type="submit" id="generatebutton" class="btn btn-success btn-sm">Click to generate timetable</button>
                </form>
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

        <div class="container mt-3 mb-5">
            <div class="row">
                <div class="col">
                    <form action="generate-timetable" method="POST" class="row g-3 needs-validation" novalidate>
                        <div class="col-md-12">
                            <label for="select_teacher" class="form-label">Select semester*</label>
                            <select name="select_semester" class="form-select" required>
                                <option selected disabled value="">Choose...</option>
                                <option value="3">First</option>
                                <option value="5">Second</option>
                            </select>
                            
                            <div class="invalid-feedback">
                                Select semester
                            </div>
                        </div>
                            
                        <div class="col-12">
                            <button class="btn btn-dark btn-sm" type="submit" id="viewsemester">View semester timetable</button>
                        </div>
                    </form>
                </div>
                <div class="col">
                    <form action="generate-timetable" method="POST" class="row g-3 needs-validation" novalidate>
                        <div class="col-md-12">
                            <label for="select_teacher" class="form-label">Select teacher*</label>
                            <select name="select_teacher" class="form-select" required>
                                <option selected disabled value="">Choose...</option>
                                <?php
                                $q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
                                    "SELECT * FROM teachers ");
                                while ($row = mysqli_fetch_assoc($q)) {
                                    echo " \"<option value=\"{$row['faculty_number']}\">{$row['name']}</option>\"";
                                }
                                ?>
                            </select>

                            <div class="invalid-feedback">
                                Select teacher
                            </div>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-dark btn-sm" type="submit" id="viewteacher">View teacher timetable</button>
                        </div>
                    </form>
                </div>
            </div>
            
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
            var index = -1;
            function Substitute() {
                var table = document.getElementById("timetable");
                var cells = table.getElementsByTagName("td");
                // window.alert(cells[3].innerHTML.toString());
                for (i = 0; i < cells.length; i++) {
                    if (i % 8 == 6 || i % 8 == 7 || parseInt(i / 8) == 0 || i % 8 == 0) {
                        continue;
                    }
                    var currentCell = cells[i];
                    //var b = currentRow.getElementsByTagName("td")[0];
                    var createSubstituteHandler =
                        function (cell, i) {
                            return function () {
                            
                                document.getElementById('cell_number').value = i;
                                index = i;
                                var xmlhttp = new XMLHttpRequest();
                                xmlhttp.onreadystatechange = function () {
                                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                        var modal = document.getElementById('myModal');
                                        modal.style.display = "block";
                                        document.getElementById("substitute").innerHTML = this.responseText;
                                    
                                    }
                                };
                                xmlhttp.open("GET", "getcellindex.php?i=" + i, false);
                                xmlhttp.send();
                            };
                        };
                    currentCell.onclick = createSubstituteHandler(currentCell, i);
                }
            }
        </script>

        <div class="container mt-5" id="TT">
        <table class="table table-bordered" cellspacing="3" align="center" id="timetable">
            <caption style="text-align:center;"><strong><br>
                    <?php
                    if (isset($_POST['select_semester'])) {
                        if($_POST['select_semester'] == "3"){
                            $semestertext = "First";
                        }elseif($_POST['select_semester'] == "5"){
                            $semestertext = "Second";
                        }
                        echo "Computer Science Department Timetable, ".$semestertext." Semester, 300 and 400 Level";
                        $year = (int)($_POST['select_semester'] / 2) + $_POST['select_semester'] % 2;
                        $r = mysqli_fetch_assoc(mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), "SELECT * from classrooms
                        WHERE status = '$year'"));
                        // echo " ( " . $r['name'], " ) ";
                    } else if (isset($_POST['select_teacher'])) {
                        $id = $_POST['select_teacher'];
                        $r = mysqli_fetch_assoc(mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), "SELECT * from teachers
                        WHERE faculty_number = '$id'"));
                        echo $r['name'];
                    } else if (isset($_GET['display'])) {
                        $id = $_GET['display'];
                        $r = mysqli_fetch_assoc(mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), "SELECT * from teachers
                        WHERE faculty_number = '$id'"));
                        echo $r['name'];

                    }
                    ?>
                </strong></caption>
            <tr>
                <th style="text-align:center">WEEKDAYS</th>
                <th style="text-align:center">8:00-10:00</th>
                <th style="text-align:center">10:00-12:00</th>
                <th style="text-align:center">12:00-2:00</th>
                <th style="text-align:center">2:00-2:30</th>
                <th style="text-align:center">2:30-4:00</th>
                <th style="text-align:center">4:00-5:00</th>
                <th style="text-align:center">5:00-6:00</th>
            </tr>
            
            <tr>
                <th></th>
                <?php
                while($rowshow = $getclass->fetch_assoc()): ?>
                <th><?php echo $rowshow['name'] ?></th>
                <?php endwhile; ?>
            </tr>

            <tr>
                <?php
                $table = null;
                if (isset($_POST['select_semester'])) {
                    $table = " semester" . $_POST['select_semester'] . " ";
                } else if (isset($_POST['select_teacher'])) {
                    $table = " " . $_POST['select_teacher'] . " ";
                } else if (isset($_GET['display'])) {
                    $table = " " . $_GET['display'] . " ";
                } else
                    echo '</table>';
                if (isset($_POST['select_semester']) || isset($_POST['select_teacher']) || isset($_GET['display'])) {
                    $q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
                        "SELECT * FROM" . $table);
                    $qq = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
                        "SELECT * FROM subjects");
                    $days = array('MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY');
                    $i = -1;
                    $str = "<br>";
                    $tid = "";
                    if (isset($_POST['select_semester'])) {
                        while ($r = mysqli_fetch_assoc($qq)) {
                            if ($r['isAlloted'] == 1 && $r['semester'] == $_POST['select_semester']) {
                                $str .= $r['subject_code'] . ": " . $r['subject_name'] . ", ";
                                if (isset($r['allotedto'])) {
                                    $id = $r['allotedto'];
                                    $qqq = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
                                        "SELECT * FROM teachers WHERE faculty_number = '$id'");
                                    $rr = mysqli_fetch_assoc($qqq);
                                    $str .= " " . $rr['alias'] . ": " . $rr['name'] . " ";
                                }
                                if ($r['course_type'] !== "LAB") {
                                    $str .= "<br>";
                                    continue;
                                } else {
                                    $str .= ", ";
                                }
                                if (isset($r['allotedto2'])) {
                                    $id = $r['allotedto2'];
                                    $qqq = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
                                        "SELECT * FROM teachers WHERE faculty_number = '$id'");
                                    $rr = mysqli_fetch_assoc($qqq);
                                    $str .= " " . $rr['alias'] . ": " . $rr['name'] . ", ";
                                }
                                if (isset($r['allotedto3'])) {
                                    $id = $r['allotedto3'];
                                    $qqq = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
                                        "SELECT * FROM teachers WHERE faculty_number = '$id'");
                                    $rr = mysqli_fetch_assoc($qqq);
                                    $str .= " " . $rr['alias'] . ": " . $rr['name'] . "<br>";
                                }
                            }
                        }
                    } else if (isset($_POST['select_teacher']) || isset($_GET['display'])) {
                        if (isset($_POST['select_teacher'])) {
                            $tid = $_POST['select_teacher'];
                        } else if (isset($_GET['display'])) {
                            $tid = $_GET['display'];
                            $tid = strtoupper($tid);
                        }
                        while ($r = mysqli_fetch_assoc($qq)) {
                            if ($r['isAlloted'] == 1 && $r['allotedto'] == $tid) {
                                $str .= $r['subject_code'] . ": " . $r['subject_name'] . " <br>";
                            } else if ($r['isAlloted'] == 1 && isset($r['allotedto2']) && $r['allotedto2'] == $tid) {
                                $str .= $r['subject_code'] . ": " . $r['subject_name'] . " <br>";
                            } else if ($r['isAlloted'] == 1 && isset($r['allotedto3']) && $r['allotedto3'] == $tid) {
                                $str .= $r['subject_code'] . ": " . $r['subject_name'] . " <br>";
                            }
                        }
                    }
                    while ($row = mysqli_fetch_assoc($q)) {
                        $i++;

                        echo "
                 <tr><td style=\"text-align:center\">$days[$i]</td>
                 <td style=\"text-align:center\">{$row['period1']}</td>
                <td style=\"text-align:center\">{$row['period2']}</td>
                <td style=\"text-align:center\">{$row['period3']}</td>
                <td style=\"text-align:center\">BREAK</td>
                 <td style=\"text-align:center\">{$row['period4']}</td>
                  <td style=\"text-align:center\">{$row['period5']}</td>
                  <td style=\"text-align:center\">{$row['period6']}</td>
                </tr>\n";
                    }

                    echo '</table>';
                    $sign = "Generated via Timetable System, Computer Science Department";
                    echo "<div style='margin-left: 10px' align='center'>" . "<br>" . $str . "<br></div>" .
                        "<div style='margin-left: 10px' align='center'>" . "<strong>" . $sign . "<br></strong></div>";
                }
                if (isset($_POST['select_teacher'])) {
                    echo "<script>Substitute();</script>";
                    $_SESSION['shown_id'] = $_POST['select_teacher'];
                }
                if (isset($_GET['display'])) {
                    echo "<script>Substitute();</script>";
                    $_SESSION['shown_id'] = $_GET['display'];
                }
                ?>
        </div>

        <script type="text/javascript">
            function gendf() {
                var doc = new jsPDF();
            
                doc.addHTML(document.getElementById('TT'), function () {
                    doc.save('<?php
                            if (isset($_POST["select_semester"])) {
                                echo "ttms semester " . $_POST["select_semester"];
                            } else if (isset($_POST["select_teacher"])) {
                                echo "ttms " . $_POST["select_teacher"];
                            } else if (isset($_GET["display"])) {
                                echo "ttms " . $_GET["display"];
                            }
                            ?>' + '.pdf');
                    // alert("Downloaded!");
                        
                });
            }

        </script>
        <!-- <div align="center" style="margin-top: 10px">
            <button id="saveaspdf" class="btn btn-dark btn-sm" onclick="gendf()">Save as pdf</button>
        </div> -->
        <div align="center" class="mt-3 mb-5">
            <button class="btn btn-dark btn-sm" onclick="window.print()">Save as pdf</button>
            <button class="btn btn-success btn-sm" id="downloadexcel">Export as excel document</button>
        </div>
        <script src="table2excel.js"></script>

        <script>
            document.getElementById("downloadexcel").addEventListener('click', function(){
                var table2excel = new Table2Excel();
                table2excel.export(document.querySelectorAll("#timetable"));
            })
        </script>
    </body>

    </html>
<?php } ?>