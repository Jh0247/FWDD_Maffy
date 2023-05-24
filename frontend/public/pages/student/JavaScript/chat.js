//  $(document).on('click', '.send_chat', function(){
//   var to_user_id = $(this).attr('id');
//   var chat_message = $('#chat_message'+to_user_id).val();
//   $.ajax({
//    url:"insert_chat.php",
//    method:"POST",
//    data:{to_user_id:to_user_id, chat_message:chat_message},
//    success:function(data)
//    {
//     $('#chat_message'+to_user_id).val('');
//     $('#chat_history_'+to_user_id).html(data);
//    }
//   })
//  });

$(document).ready(function(){

    $("#send").on("click",function(){
        $.ajax({
            url:"insertMessage.php",
            method:"POST",
            data:{
                fromUser: $("#fromUser").val(),
                toUser: $("#toUser").val(),
                message: $("#message").val()
            },
            dataType:"Text",
            success:function(data){
                $("#message").val("");
            }
        })
    });
});