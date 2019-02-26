<div class="container-fluid mt-4 ">
    <div class="row">
        <div class="col-8" id="posts">
         <!-- script posts -->
        </div>
    </div>
</div>
<script>

function getPosts() {
    $.ajax({
        url:"/~uapv1900168/monFace.php?action=getPosts",  
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
                    
                    html:"<strong>"+posts[i].nom+" "+posts[i].prenom + "</strong> <i class='fa fa-arrow-circle-right '></i> <strong><?php echo($context->getSessionAttribute('user')['nom'].' '.$context->getSessionAttribute('user')['prenom'])?> </strong>" 
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
                    class: 'card-subtitle mb-2 dt',
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
                    class: 'd-flex justify-content-between post-div'
                });
                postIcon.appendTo(postIcons);
               
                var iconLike = $('<a/>', {
                    class: 'btn btn-outline-danger post-like-btn',
                    href: 'monFace.php?action=like&id='+posts[i].id ,
                });
                iconLike.appendTo(postIcon);
                
                var iconLikeIcon = $('<i/>', {
                    class: 'fa fa-heart post-icon',
                    html:" "+posts[i].aime
                });
                iconLikeIcon.appendTo(iconLike);

            }

        }
    })
}
getPosts();

</script>
