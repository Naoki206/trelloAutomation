<?php
require("/Users/naoki/trello_automation/trelloAutomation/trelloAutomationController.php");

class FridayExec extends trelloAutomation
{

}

$fridayExec = new FridayExec;
$boardId = $fridayExec->getBoardIdByBoardName(); #boardId取得
if ($boardId) echo "could not find boardId"; exit;
$listId = $fridayExec->getListIdByBoardId($boardId, '金'); #特定のリストId取得
if ($listdId) echo "could not find listId"; exit;
$cardsInfo = $fridayExec->getCardsInfoByListId($listId); #リスト内のカード情報取得
if ($cardsInfo) echo "could not find cardsInfo"; exit;
$fridayExec->execLabelingToCardsInList($cardsInfo, 'red'); #ラベリング実行第二引数でラベルの色指定