<?php
define('THIS_IS_NYANN', 'LOL');

require_once('./engine/recaptchalib.php');

function form ($word, $description, $link = '')
{
	?>
	<form name="sy" action="add.php" method="POST">
		<label for="w">Слово:</label>
		<input type="text" name="word" id="w" class="edit" value="<?=$word;?>">
		<br>
		<label for="d">Описание:</label>
		<textarea name="description" id="d" class="text"><?=$description;?></textarea>
		<br>
		<label for="l">Ссылка на выпуск (не обязательно, только youtube):</label>
		<input type="url" name="link" id="l" class="edit" value="<?=$link;?>">
		<br>
		Защита от пиздунов-сасов:
		<? echo recaptcha_get_html(RECAP_PUBLIC); ?>
		<br>
		<div style="text-align: right;"><input type="submit" value="Оэлютс!" class="button"></div>
	</form>
	<?
}

include ('./template/header.tpl');
include ('./engine/database.php');

if (isset($_POST['word']) && isset($_POST['description']))
{
	$word = htmlspecialchars($_POST['word']);
	$desc = htmlspecialchars($_POST['description']);
	$link = htmlspecialchars($_POST['link']);
	
	if (empty($word) || empty($desc))
	{
		error ('Ну и пиздун же вы, сас!<br>Где описание или слово?');
		form ($word, $desc);
	}
		else
	{
	$resp = recaptcha_check_answer (RECAP_SEC,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);
								
		if (!$resp->is_valid) {
			mesg ('Ммм, блять, пиздец. Ты неправильно разгадал капчу.');
			form($word, $desc, $link);
		}
		else
		{
			addTempWord($word, $desc, $link);
			mesg ('Фразу в датабазу оэлютс! Якуб проверит её.<br>А пока, по традиции, под аплодиции зрительного сала, идите нахуй!');
		}
	}
}
	else
		form('', '');

?>


<?
include ('./template/footer.tpl');
?>