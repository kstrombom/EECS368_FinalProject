<html>
  <head>
    <link href="../siteStandard.css" rel="stylesheet" type="text/css" />
    <title>View a made quiz</title>

  </head>
  <body>

  <h2><?php echo $name; ?></h2>

  <table name="QuizList">
      <tr>
      <th>#</th>
      <th>Question</th>
      <th>Answer</th>
      </tr>

  <?php include('../scripts/php/QuizList.php') ?>
</table>
<br><br>
<a class="button" href="Review.php?user=<?php echo $user; ?>">Return to Homepage</a>

  </body>
</html>
