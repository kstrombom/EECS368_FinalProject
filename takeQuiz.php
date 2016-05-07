<?php
/*
author: Josiah Gray

resources:
help checking if query returns nothing from stack overflow. http://stackoverflow.com/questions/8417192/how-would-i-check-if-values-returned-from-an-sql-php-query-are-empty
*/
?>

<?php
function setupQuestion($row){
  echo $row["q_number"].") ".$row["q_text"]." ".$row["q_answer"]."<br><br>";
}
?>

<html>

<head>
  <title> Quiz </title>
</head>

<body>
  <h1> Quiz </h1>

  <?php
  $mysqli = new mysqli("mysql.eecs.ku.edu", "jgray", "jgray1", "jgray");

  //check connection
  if($mysqli->connect_errno)
  {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
  }

  $code = $_POST["quizCode"];

  $query = "SELECT id, q_number, q_text, q_answer FROM QuizQuestions WHERE access_code='$code' ORDER BY q_number ASC;";

  if($result = $mysqli->query($query))
  {
    if(mysql_num_rows($result) != 0)
    {
      while($row = $result->fetch_assoc())
      {
        setupQuestion($row);
      }
    }
    else
    {
      echo "ERROR: invalid quiz code.<br>";
    }

    //free result set
    $result->free();
  }


  //close connection
  $mysqli->close();
  ?>

  <br>
  <a href="studentHome.html"> Return to UserHome page </a>
</body>

</html>
