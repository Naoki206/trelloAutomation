<?php
require("/Users/naoki/trello_automation/trelloAutomation/trelloAutomationController.php");

class WednesdayExec extends trelloAutomation
{

}

$wednessdayExec = new WednesdayExec;
//boardId取得
$boardId = $wednessdayExec->getBoardIdByBoardName();
//特定のリストId取得
$listId = $wednessdayExec->getListIdByBoardId($boardId, '水');
//リスト内のカード情報取得
$cardsInfo = $wednessdayExec->getCardsInfoByListId($listId);
//ラベリング実行第二引数でラベルの色指定)
$wednessdayExec->execLabelingToCardsInList($cardsInfo, 'red');






