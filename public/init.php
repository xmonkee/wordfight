<?php

Flight::register('game','Game');

Flight::map('sset', function($key, $value){
	$_SESSION[$key] = $value;
});
Flight::map('sget', function($key){
	return $_SESSION[$key];
});

$allWords = R::getCol('select id from words order by popularity DESC');
$wordCount=R::count('words');
$windows=array();

$window = floor($wordCount/LEVELS);
for($i=0; $i <= LEVELS; $i++) {$windows[] = (int) $i * $window;}
$windows[LEVELS]=$wordCount;

Flight::set('allWords',$allWords);
Flight::set('windows',$windows);
Flight::set('wordCount',$wordCount);
