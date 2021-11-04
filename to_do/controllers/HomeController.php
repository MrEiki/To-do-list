<?php

namespace Controllers;

class HomeController
{
    
    public function __construct()
	{
        if(isset($_GET['action']) && $_GET['action'] == 'deleteTask')
        {
        	$this -> deleteTask();
        }
        else if(!empty($_POST['task']))
        {
        	$this -> addNewTask();
        }
        else if(!isset($_GET['action']))
        {
	        $this->display();
        }
	}
    
	public function display()
	{
		$model = new \Models\TaskList();
		
		if(isset($_SESSION['admin']))
		{
	        $tasks = $model -> getAllTasks();
		}
		else if(isset($_SESSION['users']))
		{
	        $tasks = $model -> getTasksById($_SESSION['idUser']);
		}
		
		$template = "views/home.phtml";
		include 'views/layout.phtml';
	}
	
	public function addNewTask()
    {
    	$model = new \Models\TaskList();
    	$createTask = $model -> createNewTask($_POST['task'], $_SESSION['idUser']);
    	
    	header('Location: index.php');
		exit;
    }
    
    public function updateInput()
	{
		$data = file_get_contents('php://input');
		
		$recup = json_decode($data);
		
		$model = new \Models\TaskList();
		
		$updateTask = $model -> updateTask($recup -> task, $recup -> id);
		
		$tasks = $model -> getAllTasks();
		
		include 'views/home.phtml';
	}
    
	public function deleteTask()
	{
		$model2 = new \Models\TaskList();
		$deletetask = $model2 -> deleteTaskById($_GET['id']);
		
		header('Location: index.php');
		exit;
	}
	
    //méthode pour se déconnecter
    public function checkLog()
    {
        if(isset($_GET['action']) && $_GET['action'] == 'deco')
        {
        	session_destroy();
        	header("Location: index.php");
        	exit;
        }
    }
}