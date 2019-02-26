    <div class="container page">
    <div class="row">
        <div class="col-12 profile">
            <div class="profile-header">
               <?php if( $context->user[0]['avatar'] ){ ?>
                    <img src="<?php echo($context->user[0]['avatar']);?>" class="rounded-circle avatar" alt="avatar">
                <?php } else { ?>
                    <img src="./images/user.png" class="rounded-circle avatar" alt="avatar">
                <?php } ?>
            </div>   
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="profile-body text-center" >
                <div class="d-flex justify-content-around">
                    <button type="button" class="btn btn-primary" href="#" id="posterBtn"><i class="fa fa-edit"></i> Poster</button>
                    <button type="button" class="btn btn-success" href="#" id="suiverBtn"><i class="fa fa-plus"></i> Suiver <span id="nbrFolwers"> 0 </span></button>
                </div>
                <div class="links">
                    <ul class="list-group list-links">
                        <li class="list-group-item">
                                <span class="text-mutted">
                                    <?php 
                                        $dtime = DateTime::createFromFormat("Y-m-d H:i:s", $context->user[0]['date_de_naissance']);
                                        $timestamp = $dtime->getTimestamp();
                                        echo date("d F o",$timestamp);  
                                     ?>
                                </span>
                        </li>
                        <li class="list-group-item">
                            <span><i class="fa pull-left fa-google"></i><a href="#" class="alert-link"> www.google.com</a></span>
                        </li>
                        <li class="list-group-item">
                            <span><i class="fa pull-left fa-facebook-square"></i><a href="#" class="alert-link"> www.facebook.com</a></span>
                        </li>
                        <li class="list-group-item">
                            <span><i class="fa pull-left fa-twitter-square"></i><a href="#" class="alert-link"> www.twitter.com</a></span>
                        </li>
                </div>
                <div class="txt text-mutted"> <h4> <i class="fa fa-users"></i> Liste des amis:</h4></div>
                <?php include 'homeFriends.php';?>
            </div>
        </div>
        <div class="col-8 informations">
            <div class="d-flex justify-content-between">
                <h3><span class="d-block font-weight-bold "> <?php echo ($context->user[0]['nom'].' '.$context->user[0]['prenom']);  ?></span></h3>
            </div>
            <h5><span class="d-block text-muted"><?php echo($context->user[0]['statut']);?> </span></h5> 
            <div class="container-fluid mt-4 ">
                <div class="row">
                    <div class="col-md-8" id='posts'>
                    <?php /*if($context->post != false){
                        for ($i = 0; $i < sizeof($context->post) ; $i++){?>
                        <div class="card post">
                            <div class="card-body">
                                <?php if($context->post[$i]['avatar']) {?>
									<h5 class="card-title"><img src="<?php echo($context->post[$i]['avatar'])?>" alt="user" class="fp-picture"><?php echo('  '.$context->post[$i]['nom'].' '.$context->post[$i]['prenom'].' > '.$context->user[0]['nom'].' '.$context->user[0]['prenom']);?></h5>
								<?php }else{ ?>
									<h5 class="card-title"><img src="./images/user.png" alt="user" class="fp-picture"><?php echo('  '.$context->post[$i]['nom'].' '.$context->post[$i]['prenom'].' > '.$context->user[0]['nom'].' '.$context->user[0]['prenom']);?></h5>
								<?php } ?>
                                <h6 class="card-subtitle mb-2 text-muted">
                                <?php 
                                    echo ($context->post[$i]['date']);
                                ?>
                                </h6>
                                <p class="card-text"><?php echo( $context->post[$i]['texte']);?></p>
                                <?php
                                    if($context->post[$i]['image']){
                                ?>
                                    <img class="mx-auto d-block post-picture" src="<?php echo( $context->post[$i]['image']);?>" alt="image">
                                <?php
                                    }
                                ?>
                                <div class="post-icons">
                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="btn btn-outline-danger" href="#"><i class="fa fa-heart post-icon"> <?php echo(' '.$context->post[$i]['aime'].'  '); ?> </i></button>
                                     
                                        <button type="button" class="btn btn-outline-danger" href="#"><i class="fa fa-share-alt post-icon"> 0</i></button>
                                    </div>
                                </div>
                            </div>                    
                        </div>
                    <?php }}*/?>
                    </div>
                </div>
            </div>   
        </div>
    </div>
    </div>
    <div class="add-post" style="display:none" title="Poster">
        <form enctype="multipart/form-data">
            <div class="form-group friend-add-post">
                <textarea class="form-control msg-content" id="messageContentF"  placeholder="Ecrire dans le profil de ton ami ..." rows="3"></textarea>
                 <input type="hidden" id="destinataire" value="<?php echo($context->user[0]['id']);?>"/>
            </div>
            <input type="file" id="imageFr" name="image" class="btn" accept="image/*"></button>
            <button type="button" onclick="sendMessageF()" class="btn btn-light pull-right">Poster</button>
        </form>
    </div>
<script>
    var emetteurId = <?php echo ($context->getSessionAttribute('user')['id'])?>;
	function sendMessageF(){
		var message = {
            emetteur:emetteurId ,
            destinataire:$("#destinataire").val(),
			texte : $("#messageContentF").val()
		};
        var formData = new FormData();
        formData.append("message", JSON.stringify(message));
        formData.append("image", $("#imageFr").prop("files")[0]);
		$.ajax({
			type: 'POST',
			url: 'monFace.php?action=saveMessage',
            cache: false,
            contentType: false,
            processData: false,
			data: formData,
			success: function(msg){
                getFriendPosts();
                $("#messageContentF").val('');
                $("#imageFr").val('');
			}
		});
	}
</script>


<script>
function getFriendPosts() {
    $.ajax({
        url:"monFace.php?action=getFriendPosts&id=<?php echo($context->user[0]['id']);?>",  
        success:function(data) {
            $('#posts').empty();
            var posts = JSON.parse(data);
            for(i=0; i< posts.length; i++){

                var cardPost = $('<div/>', {
                    class: 'card post'
                });
                cardPost.appendTo('#posts')

                var cardBody = $('<div/>', {
                    class: 'card-body'
                });
                cardBody.appendTo(cardPost)
                
                var cardTitle = $('<h5/>', {
                    class: 'card-title ',
                    html:"<strong>"+posts[i].nom+" "+posts[i].prenom + "</strong> <i class='fa fa-arrow-circle-right '></i> <strong><?php echo($context->user[0]['nom'].' '.$context->user[0]['prenom'])?> </strong>" 
                });
                cardTitle.appendTo(cardBody)

                var postAvatar = $('<img/>', {
                    class: 'fp-picture pull-left rounded-circle',
                    alt: "user" ,
                    src: posts[i].avatar ? posts[i].avatar : "./images/user.png"
                });
                postAvatar.appendTo(cardTitle);

                var isNew = new Date() - new Date(posts[i].date) <= 3600000 ? 'nouveau': '' ;

                var postDate = $('<h6/>', {
                    class: 'card-subtitle mb-2 text-muted dt',
                    html :  " <small class='badge badge-secondary'>"+posts[i].date+"</small> <span class='badge badge-success'>"+isNew+"</span> <br/>",
                });
                postDate.appendTo(cardTitle);

                var postTexte = $('<p/>', {
                    class: 'card-text',
                    html:posts[i].texte
                });
                postTexte.appendTo(cardTitle);
                
                
                if(posts[i].image){
                    var postImage = $('<img/>', {
                        class: 'mx-auto d-block post-picture',
                        alt: "image" ,
                        src: posts[i].image
                    });
                     postImage.appendTo(cardTitle);
                }
               

                var postIcons = $('<div/>', {
                    class: 'post-icons'
                });
                postIcons.appendTo(cardTitle);

                var postIcon = $('<div/>', {
                    class: 'd-flex justify-content-between'
                });
                postIcon.appendTo(postIcons);
                
                var iconLike = $('<a/>', {
                    class: 'btn btn-outline-danger',
                    href: 'monFace.php?action=likeFriend&id='+<?php echo($context->user[0]['id'])?>+'&idp='+posts[i].id ,
                });
                iconLike.appendTo(postIcon);

                var iconLikeIcon = $('<i/>', {
                    class: 'fa fa-heart post-icon',
                    html:" "+posts[i].aime
                });
                iconLikeIcon.appendTo(iconLike);

                var iconShare = $('<a/>', {
                    class: 'btn btn-outline-danger',
                    href: 'monFace.php?action=share&ids='+posts[i].id,
                });
                iconShare.appendTo(postIcon);

                var iconShareIcon = $('<i/>', {
                    class: 'fa fa-share-alt post-icon'
                });
                iconShareIcon.appendTo(iconShare);
            }

        }
    })
}
getFriendPosts();
</script> 
<script>
    var nbr = 0 ;
$("#suiverBtn").on("click",function(){
    console.log("test");
    nbr++ ;
    $("#nbrFolwers").html(nbr) ;
})
</script>   

    <?php include 'homeChat.php';?>
