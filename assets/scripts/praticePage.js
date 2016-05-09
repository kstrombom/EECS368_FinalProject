function canvasFunc() {
	var score = 0;
	var correctOption;
	var lastOption = 4; //most recently used hoop
	
	var canvas = document.getElementById("canvas"); //grab canvas html elem
	var ctx = canvas.getContext("2d"); //game is in 2d
	var canvasOffset = $("#canvas").offset(); //mouse input is based off screen not canvas
	var offsetX = canvasOffset.left; //so this is how you make it based off the canvas
	var offsetY = canvasOffset.top;
	var canvasWidth = canvas.width;
	var canvasHeight = canvas.height;
	var isDragging = false; 
	
	var ball = new Image(); //create objects
	var hoop1 = new Image();
	var hoop2 = new Image();
	var hoop3 = new Image();
	var hoopImg = "assets/images/hoop.png";
	
	ball.onload = function() {
		ctx.drawImage(ball, 450, 475); //starting position for ball
	}
	ball.src = "assets/images/ball.png";

	var i = 60; //game time is 60 seconds
	function onTimer() {
  		document.getElementById('mycounter').innerHTML = i + "s left";
  		i--;
  		if (i < 0) { //if time is up
			ctx.fillStyle = "lightblue";
    			ctx.fillRect(0, 0, canvasWidth, canvasHeight);
			ctx.fillStyle = "black"
			ctx.fillText("Times Up! Your final score was " + score + " points" , canvasWidth/2, canvasHeight/2);
		}else{
    			setTimeout(onTimer, 1000);
  		}
	}
	
	function setup(){ 
		ctx.clearRect(0, 0, canvasWidth, canvasHeight); //clear screen
		//create red backgrounds
		ctx.fillStyle = "red"; 
		ctx.fillRect(0,550,175,600);
		ctx.fillRect(canvas.width/2 - 50, canvas.height/2 - 40, 100, 60);
		
		problem.generate(); //create random problem
		correctOption = Math.floor((Math.random() * (2 - 0 + 1)) + 0); //put correct answer in a random hoop
		while(correctOption == lastOption){ //but not in the same one as previously
			correctOption = Math.floor((Math.random() * (2 - 0 + 1)) + 0);
		}
		//write out answers in the hoops
		if(correctOption == 0){
			hoop1.onload = function() {
				ctx.drawImage(hoop1, 80, 25);
				ctx.fillText(problem.options[0], (80 + 175 / 2), (175 / 2));
			}
			hoop1.src = hoopImg;

			hoop2.onload = function() {
				ctx.drawImage(hoop2, 410, 25);
				ctx.fillText(problem.options[1], (410 + 175 / 2), (175 / 2));
			}
			hoop2.src = hoopImg;

			hoop3.onload = function() {
				ctx.drawImage(hoop3, 730, 25);
				ctx.fillText(problem.options[2], (730 + 175 / 2), (175 / 2));
			}
			hoop3.src = hoopImg;
		}else if(correctOption == 1){
			hoop1.onload = function() {
				ctx.drawImage(hoop1, 80, 25);
				ctx.fillText(problem.options[1], (80 + 175 / 2), (175 / 2));
			}
			hoop1.src = hoopImg;

			hoop2.onload = function() {
				ctx.drawImage(hoop2, 410, 25);
				ctx.fillText(problem.options[0], (410 + 175 / 2), (175 / 2));
			}
			hoop2.src = hoopImg;

			hoop3.onload = function() {
				ctx.drawImage(hoop3, 730, 25);
				ctx.fillText(problem.options[2], (730 + 175 / 2), (175 / 2));
			}
			hoop3.src = hoopImg;
		}else if (correctOption == 2){
			hoop1.onload = function() {
				ctx.drawImage(hoop1, 80, 25);
				ctx.fillText(problem.options[1], (80 + 175 / 2), (175 / 2));
			}
			hoop1.src = hoopImg;

			hoop2.onload = function() {
				ctx.drawImage(hoop2, 410, 25);
				ctx.fillText(problem.options[2], (410 + 175 / 2), (175 / 2));
			}
			hoop2.src = hoopImg;

			hoop3.onload = function() {
				ctx.drawImage(hoop3, 730, 25);
				ctx.fillText(problem.options[0], (730 + 175 / 2), (175 / 2));
			}
			hoop3.src = hoopImg;
		}
		//write score and the question 
		ctx.font = "30px Stencil";
		ctx.fillStyle = "black";
		ctx.textAlign = "center";
		ctx.fillText(question(), canvas.width / 2, canvas.height / 2);
		ctx.fillStyle = "black";
		ctx.fillText("Score: " + score, 75, 585);
	}

	function question() {
		return problem.question;
    	}

	//when mouse is clicked
	function handleMouseDown(e) {
		canMouseX = parseInt(e.clientX - offsetX);
		canMouseY = parseInt(e.clientY - offsetY);
		isDragging = true;
	}

    //when mouse is unclicked 
	function handleMouseUp(e) {
		canMouseX = parseInt(e.clientX - offsetX);
		canMouseY = parseInt(e.clientY - offsetY);
		isDragging = false;
	}

	//mouse leaves canvas area
	function handleMouseOut(e) {
		canMouseX = parseInt(e.clientX - offsetX);
		canMouseY = parseInt(e.clientY - offsetY);
	}

	//while dragging ball
	function handleMouseMove(e) {
		canMouseX = parseInt(e.clientX - offsetX);
		canMouseY = parseInt(e.clientY - offsetY);
		if (isDragging && i > 0) { //if dragging and there is still time left
			ctx.fillStyle = "black";
			//clear screen, reposition everything with new ball position
			ctx.clearRect(0, 0, canvasWidth, canvasHeight);
			ctx.drawImage(hoop1, 80, 25);
			ctx.drawImage(hoop2, 410, 25);
			ctx.drawImage(hoop3, 730, 25);
			if(correctOption == 0){
				ctx.fillText(problem.options[0], (80 + 175 / 2), (175 / 2));
				ctx.fillText(problem.options[1], (410 + 175 / 2), (175 / 2));
				ctx.fillText(problem.options[2], (730 + 175 / 2), (175 / 2));
			}else if(correctOption == 1){
				ctx.fillText(problem.options[1], (80 + 175 / 2), (175 / 2));
				ctx.fillText(problem.options[0], (410 + 175 / 2), (175 / 2));
				ctx.fillText(problem.options[2], (730 + 175 / 2), (175 / 2));
			}else if(correctOption == 2){
				ctx.fillText(problem.options[1], (80 + 175 / 2), (175 / 2));
				ctx.fillText(problem.options[2], (410 + 175 / 2), (175 / 2));
				ctx.fillText(problem.options[0], (730 + 175 / 2), (175 / 2));
			}
         
			ctx.fillStyle = "red";
			ctx.fillRect(0,550,175,600);
			ctx.fillRect(canvas.width/2 - 50, canvas.height/2 - 40, 100, 60);
			ctx.fillStyle = "black";
			ctx.fillText(question(), canvas.width / 2, canvas.height / 2);
			ctx.fillText("Score: " + score, 75, 585);
			ctx.drawImage(ball, canMouseX - 100 / 2, canMouseY - 100 / 2);
			//check if ball is in correct spot
			collide(canMouseX - 100 / 2, canMouseY - 100 / 2);
		}
	}

	//checks if ball is in any of the hoops, if its in the correct one increment the score
	function collide(x, y) {
		if (x >= 60 && x < 140 && y >= 25 && y < 75 && correctOption == 0) { //hoop1
			lastOption = correctOption; 
			score += 2;
			setup();
		}else if (x >= 390 && x < 470 && y >= 25 && y < 75 && correctOption == 1) { //hoop2
			lastOption = correctOption; 
			score += 2;
			setup();
		}else if (x >= 710 && x < 790 && y >= 25 && y < 75 && correctOption == 2) { //hoop3
			lastOption = correctOption; 
			score += 2;
			setup();
		}
	}
	
	onTimer();
	setup();
	//call mouse functions on canvas
	$("#canvas").mousedown(function(e) {
		handleMouseDown(e);
	});
	$("#canvas").mousemove(function(e) {
		handleMouseMove(e);
	});
	$("#canvas").mouseup(function(e) {
		handleMouseUp(e);
	});
	$("#canvas").mouseout(function(e) {
		handleMouseOut(e);
	});
}
