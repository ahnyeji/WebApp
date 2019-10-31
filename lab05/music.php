<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Music Library</title>
		<meta charset="utf-8" />
		<link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/5/music.jpg" type="image/jpeg" rel="shortcut icon" />
		<link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/labResources/music.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<h1>My Music Page</h1>

		<!-- Ex 1: Number of Songs (Variables) -->
		<p>
			I love music.
			<?php
				$song_count = 5678;
				print "I have " . $song_count . " total songs, ";
				print "which is over " . (int)($song_count/10) . " hours of music!";
			?>
		</p>

		<!-- Ex 2: Top Music News (Loops) -->
		<!-- Ex 3: Query Variable -->
		<div class="section">
			<h2>Billboard News</h2>

			<ol>
				<?php
					$init_year = 2019;
					$init_month = 11;
					$news_pages = 5;
					if (isset($_GET["newspages"])) {
						$news_pages = (int)$_GET["newspages"];
					}
					for ($i = 0; $i < $news_pages; $i++){
						$month = $init_month - $i;
						$year = $init_year;
						while ($month < 1){
							$year--;
							$month+=12;
						}
						if ($month < 10) {
							$month = "0" . $month;
						}
					?>
						<li><a href="https://www.billboard.com/archive/article/<?= $year ?><?= $month ?>"><?= $year ?>-<?= $month ?></a></li>
				<?php
					}
				?>
			</ol>
		</div>

		<!-- Ex 4: Favorite Artists (Arrays) -->
		<!-- Ex 5: Favorite Artists from a File (Files) -->
		<div class="section">
			<h2>My Favorite Artists</h2>

			<ol>
				<?php
					// $artists = array("Guns N' Roses", "Green Day", "Blink182");
					// $artists[] = "Taylor Swift";
					$artists = file("./favorite.txt");
					foreach ($artists as $artist) { ?>
						<li><a href="http://en.wikipedia.org/wiki/<?= str_replace(" ", "_",$artist) ?>"><?= $artist ?></a></li>
				<?php
					}
				?>

			</ol>
		</div>

		<!-- Ex 6: Music (Multiple Files) -->
		<!-- Ex 7: MP3 Formatting -->
		<div class="section">
			<h2>My Music and Playlists</h2>

			<ul id="musiclist">
				<?php
					$songs = glob("lab5/musicPHP/songs/*.mp3");
					// print_r ($songs);
					$fsizes = array();
					foreach ($songs as $song) {
						$fsizes[] = (int)(filesize($song)/1024);
					}
					arsort($fsizes);
					foreach ($fsizes as $key => $fsize) { ?>
						<li class="mp3item"><a href="<?= $songs[$key] ?>" download><?= basename($songs[$key]) ?></a> (<?= $fsize ?> KB)</li>
				<?php
					}
				?>


				<!-- Exercise 8: Playlists (Files) -->
				<?php
					$m3us = glob("lab5/musicPHP/songs/*.m3u");
					rsort($m3us);
					foreach ($m3us as $m3u) { ?>
						<li class="playlistitem"><?= basename($m3u) ?>:
							<ul>
								<?php
									$musics = file($m3u);
									shuffle($musics);
									foreach ($musics as $music) {
										if (strpos($music, '#') === false) { ?>
											<li><?= $music ?></li>
									<?php
										}
									?>
								<?php
									}
								?>
							</ul>
						</li>
				<?php
					}
				?>

			</ul>
		</div>

		<div>
			<a href="https://validator.w3.org/check/referer">
				<img src="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/w3c-html.png" alt="Valid HTML5" />
			</a>
			<a href="https://jigsaw.w3.org/css-validator/check/referer">
				<img src="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/w3c-css.png" alt="Valid CSS" />
			</a>
		</div>
	</body>
</html>
