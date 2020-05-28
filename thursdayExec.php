<?php
require("/Users/naoki/trello_automation/trelloAutomation/trelloAutomationController.php");

class ThursdayExec extends trelloAutomation
{

}

$thursdayExec = new ThursdayExec;
$boardId = $thursdayExec->getBoardIdByBoardName(); #boardId取得
if ($boardId) echo "could not find boardId"; exit;
$listId = $thursdayExec->getListIdByBoardId($boardId, '木'); #特定のリストId取得
if ($listdId) echo "could not find listId"; exit;
$cardsInfo = $thursdayExec->getCardsInfoByListId($listId); #リスト内のカード情報取得
if ($cardsInfo) echo "could not find cardsInfo"; exit;
$thursdayExec->execLabelingToCardsInList($cardsInfo, 'red'); #ラベリング実行第二引数でラベルの色指定