<div class="col-3 chat" id="chat" >
            <div class="fenetre" id="fenetre">
                <i class="fa fa-comments fenetre-text"> Conversation du groupe :</i>
            </div>
            <div class="chat-messages" id="chat-messages">
			<!-- contenu dans le fichier chatList.js -->
            </div>
            <form action="#" id="chat-message"  class="chat-message justify-content-between" enctype="multipart/form-data">
                <div style="display: flex ">
                    <div class="chat-avatar">
                        <?php if($context->getSessionAttribute('user')['avatar']) {?>
                            <img src="<?php echo ($context->getSessionAttribute('user')['avatar'])?>"alt="user" class="chat-picture rounded-circle">
                        <?php 
                            } else { 
                        ?>
                                    <img src="images/user.png" alt="user" class="chat-picture">
                        <?php } ?>
                    </div>
                    <textarea class="form-control message-input" id="chatContent" placeholder="Ecrire un message ..." rows="1" cols="15x"></textarea>
                    <button type="button" onclick="sendChat()"  class="btn btn-outline-danger pull-right btn-submit"><i class="fa fa-location-arrow"></i></button>
                </div>
                <input type="file" id="imageChat" name="image" class="btn" accept="image/*">

            </form>
        </div>

<script >
function getChats() {
    $.ajax({
      url:"/~uapv1900168/monFace.php?action=getChats",  
      success:function(data) {
          
          $('#chat-messages').empty();
          var chats = JSON.parse(data);
          for(i=0; i< chats.length; i++){
            var chatMessage = $('<div/>', {
                class: 'chat-message',
                style: 'display: flex'
            });
            chatMessage.appendTo('#chat-messages');
            var chatAvatar =  $('<div/>', {
                class: 'chat-avatar'
            });
            chatAvatar.appendTo(chatMessage);
            var chatImage = $('<img/>', {
                class: 'chat-picture rounded-circle',
                alt: "user" ,
                src: chats[i].avatar ? chats[i].avatar : "./images/user.png"
            });
            chatImage.appendTo(chatAvatar);
            var isNew = new Date() - new Date(chats[i].date) <= 3600000 ? 'nouveau': '' ;
            var chatTitle =  $('<div/>', {
               html: "<strong>"+chats[i].nom+" "+chats[i].prenom + "</strong> <br/> <small class='badge badge-secondary'>"+chats[i].date+"</small> <span class='badge badge-success'>"+isNew+"</span> <br/> " 
             //  html:chats[i].nom+" "+chats[i].prenom + " a écrit :<br>"
            });
            chatTitle.appendTo(chatMessage);

            var chatText =  $('<span/>', {
				class:'chat-txt',
                html:chats[i].texte
            });
            chatText.appendTo(chatTitle);
            
            if(chats[i].image){
                    var chatImage = $('<img/>', {
                        class: 'mx-auto d-block chat-pic',
                        alt: "image" ,
                        src: chats[i].image
                    });
                     chatImage.appendTo(chatTitle);
            }
        }
      }
    });
}
    getChats();
	var userId = <?php echo ($context->getSessionAttribute('user')['id'])?>;
	function sendChat(){
		var chat = {
			id: userId,
			content : $("#chatContent").val()
        };
        var formData = new FormData();
        formData.append("chat", JSON.stringify(chat));
        formData.append("image", $("#imageChat").prop("files")[0]);
		$.ajax({
            type: 'POST',
			url: '/~uapv1900168/monFace.php?action=saveChat',
            cache: false,
            contentType: false,
            processData: false,
			data: formData,
			success: function(msg){
                getChats();
                $("#chatContent").val('');
                $("#imageChat").val('');
			}
		});
    }

     window.setInterval(function(){
        getChats();
     }, 5000);
</script>
