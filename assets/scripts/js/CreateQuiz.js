 var counter = 1;
 var limit = 20;

 function addInput(divName) {
     if (counter == limit) {
         alert("You have reached the limit of adding " + counter + " inputs");
     }
     else {
         var newdiv = document.createElement('div');
         var newdiv2 = document.createElement('div');
         newdiv.innerHTML = "Question " + (counter + 1) + "<br><input type='text' name='Questions[]'><br>";
         newdiv2.innerHTML = "Answer " + (counter + 1) + "<br><input type='number' name='Answers[]'><br><br>";
         document.getElementById(divName).appendChild(newdiv);
         document.getElementById(divName).appendChild(newdiv2);
         counter++;
     }
 }