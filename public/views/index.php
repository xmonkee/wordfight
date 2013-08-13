<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Wordfight! by Mandu</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	
	<link href="/views/css/bootstrap.cyborg.css" rel="stylesheet">
	<style>
	.btn {
		white-space: normal;
	}
	.btn-large {
		padding: 5px 16px;
		font-size: 18px;
		border-radius: 4px;
	}
	.btn-default {
		background-color: #4242422
		border-color: #424242;
	}
	.btn-default:hover,
	.btn-default:focus,
	.btn-default:active,
	.btn-default.active {
		background-color: #e67a00;
		border-color: #cc6d00;
	}
	.alert {
		border-radius: 4px;
	}
	.well {
		border-radius: 4px;
	}
	</style>

</head>

<body>
	<div class="container">
		<br>
		<div class="row" id="game wells">
			<div class="col-lg-8" id="question column">
				<div class="well well-small">
					<div class="row" id="score row">
						<div class="col-4">
								<h3><small>Score </small><?php echo $user['score']; ?></h3>
						</div>
						<div class="col-4">
								<h3><small>Lvl </small><?php echo $user['level']; ?></h3>
						</div>
						<div class="col-4">
								<h3><small>Lives </small><?php echo $user['lives']; ?></h3>
						</div>
					</div>
				</div>
				<?php if($user['message']!='gameOver'): ?>
					<div class="row" id="main question">
						<div class="col-lg-12">
							<div class="well">
							<h1> <?php echo ucfirst($randWords[$selected]->word); ?> </h1>
								<?php for($i=0; $i<4; $i++) : ?>
									<a href="/answer/<?php echo $randWords[$i]->id ?>" class="btn btn-default btn-large btn-block"> <?php echo (preg_replace('/;.*$/','',$randWords[$i]->meaning)); ?> </a>
								<?php endfor; ?>
							</div>
						</div>
					</div>
			</div>
			<div class="col-lg-4" id="previous well">
				<?php endif; ?>
				<div class="well">

					<?php switch ($user['message']): 
					case 'start': ?>

						<div class="alert alert-info">
							<h2>
								Let's Play Wordfight!
							</h2> 
						</div>
							<h4> Select the correct meaning of word </h4>


					<?php break; 
					case 'success': ?>

						<div class="alert alert-success">
							<h2>
								Correct!
							</h2> 
						</div>
						<h2>
							<?php echo ucfirst($prevWord->word); ?>
						</h2>
						<ol>
							<li>
								<?php echo preg_replace('/;/', '</li><li>', $prevWord->meaning); ?>
							</li>
						</ol>

					<?php break; 
					case 'failure': ?>

						<div class="alert alert-danger">
							<h2>
								Wrong!
							</h2> 
						</div>
						<h2>
							<?php echo ucfirst($prevWord->word); ?>
						</h2>
						<ol>
							<li>
								<?php echo preg_replace('/;/', '</li><li>', $prevWord->meaning); ?>
							</li>
						</ol>

					<?php break; 
					case 'gameOver': ?>

						<div class="alert alert-danger">
							<h2>
								Game Over!
							</h2> 
						</div>
						<h2>
							<a href="/reboot" class="btn btn-large btn-default btn-block"> Start again... </a>
							<?php echo ucfirst($prevWord->word); ?>
						</h2>
						<ol>
							<li>
								<?php echo preg_replace('/;/', '</li><li>', $prevWord->meaning); ?>
							</li>
						</ol>

					<?php endswitch; ?>

				</div>
			</div>
		</div>
	</div>
</body>
</html>
