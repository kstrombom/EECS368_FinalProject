<? php
/*
author: Josiah Gray

resources:

*/
  ?>

  <html>
<head>
  <title> Quiz Results </title>
</head>

<!--
set up grading page.
display questions along with the student answers.
at the end, display the total number of questions, the total number correct, and the percentage scored (rounded to 2 decimal places).
-->
<body>
  <h1> Quiz Results </h1>

  <?php
  $mysqli = new mysqli("mysql.eecs.ku.edu", "jgray", "jgray1", "jgray");

  //check connection
  if($mysqli->connect_errno)
  {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
  }

  //get student name from POST
  $studentName = $_POST["studentName"];
  //get access code from POST
  $code = $_POST["quizCode"];

  //query SQL table "QuizQuestions" for the list of quiz questions associated with the access code
  $query = "SELECT id, quiz_name, teacher, q_number, q_text, q_answer FROM QuizQuestions WHERE access_code='$code' ORDER BY q_number ASC;";

  if($result = $mysqli->query($query))
  {
    if($result->num_rows === 0)
    {
      echo "ERROR: invalid quiz code.<br>";
    }
    else
    {
      //put questions, correct answers, and student answers into arrays
      $questionArray = array();
      $questionAnswers = array();
      $studentAnswers = array();

      while($row = $result->fetch_array())
      {
        array_push($questionArray, $row["q_text"]);
        array_push($questionAnswers, $row["q_answer"]);
        array_push($studentAnswers, $_POST[("Q".$row["q_number"])]);
      }

      $max = count($questionArray);
      $numCorrect = 0;

      //display questions and student answers
      for($i = 0; $i < $max; $i++)
      {
        echo "Question ".($i+1).": ".$questionArray[$i]."<br>";
        echo "Your answer: ".$studentAnswers[$i]."<br><br>";

        //keep track of number of questions the student answered correctly
        if($questionAnswers[$i] == $studentAnswers[$i])
        {
          $numCorrect++;
        }
      }

      //calculate percentage grade
      $percentage = round(($numCorrect/$max)*100,2);

      //display total number of questions, total number of correct answers, and percentage grade
      echo "Total number of questions: ".$max."<br>";
      echo "Number of correct answers: ".$numCorrect."<br>";
      echo "Grade: ".$percentage."% <br><br>";
    }

    //free result set
    $result->free();
  }

  //store student name, quiz code, and score in the StudentScores table in the database
  $query = "INSERT INTO StudentScores (student_name, access_code, score) VALUES ('$studentName', '$code', '$percentage');";

  //attempt to insert username into database
  if($result = $mysqli->query($query))
  {
    echo "Your score was successfully saved!<br>";
  }
  else
  {
    echo "ERROR: your score could not be saved.<br>";
  }

  //close connection
  $mysqli->close();
  ?>

  <br>
  <a href="../../../index.html"> Return to Student Home page </a>
</body>

</html>
