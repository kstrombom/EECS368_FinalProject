function canvasFunc() {
    problem.generate();
    //creates actual bball and hoop objects
    var ball = new Image();
    var hoop1 = new Image();
    var hoop2 = new Image();
    var hoop3 = new Image();
    var hoopImg = "assets/images/hoop.png";
    //when page loads, position objects
    ball.onload = function() {
        ctx.drawImage(ball, 450, 475);
    }
    ball.src = "assets/images/ball.png";

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


    var canvas = document.getElementById("canvas");
    var ctx = canvas.getContext("2d");
    var canvasOffset = $("#canvas").offset();
    var offsetX = canvasOffset.left;
    var offsetY = canvasOffset.top;
    var canvasWidth = canvas.width;
    var canvasHeight = canvas.height;
    var isDragging = false;

    function question() {
        //this is an example of how we would do random questions
        return problem.question;
    }

    //text tests--------
    ctx.font = "30px Stencil";
    ctx.fillStyle = "black";
    ctx.textAlign = "center";
    ctx.fillText(question(), canvas.width / 2, canvas.height / 2);
    //------------------

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
        if (isDragging) {
            //clear screen, reposition everything with new ball position
            ctx.clearRect(0, 0, canvasWidth, canvasHeight);
            ctx.drawImage(hoop1, 80, 25);
            ctx.drawImage(hoop2, 410, 25);
            ctx.drawImage(hoop3, 730, 25);
            ctx.fillText(problem.options[0], (80 + 175 / 2), (175 / 2));
            ctx.fillText(problem.options[1], (410 + 175 / 2), (175 / 2));
            ctx.fillText(problem.options[2], (730 + 175 / 2), (175 / 2));
            ctx.fillText(question(), canvas.width / 2, canvas.height / 2);
            ctx.drawImage(ball, canMouseX - 100 / 2, canMouseY - 100 / 2);
            collide(canMouseX - 100 / 2, canMouseY - 100 / 2);
        }
    }

    //checks if ball is in hoops
    function collide(x, y) {
        if (x >= 60 && x < 140 &&
            y >= 25 && y < 75) {

            alert("correct!");

        }
        else if (x >= 390 && x < 470 &&
            y >= 25 && y < 75) {

            alert("wrong!");

        }
        else if (x >= 710 && x < 790 &&
            y >= 25 && y < 75) {

            alert("wrong!");
        }
    }

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
