  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<?php

//Grab info from MenuAlteration.html
$username = $_POST["username"];
$password = $_POST["password"];

if(strlen($password)>10)
{
  echo "<p>Password must be a string less than 10 characters</p>";
  echo "<a class='btn btn-primary' href='../../views/CreateTeacher.html'>Create Login</a>";
}
else if($username=="" || $password=="")
{
  echo "<p>There is an empty field, retry login</p>";
  echo "<a class='btn btn-primary' href='../../views/CreateTeacher.html'>Create Login</a>";
}
else
{
    //opens connection to sql
     $mysqli = new mysqli("mysql.eecs.ku.edu", "jgray", "jgray1", "jgray");

        //if connection to sql fails
        if ($mysqli->connect_errno)
        {
            echo "printf('Connect failed: %s\n', $mysqli->connect_error)";
            exit();
        }

        //check table for name
      	$select = "SELECT * FROM TeacherLogin WHERE username = '$username'";
      	$result = $mysqli -> query($select);
      	//if name is in table
      	if($result -> num_rows != 0)
      	{
          echo '<p>Username duplicate, your login was not created</p><br>';
          echo "<a class='btn btn-primary' href='../../views/CreateTeacher.html'>Create Login</a>";

      	}
      	//if OK to add
      	else
      	{
      		//add to table
      		$mysqli -> query ("INSERT INTO TeacherLogin (username,password) VALUES ('$username','$password')");
          echo '<p>"Login created!"</p>';
          echo '<a class="btn btn-primary" href="../../views/TeacherLogin.html"> Login Now</a>';
        }

      //close sql connection
       $mysqli->close();
}

?>
