<?php
require("/Users/naoki/trello_automation/trelloAutomation/trelloAutomationController.php");

class FridayExec extends trelloAutomation
{

}

$fridayExec = new FridayExec;
//boardId取得
$boardId = $fridayExec->getBoardIdByBoardName();
//特定のリストId取得
$listId = $fridayExec->getListIdByBoardId($boardId, '金');
//リスト内のカード情報取得
$cardsInfo = $fridayExec->getCardsInfoByListId($listId);
//ラベリング実行第二引数でラベルの色指定)
$fridayExec->execLabelingToCardsInList($cardsInfo, 'red');
