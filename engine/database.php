<?php
if (!defined('THIS_IS_NYANN'))
	header ('Location: http://natribu.org');


include ('enconfig.php');
include ('mysql.php');


function editWord($id, $word, $description, $link = '')
{
	return MySql::i()->query('UPDATE `words` SET `word` = ?,`description` = ?,`link` = ? WHERE `id` = ?', $word, $description, $link, $id);
}

function wordsCount()
{
	return MySql::i()->query('SELECT COUNT(*) FROM `words`')->fetch();
}


function getLastWords ($count)
{
	return MySql::i()->query('SELECT `id`,`word` FROM `words` ORDER BY `id` DESC')->fetchAll();
}

function getWordByID($id)
{
	return MySql::i()->query('SELECT `id`,`word`,`description`,`link` FROM `words` WHERE `id` = ?', $id)->fetch();
}

function searchWords($seterm)
{
	return MySql::i()->query("SELECT `id`,`word`,`description`,`link` FROM `words` WHERE (`word` LIKE ?) OR (`description` LIKE ?)", '%'.$seterm.'%', '%'.$seterm.'%')->fetchAll();
}

function getAllWords()
{
	
	$res = MySql::i()->query('SELECT `id`,`word`,`description`,`link` FROM `words` ORDER BY `word` ASC')->fetchAll();
	return $res;
}

function getWordsAssoc()
{
	$res = MySql::i()->query('SELECT `id`,`word` FROM `words`')->fetchAll();
	return $res;
}

function getTempWords()
{
	
	$res = MySql::i()->query('SELECT `id`,`word`,`description`,`link` FROM `tempwords`')->fetchAll();
	return $res;
}

function getRandWord()
{
	return MySql::i()->query('SELECT `id`,`word`,`description`,`link` FROM `words` ORDER BY RAND() LIMIT 1')->fetch();
}

function addNewWord($word, $description, $link = '')
{
	return MySql::i()->query('INSERT INTO `words` (`word`, `description`, `link`) VALUES(?, ?, ?)', $word, $description, $link);
}

function rejectWord($id)
{
	return MySql::i()->query('DELETE FROM `tempwords` WHERE `id`= ?', $id);
}

function approveWord($id)
{
	$word = MySql::i()->query('SELECT `word`,`description`,`link` FROM `tempwords` WHERE `id` = ?', $id)->fetch();
	rejectWord($id);
	return addNewWord($word['word'], $word['description'], $word['link']); 
}

function addTempWord($word, $description, $link = '')
{
	return MySql::i()->query('INSERT INTO `tempwords` (`word`, `description`, `link`) VALUES(?, ?, ?)', $word, $description, $link);
}