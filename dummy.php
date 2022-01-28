        <div class="container mt-5">
            <!-- <h3>300 Level</h3>
            <p>First Semester</p> -->

            <table class="table" id=teacherstable>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Id</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Alias</th>
                        <th>Designation</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php
                    include 'connection.php';
                    $q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
                    "SELECT * FROM teachers ORDER BY faculty_number ASC");
                    
                    if (mysqli_num_rows($q) == 0) {
                        $tableempty = true;
                    } else { 
                        $tableempty = false;
                        while ($row = mysqli_fetch_assoc($q)) {
                            echo "
                            <tr>
                                <td>{$row['name']}</td>
                                <td>{$row['faculty_number']}</td>
                                <td>{$row['contact_number']}</td>
                                <td>{$row['emailid']}</td>
                                <td>{$row['alias']}</td>
                                <td>{$row['designation']}</td>
                                <td><button class='btn btn-danger btn-sm'>Delete</button></td>
                        
                            </tr>\n
                            ";
                        }
                            echo "<script>deleteHandlers();</script>";
                    }
                    ?>
                    
                    
                </tbody>
            </table>

            <?php if ($tableempty) {
                echo "<p class='text-center'>Here looks lonely. Click <a href='add-teachers'><strong>HERE</strong></a> to add teachers</p>";
            } ?>
        </div>