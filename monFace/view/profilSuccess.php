<div class="container page">
    <div class="row">
        <div class="col-12 profile">
            <div class="profile-header">
				<?php if($context->getSessionAttribute('user')['avatar']) {?>
					<img src="<?php echo ($context->user[0]['avatar'])?>" class="rounded-circle avatar" alt="avatar">
				<?php }else{ ?>
					<img src="images/avatar.jpg" class="rounded-circle avatar" alt="avatar">
				<?php } ?>
            </div>   
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="profile-body text-center" >
                <div class="d-flex justify-content-around">
                    <a type="button" class="btn btn-danger" href="monFace.php?action=home"><i class="fa fa-edit"></i> Poster</a>
                    <a type="button" class="btn btn-danger" href="monFace.php?action=home"><i class="fa fa-eye"></i> Postes</a>
                </div>
                <div class="links">
                    <ul class="list-group list-links">
                        <li class="list-group-item">
                                <span class="text-mutted">Date de naissance :</span>
                                <span>
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
            </div>
        </div>
        <div class="col-8 informations">
            <h1><span class="d-block font-weight-bold "> <?php echo ($context->user[0]['nom'].' '.$context->user[0]['prenom']);  ?></span></h1>
            
            <h5><span class="d-block text-muted">
                <?php if($context->getSessionAttribute('user')['statut']){
                    print_r($context->user[0]['statut']);
                 }else{ ?> 
                    ...
                <?php }?>
                    <button class="btn btn-danger" onclick="editStatut()">
                        <i class="fa fa-edit"></i>
                    </button>
                </span>
            </h5>   

            <form action="monFace.php?action=statut" method="POST" id="updateStatusForm" style="display:none">
                <div class="control-group">
                    <input type="text" name="statut" id="statut" placeholder="statut" value="...">
                    <button type="submit" class="btn btn-outline-danger"><i class="fa fa-share-square"></i></button>
                </div>
            </form>   

        </div>
    </div>
</div>
<?php include 'homeChat.php';?>


