<?php
/*
author: Josiah Gray

resources:
help checking if query returns nothing from stack overflow. http://stackoverflow.com/questions/21258620/check-if-the-query-results-empty-row-mysqli
help checking textbox entries before submitting from stack overflow. http://stackoverflow.com/questions/15997632/check-textbox-before-submitting
*/
?>
	  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<?php
//function that takes a row from an SQL query and displays a quiz question with a textbox to enter an answer
function setupQuestion($row){
  echo $row["q_number"].") ".$row["q_text"]." ";
  echo "<input type='number' maxlength='6' size='6' id='Q".$row["q_number"]."' name='Q".$row["q_number"]."'> <br><br>";
}
?>

<html>
<head>
  <title> Quiz </title>

<!-- javascript function that checks that a name was entered for the quiz before the results are submitted for grading -->
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

<!--
set up the quiz page.
displays error if an invalid access code was entered.
for a valid access code, query an SQL table for all questions associated with the access code and display them along with textboxes to enter answers in.
-->
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

  //get access code from POST
  $code = $_POST["quizCode"];

  //query SQL table "QuizQuestions" for the list of quiz questions associated with the access code
  $query = "SELECT id, quiz_name, access_code, teacher, q_number, q_text, q_answer FROM QuizQuestions WHERE access_code='$code' ORDER BY q_number ASC;";

  if($result = $mysqli->query($query))
  {
    //display error for invalid access code
    if($result->num_rows === 0)
    {
      echo "ERROR: invalid quiz code.<br>";
    }
    //display questions for valid access code
    else
    {
      echo "<form action='GradeQuiz.php' method='post' onSubmit='return checkForm();'>";

      echo "<input type='hidden' value='".$code."' id='quizCode' name='quizCode'>";

      echo "<label for='usr'>User Name:</label>";
      echo "<input type='text' id='studentName' name='studentName'> <br><br>";

      while($row = $result->fetch_array())
      {
        setupQuestion($row);
      }

      echo "<input class='btn btn-primary' type='submit' value='Grade Quiz'>";
      echo "</form>";
    }

    //free result set
    $result->free();
  }

  //close connection
  $mysqli->close();
  ?>

  <br>
  <a class="btn btn-primary" href="../../../index.html"> Return to Student Home page </a>
</body>

</html>
