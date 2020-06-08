<!DOCTYPE html>
<html>
<!-- 
    To-do list.
    Make a simple web app where you could add, mark as completed and delete to-do items.
-->
    <head>
        <title>To Do List</title>

        <link rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
            integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
            crossorigin="anonymous">              

        <link rel="stylesheet" href="to_do_list.css">

    </head>
    <body>
        <?php //echo "GET: "; print_r($_GET); echo "\n"; ?>
        <?php //echo "POST: "; print_r($_POST); ?>

        <?php

            $method_arr = $_POST;
            
            $servername = "localhost";
            $username = "guest";
            $password = "todolist!mysql";
            $dbname = "todolist";
            
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            function log_debug_script($val) {
                echo "<script>console.log('" . $val . "');</script>\n";
            }

            function create_table($conn) {
                $sql = "
                    CREATE TABLE IF NOT EXISTS ToDoList (
                        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        detail VARCHAR(255) NOT NULL,
                        completed TINYINT
                    )";

                if ($conn->query($sql) === TRUE) {
                    log_debug_script('table created successfully');
                } else {
                    log_debug_script('error creating table:' . $conn->error);
                }
            }

            create_table($conn);

            // Add new items to the database
            function add_item_to_table($conn, $item) {
                $insert_sql = "INSERT INTO ToDoList (detail, completed) VALUES ('" . $item . "', 0)";
                
                if ($conn->query($insert_sql) === TRUE) {
                    log_debug_script($item . " inserted successfully");
                } else {
                    log_debug_script("error inserting :[" . $item . "][" . $conn->connect_errno . "]");
                }                    
            }

            if (isset($method_arr["to_do_item"])) {
                add_item_to_table($conn, $method_arr['to_do_item']);
            }

            // Remove all data from the database table
            function remove_all_data_from_table($conn) {
                $delete_sql = "TRUNCATE TABLE ToDoList;";
                $conn->query($delete_sql);
            }

            if (isset($method_arr['reset_table'])) {
                remove_all_data_from_table($conn);
            }

            ///////////////////////////////

            $completed_ids = array();
            $update_sql = "UPDATE ToDoList SET completed=1 WHERE id IN (";
    
            foreach ($method_arr as $key => $value) {
    
                if (strlen($key) >= 9 && substr($key, 0, 9) == "completed" && $value == "Complete") {
    
                    // Grab the id
                    $completed_id = intval(substr($key, 10));
    
                    // Add the id to the list of completed ids
                    array_push($completed_ids, $completed_id);
                }
            }
    
            $num_completed_ids = count($completed_ids);
            $update_sql .= implode(",", $completed_ids) . ")";
    
            if ($num_completed_ids > 0) {
                if ($conn->query($update_sql) == TRUE) {
                    log_debug_script('updated to completed successful');
                } else {
                    log_debug_script('update failure for completed  : ' . $conn->error);
                }
            }

            ///////////////////////////////

            $completed_ids = array();
            $update_sql = "UPDATE ToDoList SET completed=0 WHERE id IN (";
    
            foreach ($method_arr as $key => $value) {
    
                if (strlen($key) >= 9 && substr($key, 0, 9) == "completed" && $value == "Incomplete") {
    
                    // Grab the id
                    $completed_id = intval(substr($key, 10));
    
                    // Add the id to the list of completed ids
                    array_push($completed_ids, $completed_id);
                }
            }
    
            $num_completed_ids = count($completed_ids);
            $update_sql .= implode(",", $completed_ids) . ")";
    
            if ($num_completed_ids > 0) {
                if ($conn->query($update_sql) == TRUE) {
                    log_debug_script('updated to incomplete successful');
                } else {
                    log_debug_script('update failure for incomplete  : ' . $conn->error);
                }
            }

            ///////////////////////////////

            $deleted_ids = array();
            $delete_sql = "DELETE FROM ToDoList WHERE id IN (";
    
            foreach ($method_arr as $key => $value) {
    
                if (strlen($key) >= 7 && substr($key, 0, 6) == "delete" && $value == "delete") {
    
                    // Grab the id
                    $deleted_id = intval(substr($key, 7));
    
                    // Add the id to the list of completed ids
                    array_push($deleted_ids, $deleted_id);
                }
            }
    
            $num_deleted_ids = count($deleted_ids);            
            $delete_sql .= implode(",", $deleted_ids) . ")";
    
            if ($num_deleted_ids > 0) {
                if ($conn->query($delete_sql) == TRUE) {
                    log_debug_script('updated to deleted successful');
                } else {
                    log_debug_script('update failure for deleted  : ' . $conn->error);
                }
            }

            $conn->close();
        ?>

        <div class="container">
            <div class="row">
                <div class="col-sm">
                </div>
                <div class="col-sm">
                    <div class='panel panel-default'>
                        <div class='panel-body'>
                            <form action="to_do_list.php" method="post">
                                <input style='width: 100%' type="text" id="to_do_item" name="to_do_item" />
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                </div>
                <div class="col-sm">
                    <form action="to_do_list.php" method="post">
                        <?php

                            function checked_value($val) {
                                if ($val == 1) {
                                    return "checked";
                                }
                                return "";
                            }

                            $conn = new mysqli($servername, $username, $password, $dbname);

                            $items_sql = "
                                SELECT id, detail, completed FROM ToDoList; 
                            ";

                            $items_result = $conn->query($items_sql);

                            if ($items_result->num_rows > 0) {
                                // output data of each row
                                while($row = $items_result->fetch_assoc()) {
                                    echo "<div class='panel panel-default'>\n";
                                    echo "   <div class='panel-body'>\n";

                                    echo "    Completed: <input type=checkbox disabled='true' id=completed name='completed_" . $row['id'] . "'  " . checked_value($row['completed']) . ">\n";
                                    echo "     <div style='display: inline-block, width: 25%'>\n";
                                    echo "     " . $row['detail'] . "\n";
                                    echo "     </div>\n";

                                    if (intval($row['completed']) == 0) {
                                        echo "     <input type='submit' name='completed_" . $row['id'] . "' value='Complete' />\n";
                                    } else {
                                        echo "     <input type='submit' name='completed_" . $row['id'] . "' value='Incomplete' />\n";
                                    }

                                    echo "<button type='submit' value='delete' name='delete_" . $row['id'] . "' class='btn btn-default btn-sm'>\n";
                                    echo "    <span class='glyphicon glyphicon-trash' aria-hidden='true'></span>\n";
                                    echo "</button>\n";

                                    echo "   </div>\n";
                                    echo "</div>\n";
                                }
                            } else {
                                echo "No ToDo Items";
                            }

                            $conn->close();


                        ?>
                    </form>
                </div>
                <div class="col-sm">
                    <form action="to_do_list.php" method="post">
                        <input type="submit" id="reset_table" name="reset_table" value="Reset Table"/>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
