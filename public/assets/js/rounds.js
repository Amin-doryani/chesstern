
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

// $(document).ready(function() {
//     $('#mySelect').change(function() {
//         var value = $(this).val();

//         $.ajax({
//             var url = '{{ url("myroute") }}' + '/' + idter + '/' + value ;
//             method: 'get',
//             data: {
//                 value: selectedValue,
//                 _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token for security
//             },
//             success: function(response) {
//                 console.log('Value sent successfully:', response);
//             },
//             error: function(xhr, status, error) {
//                 console.error('Error sending value:', error);
//             }
//         });
//     });
// });



