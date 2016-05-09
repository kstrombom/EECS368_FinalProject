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
        header('Location: http://people.eecs.ku.edu/~kstrombo/EECS368_FinalProject/Review.html?user='.$user);

    }
    //if OK to add
    else
    {
      echo "<p>User or password not recognized</p>";
      echo "<a href='http://people.eecs.ku.edu/~kstrombo/EECS368_FinalProject/Teacher_Login.html'> Click here to login</a>";
    }

  //close sql connection
   $mysqli->close();

 ?>
