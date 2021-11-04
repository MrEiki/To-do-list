<?php

namespace Controllers;

class SignInController
{
	private $message;
	
	public function __construct()
	{
		$this -> message = "";
		
		if(!empty($_POST))
        {
        	$this -> check();
        }
        else
        {
        	$this -> display();
        }
        
        if(isset($_SESSION['users']))
		{
			header('Location: index.php');
			exit;
		}
	}
	
	public function display()
	{
		$nickName = '';
		
		$template = "views/signIn.phtml";
		include 'views/layout.phtml';
	}
	
	public function check()
    {
        //soumission du formulaire de connexion
    	
    	$nickName = $_POST['nickName'];
    	$pw = $_POST['pw'];
    	
    	$model2 = new \Models\Users();
    	$user = $model2 -> getUserByNickName($nickName);
    	
    	if(!$user)
    	{
    		$this -> message = "Mauvais pseudo";
    	}
    	else
    	{
    		if(password_verify($pw,$user['password']))
    		{
    			if($user['isAdmin'] == 1)
    			{
	    			$_SESSION['admin'] = $user['nickName'];
	    			$_SESSION['adminIdUser'] = $user['idUser'];
    			}
    			else
    			{
    				$_SESSION['users'] = $user['nickName'];
	    			$_SESSION['idUser'] = $user['idUser'];
    			}
    			header('Location: index.php');
	    		exit;
    		}
    		else
    		{
    			$this -> message = "Mauvais mot de passe";
    		}
    	}
    	
    	$template = "views/signIn.phtml";
		include 'views/layout.phtml';
    }
}