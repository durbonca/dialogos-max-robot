$(document).ready(function(){
    $(".close").click(function()
    {
        
        setTimeout(function(){ $("#alert_success").alert('close'); }, 3000);
        
    });
});  