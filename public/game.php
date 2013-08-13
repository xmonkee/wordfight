<?php

class Game
{
	public static function pickCurWord($level)
	{
		return R::load('words',Flight::get('allWords')[rand(max(0, Flight::get('windows')[$level]-WINDOWSIZE),Flight::get('windows')[$level]-1)]); 
	}
	public function pickRandWords()
	{
		$randWords=array();
		for($i = 0; $i < OPTIONS; $i++) $randWords[$i] = R::load('words',rand(1,Flight::get('wordCount'))); 
		return $randWords;
	}
}
