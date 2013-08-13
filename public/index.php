<?php

define('LEVELS',10);
define('OPTIONS',4);
define('LVLUPCHANGE',0);
define('LVLDNCHANGE',0);
define('WINDOWSIZE',1000);

require_once __DIR__.'/../vendor/autoload.php';
use RedBean_Facade as R;
R::setup('sqlite:./data/WordCram');
require_once 'init.php';

Flight::route('/', function(){

	session_start();
	if(!isset($_SESSION['user'])){
		$user = User::create();
		User::save($user);
	} 
	else
	{
		$user = User::load();
	}

	if($user['isnew']) $user = User::decr($user);

	if(isset($user['word'])) $prevWord = R::load('words',$user['word']);
	else $prevWord='';

	$randWords = Game::pickRandWords();
	$curWord = Game::pickCurWord($user['level']);
	$selected = rand(0,OPTIONS-1);
	$randWords[$selected] = $curWord;
	$user['word']= $curWord->id;
	$user['isnew'] = true;
	User::save($user);


	Flight::render('index', array
		(
			'prevWord' =>$prevWord,
			'randWords'=>$randWords,
			'selected' =>$selected,
			'user'=>$user,
		));
});


Flight::route('/answer/@i', function($i){

	session_start();
	if(!isset($_SESSION['user'])) Flight::redirect('/');

	$user = User::load();
	$curWordID = $user['word'];
	if($curWordID == $i):
		$user=User::incr($user);
	else:
		$user=User::decr($user);
	endif;
	User::save($user);
	Flight::redirect('/');
});


Flight::route('/reboot' ,function()
	{
		session_start();
		session_destroy();
		Flight::redirect('/');
	});

Flight::start();
