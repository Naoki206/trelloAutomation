<?php
require("/Users/naoki/trello_automation/trelloAutomation/trelloAutomationController.php");

class TuesdayExec extends trelloAutomation
{

}

$tuesdayExec = new TuesdayExec;
//boardId取得
$boardId = $tuesdayExec->getBoardIdByBoardName();
//特定のリストId取得
$listId = $tuesdayExec->getListIdByBoardId($boardId, '火');
//リスト内のカード情報取得
$cardsInfo = $tuesdayExec->getCardsInfoByListId($listId);
//ラベリング実行第二引数でラベルの色指定)
$tuesdayExec->execLabelingToCardsInList($cardsInfo, 'red');
