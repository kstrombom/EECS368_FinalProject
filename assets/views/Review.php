<!-- Styling from W3Schools-->

<html>
 <head>
  <title>Overview Page</title>
<link rel="stylesheet" type="text/css" href="../styles/siteStandard.css">
 </head>
   <h2>Quizzes</h2>
   
   <small>*Click the access code to view student results</small><br>
   <small>*Click the name to view the quiz created</small>
    <form action = "../scripts/php/ReviewDelete.php" id="delete" method = "post">
       <div><?php include('../scripts/php/ReviewTable.php') ?> </div>
    <input type="submit" value="Delete" >
    </form>


    <br>
    <br>
    <a class="button" href="CreateQuiz.php?user=<?php echo $user; ?>">Create Quiz Here</a>
    <br><br>

 </body>
</html>
