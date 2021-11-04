<?php

session_start();

spl_autoload_register(function($class)
{
	include str_replace("\\","/", lcfirst($class)) . '.php';
});

if(isset($_GET['page']))
{
	switch($_GET['page'])
	{
		case 'signUp' :
	    	$controller = new Controllers\SignUpController();
	    	break;
	    case 'signIn' : 
	        $controller = new Controllers\SignInController();
	        break;
        case 'ajaxTask':
			$controller = new Controllers\HomeController();
			$controller -> updateInput();
			break;
	}
}
else
{
    $controller = new Controllers\HomeController();
    $controller -> checkLog();
}