
        <div class="friends">
            <ul class="list-group list-friends">
               <?php for ($i = 0; $i <sizeof($context->users) ; $i++){?>
                <li class="list-group-item">
                    <a href="/~uapv1900168/monFace.php?action=friendProfil&id=<?php echo($context->users[$i]['id']);?>" class="item-color"> 
                    <?php if($context->users[$i]['avatar']) {?>
                        <img src="<?php echo ($context->users[$i]['avatar'])?>" alt="user" class="friend-picture">
                    <?php 
                        } else { 
                    ?>
                                <img src="images/user.png" class="friend-picture" alt="user">
                    <?php } ?>
                       <span> <?php print_r($context->users[$i]['concat']); }?> </span>
                    </a>
                </li>
            </ul>

        </div>
  
