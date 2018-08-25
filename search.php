<?php
define('THIS_IS_NYANN', 'LOL');

include ('./template/header.tpl');
include ('./engine/database.php');

?> 
<form name="se" action="search.php" method="GET">
	<label for="sea">Хули надо?</label>
	<input type="text" name="q" value="<?=$_GET['q'];?>" class="edit">
	<br>
	<input type="submit" class="button" value="Встуц!">
</form>
<?
if (isset($_GET['q']))
{
	$q = $_GET['q'];
	if (empty($q))
	{
		mesg ('Эм... А где запрос-то? Ммм? Пустые поля искать не умеем.');
	}
		else
	{
		$res = searchWords($q);
		if (count($res) <= 0)
		{
			mesg ('Нус, сус! По твоему запросу ничего не найдено!');
		} else
		{
			$aw = getWordsAssoc();
			foreach ($res as $w)
			{
				
				word ($w['id'], $w['word'], format($aw, $w['description']), $w['link']);
			}
		}
	}
}

include ('./template/footer.tpl');
?>