<?php
define('THIS_IS_NYANN', 'LOL');

include ('./template/header.tpl');
include ('./engine/database.php');

?>
<div class="error">
	<b>Внимание! Warning! 警告!</b>
	<br>
	Этот сайт содержит ненормативную лексику и прочие ужасные по мнению некоторых нежных личностей вещи. Если вы не приемлете подобный контент — воздержитесь от просмотра сайта.
</div>
<div class="infobox-intro">
Адапцегевааа дэвэжоюхар дущирвоу! Пятница, в эфире кал-шоу &laquo;Сэйдиснилю&raquo;!
<br>
Этот сайт посвящён охуитительному шоу, поддерживаемому <a href="https://vk.com/orgiveup">Ильёй Дятловым</a>. Шоу основано на &laquo;Поле чудес&raquo;, однако носит своеобразный характер и раскрывает весь потенциал немного уныловатого оригинала.
<br>
Этот сайт — словарь, составленный по Сэйдиснилю. Тут можно найти всё что угодно касательно всеми нами любимого шоу. Он чем-то напоминает Википедию, однако наполнение пользователей анально модерируется для поддержания качества. 
</div>
<b>Последние добавленные слова:</b>
<?
$wrd = getLastWords(5);

for ($i = 4; $i >= 0; $i--)
{
	$id = $wrd[$i]['id']; $w = $wrd[$i]['word']; 
	?>
	<a href="./word.php?pizdidal=<?=$id;?>"><?=$w;?></a><?
	if ($i != 0)
		echo (', ');
	else
		echo (' ');
}
include ('./template/footer.tpl');
?>