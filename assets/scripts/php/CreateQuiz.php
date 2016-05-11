<? php
$Questions = $_POST["Questions"];
$Answers = $_POST["Answers"];
$QuizName = $_POST["QuizName"];
$user = $_POST['user'];

//opens connection to sql
$mysqli = new mysqli("mysql.eecs.ku.edu", "jgray", "jgray1", "jgray");

//if connection to sql fails
if ($mysqli - > connect_errno) {
  echo "printf('Connect failed: %s\n', $mysqli->connect_error)";
  exit();
}

function RandomString() {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $randstring = '';
  for ($i = 0; $i < 6; $i++) {
    $randstring. = $characters[rand(0, strlen($characters) - 1)];
  }
  return $randstring;
}

//checks to see if string is already in use
while (True) {
  $AccessCode = RandomString();

  $select = "SELECT access_code FROM QuizQuestions WHERE access_code='$AccessCode'";
  $result = $mysqli - > query($select);
  //if not in table
  if ($result - > num_rows == 0) {
    break;
  }
}

//put information into Quizzes
$insert = "INSERT INTO Quizzes (name,access,teacher) VALUES ('$QuizName','$AccessCode','$user')";
$mysqli - > query($insert);

//put information into QuizQuestions
$lengthOfQuestions = count($Questions);

for ($i = 0; $i < $lengthOfQuestions; $i++) {
  $questionNumber = $i + 1;
  $question = $Questions[$i];
  $answer = $Answers[$i];
  $insert = "INSERT INTO QuizQuestions (quiz_name,access_code,teacher,q_number,q_text,q_answer) VALUES ('$QuizName','$AccessCode','$user','$questionNumber','$question','$answer')";
  $mysqli - > query($insert);
}

echo "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' integrity='sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7' crossorigin='anonymous'>";

echo "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css' integrity='sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r' crossorigin='anonymous'>";

echo "<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js' integrity='sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS' crossorigin='anonymous'></script>";
//print everything out as review on the string
echo "<h1>".$QuizName.
" has been added to your test bank</h1>";
echo "<h2>".$AccessCode.
" is the accessCode</h2>";

$lengthOfQuestions = count($Questions);

for ($i = 0; $i < $lengthOfQuestions; $i++) {
  echo "Question ".($i + 1).
  ": ".$Questions[$i].
  "<br>";
  echo "Answers ".($i + 1).
  ": ".$Answers[$i].
  "<br><br>";
}

echo "<a href='../../views/Review.php?user=".$user.
"'>Return to homepage</a>";

?>
