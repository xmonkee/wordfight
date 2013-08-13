<?php

class User
{

	public static function create()
	{
		$user = array();
		$user['level'] = 1;
		$user['exp'] = 0;
		$user['score'] = 0;
		$user['lives'] = 3;
		$user['message'] = 'start';
		$user['isnew'] = false;
		return $user;
	}

	public static function load()
	{
		return $_SESSION['user'];
	}
	public static function save($user)
	{
		$_SESSION['user'] = $user;
	}

	public function incr($user)
	{
		$user['exp']++;
		$user['score']+=pow($user['level']+$user['exp'],3);
		$user['message']='success';
		if($user['exp'] > LVLUPCHANGE) {
			if($user['level'] < LEVELS)
			{
				$user['level']++; 
				$user['exp']=0;
			}
		}
		$user['isnew'] = false;
		return $user;
	}

	public static function decr($user)
	{
		$user['exp']--;
		$user['lives']--;
		$user['message']='failure';
		if($user['exp'] < -LVLDNCHANGE) {
			$user['exp']=0;
			if($user['level'] > 1)
			{
				$user['level']--; 
			}
		}
		if($user['lives']<1)
		{
			$user['message']='gameOver';
		}
		$user['isnew'] = false;
		return $user;
	}
}
