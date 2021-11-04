<?php

namespace Models;

class Users extends Database
{
	public function createNewUser(string $nickName, string $password, $isAdmin)
    {
        return $this -> query("INSERT INTO users (nickName, password, isAdmin) 
        VALUES (?, ?, ?)", [$nickName, $password, $isAdmin]);
    }
    
    public function getUserByNickName(string $nickName)
    {
        return $this -> findOne("SELECT idUser, nickName, password, isAdmin from users
        WHERE nickName = ?", [$nickName]);
    }
}