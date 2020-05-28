<?php
require("/Users/naoki/trello_automation/trelloAutomation/trelloAutomationController.php");

class TuesdayExec extends trelloAutomation
{

}

$tuesdayExec = new TuesdayExec;
$boardId = $tuesdayExec->getBoardIdByBoardName(); #boardId取得
if ($boardId) echo "could not find boardId"; exit;
$listId = $tuesdayExec->getListIdByBoardId($boardId, '火'); #特定のリストId取得
if ($listdId) echo "could not find listId"; exit;
$cardsInfo = $tuesdayExec->getCardsInfoByListId($listId); #リスト内のカード情報取得
if ($cardsInfo) echo "could not find cardsInfo"; exit;
$tuesdayExec->execLabelingToCardsInList($cardsInfo, 'red'); #ラベリング実行第二引数でラベルの色指定