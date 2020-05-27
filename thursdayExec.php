<?php
require("/Users/naoki/trello_automation/trelloAutomationController.php");

class ThursdayExec extends trelloAutomation
{

}

$thursdayExec = new ThursdayExec;
//boardId取得
$boardId = $thursdayExec->getBoardIdByBoardName();
//特定のリストId取得
$listId = $thursdayExec->getListIdByBoardId($boardId, '木');
//リスト内のカード情報取得
$cardsInfo = $thursdayExec->getCardsInfoByListId($listId);
//ラベリング実行第二引数でラベルの色指定)
$thursdayExec->execLabelingToCardsInList($cardsInfo, 'red');
