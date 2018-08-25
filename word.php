<?php
define('THIS_IS_NYANN', 'LOL');

include ('./template/header.tpl');
include ('./engine/database.php');

$id = $_GET['pizdidal'];

if (!empty($id) && is_numeric($id) && $id > 0)
{
	$re = getWordByID((int)$id);
	
	if ($re == NULL || $re == false)
	{
				error ('Ну и пиздун же вы, сас!<br>Нет такого ID! Идите нахуй!');
	} else
	
	if (count($re) > 0)
	{
		$aw = getWordsAssoc();
		word ($re['id'], $re['word'], format($aw, $re['description'], $re['id']), $re['link']);
	}
}
	else
		error ('Ну и что за хухню ты мне суёшь вместо ID? Как уебу!');

include ('./template/footer.tpl');

?>