 <?php

 //Grab checked items from MenuAlteration.html
  $quizArray = $_POST["quizzes"];
  $user=$_POST['user'];

//opens sql connection
  $mysqli = new mysqli("mysql.eecs.ku.edu", "jgray", "jgray1", "jgray");
      //if sql connection fails
     if ($mysqli->connect_errno)
     {
         echo "printf('Connect failed: %s\n', $mysqli->connect_error)";
         exit();
     }

     //deletes the rows from Menu table that match in the menuArray
     for($i=0; $i<count($quizArray);$i++)
     {
         $delete = "DELETE FROM Quizzes WHERE access = '$quizArray[$i]'";
         $mysqli->query($delete);
         $delete = "DELETE FROM QuizQuestions WHERE access_code = '$quizArray[$i]'";
         $mysqli->query($delete);
         $delete = "DELETE FROM StudentScores WHERE access_code = '$quizArray[$i]'";
         $mysqli->query($delete);
     }

     //close sql connection
      $mysqli->close();

      //refresh html page
      header("Location: Review.html?user=$user");
  ?>
