  <!-- include css file to format student home page -->
  <link href="assets/styles/StudentHomeFormat.css" rel="stylesheet" type="text/css" />
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>


<?php
$user = $_POST["username"];
$pass = $_POST["password"];

//opens connection to sql
 $mysqli = new mysqli("mysql.eecs.ku.edu", "jgray", "jgray1", "jgray");

    //if connection to sql fails
    if ($mysqli->connect_errno)
    {
        echo "printf('Connect failed: %s\n', $mysqli->connect_error)";
        exit();
    }

    //check table for name
    $select = "SELECT * FROM TeacherLogin WHERE username = '$user' AND password ='$pass'";
    $result = $mysqli -> query($select);
    //if name is in table
    if($result -> num_rows != 0)
    {
      //redirect
        header('Location: ../../views/Review.php?user= ' . $user);

    }
    //if OK to add
    else
    {
      echo "<p>User or password not recognized</p>";
      echo "<a class='btn btn-primary' href='../../views/TeacherLogin.html'> Click here to login</a>";
    }

  //close sql connection
   $mysqli->close();

 ?>
