<?php
if (!defined('THIS_IS_NYANN'))
	header ('Location: http://natribu.org');
	


function highlight($needle, $haystack, $id){
	mb_internal_encoding("UTF-8");
    $ind = mb_stripos($haystack, $needle);
    $len = mb_strlen($needle);
    if($ind !== false){
        return mb_substr($haystack, 0, $ind) . '<a href="./word.php?pizdidal='.$id.'">' . mb_substr($haystack, $ind, $len) . '</a>' .
            highlight($needle, mb_substr($haystack, $ind + $len), $id);
    } else return $haystack;
} 


function format ($database, $text, $cid)
{
	
	foreach ($database as $element)
	{
		if ($element['id'] != $cid)
		{
			$word = $element['word'];
			$wu = strtolower($word);
			$id = $element['id'];
			//$text = str_ireplace($word, '<a href="./word.php?pizdidal='.$id.'">'.$word.'</a>', $text); 
			$text = highlight($word, $text, $id);
			//$text = highlight($word, $wu, $id);
		}
	}
	
	return $text;
}

function wordEditor ($id, $word, $description, $link = '', $authentic = '')
{
	?>
		<div class="word">
			<b><?=$word;?></b> &mdash; <?=$description;?>

			<? if (!empty($link)) { ?>
			<br>
			Встречается в выпуске: <a href="<?=$link;?>"><?=$link;?></a>
			<? } 
			
				?>
					<br>
					<a href="revision.php?id=<?=$id;?>&authentic=<?=$authentic;?>&edit">edit</a>	
					</div> <?
}

	
function word ($id, $word, $description, $link = '', $temp = false, $authentic = '')
{
	?>
		<div class="word">
			<b><?=$word;?></b> &mdash; <?=$description;?>

			<? if (!empty($link)) { ?>
			<br>
			Встречается в выпуске: <a href="<?=$link;?>"><?=$link;?></a>
			<? } 
			
			if ($temp)
			{
				?>
					<br>
					<a href="approver.php?mode=accept&id=<?=$id;?>&authentic=<?=$authentic;?>">принять</a> |
					<a href="approver.php?mode=reject&id=<?=$id;?>&authentic=<?=$authentic;?>">отказать</a>
					
				<?
			}
			
			?> </div> <?
}

function mesg($m)
{
	?>
	<div class="mesg">
		<?=$m;?>
	</div>
	<?
}

function error($m)
{
	?>
	<div class="error">
		<?=$m;?>
	</div>
	<?
}