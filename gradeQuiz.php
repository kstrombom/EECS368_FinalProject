<?php
/*
author: Josiah Gray

resources:

*/
?>

<html>
<head>
  <title> Quiz Results </title>
</head>

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

  $code = $_POST["quizCode"];

  $query = "SELECT id, quiz_name, teacher, q_number, q_text, q_answer FROM QuizQuestions WHERE access_code='$code' ORDER BY q_number ASC;";

  if($result = $mysqli->query($query))
  {
    if($result->num_rows === 0)
    {
      echo "ERROR: invalid quiz code.<br>";
    }
    else
    {
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

      for($i = 0; $i < $max; $i++)
      {
        echo "Question ".($i+1).": ".$questionArray[$i]."<br>";
        echo "Your answer: ".$studentAnswers[$i]."<br><br>";

        if($questionAnswers[$i] == $studentAnswers[$i])
        {
          $numCorrect++;
        }
      }

      $percentage = round(($numCorrect/$max)*100,2);

      echo "Total number of questions: ".$max."<br>";
      echo "Number of correct answers: ".$numCorrect."<br>";
      echo "Grade: ".$percentage."% <br>";
    }

    //free result set
    $result->free();
  }

  //close connection
  $mysqli->close();
  ?>

  <br>
  <a href="studentHome.html"> Return to Student Home page </a>
</body>

</html>
