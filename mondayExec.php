<?php
require("/Users/naoki/trello_automation/trelloAutomation/trelloAutomationController.php");

class MondayExec extends trelloAutomation
{

}

$mondayExec = new MondayExec;
$boardId = $mondayExec->getBoardIdByBoardName(); #boardId取得
if ($boardId) echo "could not find boardId"; exit;
$listId = $mondayExec->getListIdByBoardId($boardId, '月'); #特定のリストId取得
if ($listdId) echo "could not find listId"; exit;
$cardsInfo = $mondayExec->getCardsInfoByListId($listId); #リスト内のカード情報取得
if ($cardsInfo) echo "could not find cardsInfo"; exit;
$mondayExec->execLabelingToCardsInList($cardsInfo, 'red');#ラベリング実行第二引数でラベルの色指定
