<?php
/*
 * Controler 
 */
class mainController
{
	public static function index($request,$context)
	{
		
		return context::SUCCESS;
    }
    
    /*
    * action info qui nous fourni une page qui contient des informations générales sur le site
    */

    public static function info($request,$context)
	{
		return context::SUCCESS;
    }

    /**
     * action qui fait la connection
     */
   
   public static function login($request,$context)
   {
       if(isset($request['userName']) && isset($request['password'])){
        $user = utilisateurTable::getUserByLoginAndPass($request['userName'], $request['password']);
        if($user != false){
            $context->setSessionAttribute('user', $user[0]);
            $context->redirect("/~uapv1900168/monFace.php?action=home");
        }
        else{
            $context->error= "Login ou mot de passe incorrect"; 
            return context::ERROR;
        }
       }
       return context::SUCCESS;
   }
   /*
   * action du déconnection
   */

    public static function logout($request,$context)
    {
        $context->setSessionAttribute('user', null);
        $context->redirect("/~uapv1900168/monFace.php?action=login");
        return context::SUCCESS;
    }
    /*
    * action que permet de recupérer les chats sans fourni aucun vue 
    */
    public static function getChats($request,$context){
        $chats = chatTable::getChats();
        $context->body= $chats;
        return context::NONE;
    }
    /*
    * action que permet de recupérer les posts sans fourni aucun vue 
    */
    public static function getPosts($request,$context){
        $post =postTable::getPostByUserId($context->getSessionAttribute('user')['id']);
        $context->body= $post;
        return context::NONE;
    }
    /*
    * action que permet de recupérer les posts des amis sans fourni aucun vue 
    */
    public static function getFriendPosts($request,$context){
        $post =postTable::getPostByUserId($_GET['id']);
        $context->body= $post;
        return context::NONE;
    }
    /*
    * action que permet de enregistrer les chats dans la base de donné
    */
    public static function saveChat($request,$context){
        $chat = (array) json_decode($_POST['chat']);
        $file = $_FILES['image'];
        $fileName = "img_".uniqid();
        if($file && $file["name"] != ""){
            $ext = pathinfo($file["name"], PATHINFO_EXTENSION);
            $fileName = $fileName.".".$ext; 
            move_uploaded_file($file["tmp_name"], "images/".$fileName);
            $chat["image"] = "https://pedago02a.univ-avignon.fr/~uapv1900168/images/".$fileName;
            //$chat["image"] = "http://monface/images/".$fileName;
        }
        $context->body = chatTable::saveChat($chat);
        return context::NONE;
    }
    /*
    * action que permet de enregistrer les messages dans la base de donné
    */
    public static function saveMessage($request,$context){
        $message = (array) json_decode($_POST['message']);
        $file = $_FILES['image'];
        // définir un nom unique pour les images pour éviter l'écrasement
        $fileName = "img_".uniqid();
        if($file && $file["name"] != ""){
            $ext = pathinfo($file["name"], PATHINFO_EXTENSION);
            $fileName = $fileName.".".$ext; 
            move_uploaded_file($file["tmp_name"], "images/".$fileName);
            $message["image"] = "https://pedago02a.univ-avignon.fr/~uapv1900168/images/".$fileName;
            //$message["image"] = "http://monface/images/".$fileName;
        }
        $context->body = messageTable::saveMessage($message);
        //$context->body = $message;
        return context::NONE;
    }
    /*
    * action de la page d'acceuil
    */
    public static function home($request,$context)
    {   
	$chat = chatTable::getLastChat();
    $chats = chatTable::getChats();
    $post = postTable::getPostByUserId($context->getSessionAttribute('user')['id']);
    $users = utilisateurTable::getUsers();
    if($users != false && $post != false){
        $context->users= $users ;
        $context->post= $post ;
        $context->chats = $chats;
        $context->chat = $chat;
    }
    else{
         return context::ERROR;
    }
      return context::SUCCESS;
    }
    /*
    * action qui retourne la vue du profil personnel  
    */
    public static function profil($request,$context)
    {
        $chats =chatTable::getChats();
        $user=utilisateurTable::getUserById($context->getSessionAttribute('user')['id']);
		if($chats != false){
            $context->chats = $chats;
            $context->user= $user;
		}
		else{
			 return context::ERROR;
		}
          return context::SUCCESS;
    }
    /*
    * action qui retourne la vue du profil d'un ami  
    */
    public static function friendProfil($request,$context)
    {
        //récuperation du id depuis l'http
        $id = $_GET['id'] ;
        $user=utilisateurTable::getUserById($id);
        $chats =chatTable::getChats();
        $post =postTable::getPostByUserId($id);
        $users = utilisateurTable::getUsers();
        if($user != false && $users != false){
            $context->user = $user;
            $context->post= $post ;
            $context->users = $users;
            $context->chats = $chats;
        }
        else{
    
            return context::ERROR;
        }

        return context::SUCCESS;
    }
    /*
    * action qui affiche la list des amis 
    */
    public static function friends($request,$context)
    {
        $users = utilisateurTable::getUsers();
        if($users != false){
            $context->users = $users;
        }
        else{
            return context::ERROR;
        }
        return context::SUCCESS;
    }

    /**
     * action qui fait le j'aime dans le profil de l'utilisateur 
     */

    public static function like($request, $context)
    {
        $id=$_GET['id'];
        messageTable::like($id)[0];
        return context::SUCCESS;
    }
    /*
    * action qui fait le partage
    */
        
    public static function share($request, $context)
    {
        $ids=$_GET['ids'];
        if(!empty($ids)) {
            $msg=messageTable::getMessagesById($ids)[0];
            $pst=postTable::getPostById($msg['post'])[0];
            $user = utilisateurTable::getUserById($msg['emetteur'])[0];
            $postA=[];
            $postA['date'] = date('Y-m-d H:i:s');
            $postA['texte'] = '<strong>Parent</strong> : '.$user['nom'].' '.$user['prenom'].'</br>'.$pst['texte'];
            $postA['image'] = $pst['image'];
            $post = new post($postA);
            $idp = $post->save();
            $messageA = [];
            $messageA['parent'] = $msg['emetteur'];
            $messageA['post'] = $idp;
            $messageA['aime'] = 0;
            $messageA['destinataire']=$context->getSessionAttribute('user')['id'];
            $messageA['emetteur']=$context->getSessionAttribute('user')['id'];
            $message = new message($messageA);
            $id = $message->save();
            return context::SUCCESS;
        }
        return context::ERROR;
    }
    /**
     * action qui fait le j'aime dans le profil d'un ami 
     */
    public static function likeFriend($request, $context)
    {
        $idp=$_GET['idp'];
        messageTable::like($idp)[0];
        return context::SUCCESS;
    }
    /**
     * action qui permet d'éditer le statut 
     */

    public static function statut($request, $context)
	{
        $user=utilisateurTable::getUserById($context->getSessionAttribute('user')['id']);
		if(isset($request['statut'])) {
            $statut = utilisateurTable::editStatut($request['statut'],$context->getSessionAttribute('user')['id']);
			return context::SUCCESS;
		}
		return context::ERROR;
    }



    
}
