<?php

namespace Controllers;

class SignUpController
{
    //déclarer une propriété dans une classe
    private $message;
    
    public function __construct()
    {
        // $this->display();
        $this -> message = "";
        
        //réception du formulaire d'inscription
        if(!empty($_POST))
        {
            $this -> check();
        }
        else
        {
            $this->display();
        }
        
        //redirection si déjà connecté
        if(isset($_SESSION['users']))
        {
            header('Location: index.php');
            exit;
        }
    }
    
    //fonction d'affichage
    public function display()
    {
        $nickName = '';
        
        $template = "views/signUp.phtml";
        include 'views/layout.phtml';
    }
    
    //vérification des info du formulaire
    public function check()
    {

        $nickName = $_POST['nickName'];
        $pw = $_POST['pw'];
        $pw2 = $_POST['confirmPw'];
        
        $model2 = new \Models\Users();
    	$verifyNickName = $model2 -> getUserByNickName($nickName);
        
        //inutile si formulaire en required
        if(empty($nickName) || empty($pw) || empty($pw2))
        {
            $this -> message = "Champ vide";
        }
        else
        {
            if(!$verifyNickName)
            {
                if($pw == $pw2)
                {
                $pwhash = password_hash($pw, PASSWORD_DEFAULT);
                $this -> createUser($nickName, $pwhash);
                }
                else
                {
                $this -> message = "Mots de passe ne correspondent pas";
                } 
            }
            else
            {
                $this -> message = "Pseudo déjà utilisé";
                $nickName = '';
            }
        }
        
         
        $template = "views/signUp.phtml";
        include 'views/layout.phtml';
        
    }
    
    //création d'un nouvel utilisateur
    public function createUser($nickName, $pwhash)
    {
        if(!empty($_POST))
        {
        $model = new \Models\Users();
        $model -> createNewUser($nickName, $pwhash, 0);
        
        header('Location: SignIn');
        exit;
        }
    }
}