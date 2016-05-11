
       <?php
       $user=$_GET['user'];

            $mysqli = new mysqli("mysql.eecs.ku.edu", "jgray", "jgray1", "jgray");

        if ($mysqli->connect_errno)
        {
            echo "printf('Connect failed: %s\n', $mysqli->connect_error)";
            exit();
        }

        $select = "SELECT name,access FROM Quizzes WHERE teacher='$user'";
        $result = $mysqli -> query($select);
        $num = $result -> num_rows;
        
        echo"<table  class='table table-bordered' name='QuizList'>";
        echo"<thead class='thead-inverse'>";
        echo"<tr>";
        echo"<th>Delete<h6>check box to delete entry</h6></th>";
        echo"<th>Name <h6>click to view quiz</h6></th>";
        echo"<th>Access Code<h6>click to view student scores</h6></th>";
        echo"</tr>";
        echo"</thead>;<tbody>";
        for($i=0; $i<$num; $i++)
        {
            $row = $result -> fetch_assoc();
            $name = $row["name"];
            $access = $row ["access"];

            echo "<tr>";
            echo "<td><input type='checkbox' name='quizzes[]' value=".$access."></td>";
            echo "<td><a href= 'QuizReview.php?user=$user&&access=$access'>$name</a></td>";
            echo "<td><a href= 'StudentResults.php?user=$user&&access=$access'>$access</a></td>";
            echo "</tr>";
        }
        echo"</tbody>";
        echo"</table>";

       $mysqli->close();

       echo "<input type='hidden' name='user' value='$user'>";
       ?>