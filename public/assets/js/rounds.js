
$(document).ready(function(){
    
    $("#link1").click(function(event){
        event.preventDefault(); 
        

        
        $("#players").hide();
        $('#link2').removeClass("selected");
        $('#link1').addClass("selected");
        $("#games").show().css('display', 'flex');
    });

    
    $("#link2").click(function(event){
        event.preventDefault(); 
        

        
        $("#games").hide();
        $('#link1').removeClass("selected");
        $('#link2').addClass("selected");
        $("#players").show();
    });
});
