//Custom JQuery functions for practice.html

var problems = [
    {
        'question':'test question number 1',
        'answer':'2',
        'option_1':'option number 1',
        'option_2':'option number 2',
        'option_3':'option number 3'
    },    
    {
        'question':'test question number 2',
        'answer':'1',
        'option_1':'option number 1',
        'option_2':'option number 2',
        'option_3':'option number 3'
    }
    
    ];
    
$('input[type="submit"]').click(function(){
    alert("clicked submit!");
});