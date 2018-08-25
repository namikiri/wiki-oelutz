<?php
define('THIS_IS_NYANN', 'LOL');

include ('engine/database.php');

if (isset($_GET['authentic']) && ($_GET['authentic'] == md5(CDN_PASS.'nyan'.CDN_SALT)))
{
	if (isset($_GET['id']) && is_numeric($_GET['id']) && ($_GET['id'] > 0))
	{
		$m = $_GET['mode'];
		$id = $_GET['id'];
		switch ($m)
		{
			case 'accept' : approveWord($id); break;
			case 'reject' : rejectWord($id); break;
			default : error ('Это живой огурец.');
		}
	}

	include ('./template/header.tpl');
	$nyans  = getTempWords();
	if (count($nyans) <= 0)
	{
		mesg ('Все слова проверены!');
	} 
	else
	foreach ($nyans as $nyan)
	{
		$link = $nyan['link'];
		$description = $nyan['description'];
		$id = $nyan['id'];
		$word = $nyan['word'];
		word($id, $word, $description, $link, true, $_GET['authentic']);
	}

} 
	else
{
	if (isset($_POST['authentic']))
	{
		if ($_POST['authentic'] == CDN_PASS)
		{
			$ahash = md5($_POST['authentic'].'nyan'.CDN_SALT);
			header('Location: approver.php?authentic='.$ahash);
		}
			else header('Location: http://natribu.org');
	}
		else
	{
		include ('./template/header.tpl');

		?>
				<form name="a" action="approver.php" method="POST">
					<input type="password" name="authentic" class="edit">
					<br>
					<input type="submit" class="edit" value=":3">
				</form>
		<?

	}
}

include ('./template/footer.tpl');
?>


