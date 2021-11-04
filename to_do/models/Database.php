<?php

namespace Models;


abstract class Database
{
	protected $bdd;
	
	public function __construct()
	{
		$this -> bdd = new \PDO('mysql:host=db.3wa.io;dbname=hermannbru_to_do_list;charset=utf8','hermannbru','4ac06bc7fdfaae90d824d8585d340e25');
	}
	
	public function findAll(string $req,array $params = []):array
	{
		$query = $this -> bdd -> prepare($req);
		$query -> execute($params);
		return $query -> fetchAll(\PDO::FETCH_ASSOC);
	}
	
	
	public function findOne(string $req,array $params = []):?array
	{
		$query = $this -> bdd -> prepare($req);
		$query -> execute($params);
		$result =  $query -> fetch(\PDO::FETCH_ASSOC);
		
		if($result == false)
		{
			return null;
		}
		else
		return $result;
	}
	
	public function query(string $req,array $params = [])
	{
		$query = $this -> bdd -> prepare($req);
		$query -> execute($params);
	}
}