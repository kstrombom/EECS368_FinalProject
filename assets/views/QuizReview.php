<html>
  <head>
    <!-- include css file to format student home page -->
  <link href="assets/styles/StudentHomeFormat.css" rel="stylesheet" type="text/css" />
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>


    <title>View a made quiz</title>

  </head>
  <body>
        <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">368 Project 3</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="../../index.html">Home</a></li>
                <li><a href="Practice.html">Practice</a></li>
                <li><a href="QuizSelect.html">Take Quiz</a></li>
                <li><a href="TeacherLogin.html">Teacher Login</a></li>
                 <li><a href="CreateTeacher.html">Teacher Sign Up</a></li>
        </div>
    </nav>

  <h2><?php echo $name; ?></h2>

  <table class="table table-bordered" name="QuizList">
      <thead class="thead-inverse">
      <tr>
      <th>#</th>
      <th>Question</th>
      <th>Answer</th>
      </tr>
      </thead>
      <tbody>
  <?php include('../scripts/php/QuizList.php') ?>
  </tbody>
</table>
<a class="btn btn-primary" href="Review.php?user=<?php echo $user; ?>">Return to homepage</a>
<br>
 <footer class="footer">
    <div class="container">
      <p class="text-muted">EECS 368 Group Project <a href="https://github.com/kstrombom/EECS368_FinalProject">Github Link Here </a></p>
    </div>
  </footer>
  </body>
</html>
