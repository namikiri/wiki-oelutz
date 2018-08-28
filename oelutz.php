<?php
define('THIS_IS_NYANN', 'LOL');

include ('./template/header.tpl');
include ('./engine/database.php');


$words = getAllWords();

foreach ($words as $word)
{
	$w = $word['word'];
	$i = $word['id'];
	$d = $word['description'];
	$l = $word['link'];
	word($i, '<a href="./word.php?pizdidal='.$i.'">'.$w.'</a>', $d, $l);
}

include ('./template/footer.tpl');
?>