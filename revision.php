<?php
define('THIS_IS_NYANN', 'LOL');

include ('./engine/database.php');

if (isset($_GET['authentic']) && ($_GET['authentic'] == md5(CDN_PASS.'nyan'.CDN_SALT)))
{
	include ('./template/header.tpl');
	if (isset($_GET['id']) && is_numeric($_GET['id']) && ($_GET['id'] > 0))
	{
		$id = $_GET['id'];
		
		if (isset($_GET['ed']))
		{
			$word = $_POST['word'];
			$desc = $_POST['description'];
			$link = $_POST['link'];
			editWord($id, $word, $desc, $link);
			mesg ('Edited ;3');
		}
			elseif (isset($_GET['edit']))
		{
			$nyann = getWordByID($id);
			$word = $nyann['word'];
			$desc = $nyann['description'];
			$link = $nyann['link'];
			?>
				<form name="sy" action="revision.php?authentic=<?=$_GET['authentic'];?>&id=<?=$id;?>&ed" method="POST">
				<label for="w">Слово:</label>
				<input type="text" name="word" id="w" class="edit" value="<?=$word;?>">
				<br>
				<label for="d">Описание:</label>
				<textarea name="description" id="d" class="text"><?=$desc;?></textarea>
				<br>
				<label for="l">Ссылка на выпуск (не обязательно, только youtube):</label>
				<input type="url" name="link" id="l" class="edit" value="<?=$link;?>">
				<br>
				<div style="text-align: right;"><input type="submit" value="Оэлютс!" class="button"></div>
				</form>
			<?
		}
	}
		


	
	$nyans  = getAllWords();
	// Няяяяяяяяя
	foreach ($nyans as $nyan)
	{
		$link = $nyan['link'];
		$description = $nyan['description'];
		$id = $nyan['id'];
		$word = $nyan['word'];
		wordEditor($id, $word, $description, $link, $_GET['authentic']);
	}

} 
	else
{
	if (isset($_POST['authentic']))
	{
		if ($_POST['authentic'] == CDN_PASS)
		{
			$ahash = md5($_POST['authentic'].'nyan'.CDN_SALT);
			header('Location: revision.php?authentic='.$ahash);
		}
			else header('Location: http://natribu.org');
	}
		else
	{
		include ('./template/header.tpl');

		?>
				<form name="a" action="revision.php" method="POST">
					<input type="password" name="authentic" class="edit">
					<br>
					<input type="submit" class="edit" value=":3">
				</form>
		<?

	}
}

include ('./template/footer.tpl');
?>


