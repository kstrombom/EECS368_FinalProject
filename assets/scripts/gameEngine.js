gameEngine = {};
gameEngine.score = 0;
gameEngine.record = [0, 0];
gameEngine.problem = problem.generate();

gameEngine.newProblem = function() {
    this.problem = problem.generate();
};