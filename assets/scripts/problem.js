problem = {};
problem.xVal = 0;
problem.yVal = 0;
problem.question = "";
problem.options = [];


problem.generate = function() {

    var randomType = Math.floor((Math.random() * 3) + 1);

    this.xVal = Math.floor((Math.random() * 10) + 1);
    this.yVal = Math.floor((Math.random() * 10) + 1);
    if (randomType == 1) {
        this.question = this.xVal + " + " + this.yVal;
        this.options[0] = this.xVal + this.yVal;
        this.options[1] = this.xVal + this.yVal + Math.floor((Math.random() * 3) + 1);
        this.options[2] = this.xVal + this.yVal - Math.floor((Math.random() * 3) + 1);
    }
    if (randomType == 2) {
        this.question = this.xVal + " - " + this.yVal;
        this.options[0] = this.xVal - this.yVal;
        this.options[1] = this.xVal - this.yVal + Math.floor((Math.random() * 3) + 1);
        this.options[2] = this.xVal - this.yVal - Math.floor((Math.random() * 3) + 1);
    }
    if (randomType == 2) {
        this.question = this.xVal + " x " + this.yVal;
        this.options[0] = this.xVal * this.yVal;
        this.options[1] = this.xVal * this.yVal + Math.floor((Math.random() * 3) + 1);
        this.options[2] = this.xVal * this.yVal - Math.floor((Math.random() * 3) + 1);
    }
};