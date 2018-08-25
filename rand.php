<?php
define('THIS_IS_NYANN', 'LOL');

include ('./template/header.tpl');
include ('./engine/database.php');

$r = getRandWord();

$aw = getWordsAssoc();

word ($r['id'], $r['word'], format($aw, $r['description'], $r['id']), $r['link']);

include ('./template/footer.tpl');

?>