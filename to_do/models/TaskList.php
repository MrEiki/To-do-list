<?php

namespace Models;

class TaskList extends Database
{
    public function getAllTasks():array
    {
        return $this -> findAll("SELECT id, task, taskList.idUser, nickName FROM taskList
        INNER JOIN users ON taskList.idUser = users.idUser
        ORDER BY id");
    }
    
    public function getTasksById(int $id):array
    {
        return $this -> findAll("SELECT id, task, taskList.idUser, nickName FROM taskList
        INNER JOIN users ON taskList.idUser = users.idUser
        WHERE taskList.idUser = ?
        ORDER BY id", [$id]);
    }
    
    public function createNewTask(string $task, int $idUser)
    {
        return $this -> query("INSERT INTO taskList (task, idUser) 
        VALUES (?, ?)", [$task, $idUser]);
    }
    
    public function updateTask(string $task, int $id)
    {
        $this -> query("UPDATE taskList SET
        task = ?
        WHERE id = ?", [$task, $id]);
    }
    
    public function deleteTaskById(int $id)
    {
        return $this -> query("DELETE FROM taskList WHERE id = ?", [$id]);
    }
}