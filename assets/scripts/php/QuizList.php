  <? php
  $user = $_GET['user'];
  $access = $_GET['access'];

  $mysqli = new mysqli("mysql.eecs.ku.edu", "jgray", "jgray1", "jgray");

  if ($mysqli - > connect_errno) {
    echo "printf('Connect failed: %s\n', $mysqli->connect_error)";
    exit();
  }

  $select = "SELECT quiz_name FROM QuizQuestions WHERE access_code='$access'";
  $result = $mysqli - > query($select);

  $row = $result - > fetch_assoc();
  $name = $row["quiz_name"];

  $select = "SELECT q_number,q_text,q_answer FROM QuizQuestions WHERE access_code='$access' ORDER BY q_number ASC";
  $result = $mysqli - > query($select);
  $num = $result - > num_rows;

  for ($i = 0; $i < $num; $i++) {
    $row = $result - > fetch_assoc();
    $number = $row['q_number'];
    $question = $row['q_text'];
    $answer = $row['q_answer'];



    echo "<tr>";
    echo "<td>$number</td>";
    echo "<td>$question</td>";
    echo "<td>$answer</td>";
    echo "</tr>";

  } ?>
  