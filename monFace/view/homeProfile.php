<div class="profile-header">
    <?php if($context->getSessionAttribute('user')['avatar']) {?>
		<img src="<?php echo ($context->getSessionAttribute('user')['avatar'])?>" class="rounded-circle avatar" alt="avatar">
    <?php 
        } else { 
    ?>
                <img src="images/user.png" class="rounded-circle avatar" alt="avatar">
    <?php } ?>
</div>
<div class="profile-body text-center" >
    <span class="profile-name d-block font-weight-bold "> <?php echo ($context->getSessionAttribute('user')['nom'].' '.$context->getSessionAttribute('user')['prenom']);  ?></span>
    <span class="profile-bithday d-block text-muted"> 
        <?php 
            $dtime = DateTime::createFromFormat("Y-m-d H:i:s", $context->getSessionAttribute('user')['date_de_naissance']);
            $timestamp = $dtime->getTimestamp();
            echo date("d F o",$timestamp);  
        ?>
    </span>
</div>
