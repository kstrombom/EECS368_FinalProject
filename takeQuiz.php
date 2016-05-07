<?php
/*
author: Josiah Gray

resources:
help checking if query returns nothing from stack overflow. http://stackoverflow.com/questions/21258620/check-if-the-query-results-empty-row-mysqli
help checking textbox entries before submitting from stack overflow. http://stackoverflow.com/questions/15997632/check-textbox-before-submitting
*/
?>

<?php
function setupQuestion($row){
  echo $row["q_number"].") ".$row["q_text"]." ";
  echo "<input type='number' maxlength='6' size='6' id='Q".$row["q_number"]."' name='Q".$row["q_number"]."'> <br><br>";
}
?>

<html>
<head>
  <title> Quiz </title>

  <script type="text/javascript">
    function checkForm()
    {
      var studentName = (document.getElementById("studentName").value).trim();

      if(studentName == "")
      {
        alert("You need to enter your name.");
        return false;
      }

      return true;
    }
  </script>
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

  $query = "SELECT id, quiz_name, teacher, q_number, q_text, q_answer FROM QuizQuestions WHERE access_code='$code' ORDER BY q_number ASC;";

  if($result = $mysqli->query($query))
  {
    if($result->num_rows === 0)
    {
      echo "ERROR: invalid quiz code.<br>";
    }
    else
    {
      echo "<form action='gradeQuiz.php' method='post' onSubmit='return checkForm();'>";

      echo "<input type='hidden' value='".$code."' id='quizCode' name='quizCode'>";

      echo "Enter your name: ";
      echo "<input type='text' id='studentName' name='studentName'> <br><br>";

      while($row = $result->fetch_array())
      {
        setupQuestion($row);
      }

      echo "<input type='submit' value='Grade Quiz'>";
      echo "</form>";
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
