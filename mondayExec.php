<?php
require("/Users/naoki/trello_automation/trelloAutomation/trelloAutomationController.php");

class MondayExec extends trelloAutomation
{

}

$mondayExec = new MondayExec;
//boardId取得
$boardId = $mondayExec->getBoardIdByBoardName();
//特定のリストId取得
$listId = $mondayExec->getListIdByBoardId($boardId, '月');
//リスト内のカード情報取得
$cardsInfo = $mondayExec->getCardsInfoByListId($listId);
//ラベリング実行第二引数でラベルの色指定)
$mondayExec->execLabelingToCardsInList($cardsInfo, 'red');
