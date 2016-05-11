<!-- Styling from W3Schools-->

<html>
 <head>
  <title>Overview Page</title>
  <script type="text/javascript" src="../scripts/js/jquery-1.12.3.js"></script>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>


 </head>
     <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="../../index.html">368 Project 3</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="../../index.html">Home</a></li>
                <li><a href="Practice.html">Practice</a></li>
                <li><a href="QuizSelect.html">Take Quiz</a></li>
                <li><a href="TeacherLogin.html">Teacher Login</a></li>
                <li><a href="CreateTeacher.html">Teacher Sign Up</a></li>
        </div>
    </nav>
    <div class="container" align="center">
   <h2>Quizzes</h2></div>
   <div class="container">
    <form action = "../scripts/php/ReviewDelete.php" id="delete" method = "post">
       <div class="container">
           
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
        echo"</thead><tbody>";
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
        </div>
    <input type="submit" class="btn btn-danger" value="Delete" >
    
    </form>

    <a class="btn btn-primary" href="CreateQuiz.php?user=<?php echo $user; ?>">Create Quiz</a>
    </div>
    <br><br>
 <footer class="footer">
    <div class="container" align="center">
      <p class="text-muted">EECS 368 Group Project <a href="https://github.com/kstrombom/EECS368_FinalProject">Github Link</a></p>
    </div>
  </footer>
 </body>
</html>
