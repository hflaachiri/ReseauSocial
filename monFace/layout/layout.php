<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>
     Mon Face
    </title>
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
    <script src="./bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
    <link href="./css/<?php echo $action; ?>.css" rel="stylesheet">
 
     
  </head>

  <body>
      <div class="bandeau-notification">
        <?php 
          if($action != 'login' && isset($_SESSION['user'])){
        ?>
          <ul class="navbar " style="background-color: #EE4439;" >
              <div class="icon-bar">
                <a href="/~uapv1900168/monFace.php?action=home" data-toggle="tooltip" data-placement="bottom" title="Acceuil"><i class="fa fa-home "></i></a> 
                <a href="/~uapv1900168/monFace.php?action=profil" data-toggle="tooltip" data-placement="bottom" title="Profil"><i class="fa fa-user"></i></a>  
                <a href="/~uapv1900168/monFace.php?action=friends" data-toggle="tooltip" data-placement="bottom" title="Liste des amis"><i class="fa fa-users"></i></a> 
                <a href="/~uapv1900168/monFace.php?action=info" data-toggle="tooltip" data-placement="bottom" title="Informations"><i class="fa fa-info-circle "></i></a> 
                <a href="/~uapv1900168/monFace.php?action=login" data-toggle="tooltip" data-placement="bottom" title="Déconnexion"><?php echo ($context->getSessionAttribute('user')['nom'].' '.$context->getSessionAttribute('user')['prenom']);  ?>  <i class="fa fa-power-off"></i> </a> 
            </div>
          </ul>  
        <?php
          }
        ?>
       <?php include $template_view;?> 
       <script>
          $( function() {
			  $( "#chat" ).resize();
              $( "#chat" ).draggable();
              $( ".add-post" ).dialog({
                width : '50%',
                classes: {"ui-dialog": "z-index-100"}
              });
              $( ".add-post" ).dialog("close");
              $( "#fenetre" ).click(function() {
                $( ".chat-messages" ).slideToggle( "slow", function() {});
                $( ".chat-message" ).slideToggle( "slow", function() {});
              });
               
          });
          $("#posterBtn").click(function() {
               $( ".add-post" ).dialog("open");
          });
		   $("#addImageBtn").click(function() {
               $( ".add-image" ).dialog("open");
          });
          function editStatut(){
              $("#updateStatusForm").show();
          }        
       </script>
  </body>


