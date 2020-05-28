<?php
require("/Users/naoki/trello_automation/trelloAutomation/trelloAutomationController.php");

class WednesdayExec extends trelloAutomation
{

}

$wednessdayExec = new WednesdayExec;
$boardId = $wednessdayExec->getBoardIdByBoardName(); #boardId取得
if ($boardId) echo "could not find boardId"; exit;
$listId = $wednessdayExec->getListIdByBoardId($boardId, '水'); #特定のリストId取得
if ($listdId) echo "could not find listId"; exit;
$cardsInfo = $wednessdayExec->getCardsInfoByListId($listId); #リスト内のカード情報取得
if ($cardsInfo) echo "could not find cardsInfo"; exit;
$wednessdayExec->execLabelingToCardsInList($cardsInfo, 'red'); #ラベリング実行第二引数でラベルの色指定