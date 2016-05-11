<?php

      $user=$_GET['user'];
      $access=$_GET['access'];

      //opens connection to sql
      $mysqli = new mysqli("mysql.eecs.ku.edu", "jgray", "jgray1", "jgray");

      //if connection to sql fails
      if ($mysqli->connect_errno)
      {
        echo "printf('Connect failed: %s\n', $mysqli->connect_error)";
        exit();
      }

      $select="SELECT name FROM Quizzes WHERE access='$access'";
      $result = $mysqli -> query($select);

      $quizName = $result->fetch_assoc()["name"];
      echo "<h2>$quizName - Student Scores</h2>";

      $select="SELECT * FROM StudentScores WHERE access_code='$access'";
      $result = $mysqli -> query($select);

      $num = $result -> num_rows;
      $average = 0;
    
      if($num==0)
      {
        echo "<p>No student has taken the exam yet</p>";
      }
      else
      { 
        echo"<table class='table table-bordered' name='QuizList'>";
        echo"<thead class='thead-inverse'>";
        echo"<tr>";
        echo"<th>Student</th>";
        echo"<th>Score</th>";
        echo"</tr>";
        echo"</thead>";

        for($i=0; $i<$num; $i++)
        {
            $row = $result -> fetch_assoc();
            $student = $row["student_name"];
            $score = $row ["score"];
            $average += $score;
            echo "<tr>";
            echo "<td>$student</td>";
            echo "<td>$score %</td>";
            echo "</tr>";
        }

        $average = $average/$num;
        echo "<tfoot>";
        echo "<tr>";
        echo "<td>Average</td>";
        echo "<td>$average %</td>";
        echo "</tr>";
        echo "</tfoot>";
        echo "</table>";
      }

      $mysqli->close();

    ?>
