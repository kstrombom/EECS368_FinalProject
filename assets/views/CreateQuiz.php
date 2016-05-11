<html>
  <head>
    <title>Create Quiz</title>
    <meta content="UTF-8">
<link rel="stylesheet" type="text/css" href="../styles/siteStandard.css">
<script defer src="../scripts/js/CreateQuiz.js"></script>
  </head>


  <body>

    <form action = "../scripts/php/CreateQuiz.php" name="Questions" method = "post">
      <span style="color: #150873; font-size:120%;"> Quiz Name</span><br>
      <input name="QuizName" type="text"><br><br><br>

      <?php
      $user=$_GET['user'];
      echo "<input type='hidden' name='user' value='$user'>";
      ?>


      <div id="dynamicInput">
        Question 1<br><input name ="Questions[]" type="text"><br>
        Answer 1<br><input name = "Answers[]" type="number"><br><br>
      </div>
      <input name = "submit" type="submit" value = "Create Quiz">
    </form>

    <button type="button" onclick="addInput('dynamicInput');">Add a question</button>


  </body>
</html>
