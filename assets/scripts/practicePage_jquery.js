var math_problems = 
[
    {
        'question':'1+1','answer':'c',options:['0','1','2']
        
    },
    {
        'question':'2-1','answer':'a',options:['1','7','3']
    }
];
var problem_index = 0;
var problem = null; 


$( document ).ready(function(){
    alert("practice page JQUERY functioning");
});

//Show a 'randomly' generated math problem
function showProblem(){
    
    alert("show problem was actually executed" +  math_problems[0].question);

};

alert("show problem is about to be executed");
showProblem();
