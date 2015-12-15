



jQuery(document).ready(function($){
 //Registration metabox

 $('#add-student').click(function(){

   $class_name = $(this).attr('data-class');

   $.ajax({
     type: "POST",
     url: 'http://localhost/gardens/wp-admin/admin-ajax.php',
     data: {class:$class_name,
            first_name: jQuery('#students-first-name').val(),
            last_name: jQuery('#students-last-name').val(),
            action:'add_student'}
   }).done(function(response){

     if(response){

       // make the response equal to the username

       $('#tester-div').append(jQuery('#students-first-name').val());
     }
   })

 });

})
