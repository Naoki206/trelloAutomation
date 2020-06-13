<?php
require("/Users/naoki/trello_automation/trelloAutomation/trelloAutomationController.php");
//引数 1 曜日
//引数 2 ラベルの色

class Exec extends trelloAutomation
{
    public function argumentExists($name, $arg=false) {
        if (!$arg) {
            echo "could not find" . $name;
            exit;
        }
        return true;
    }
}

$dayOfTheWeek = $argv[1];
$labelingColor = $argv[2];

$exec = new Exec;
$boardId = $exec->getBoardIdByBoardName(); //boardId取得
$exec->argumentExists('board_id', $boardId);
$listId = $exec->getListIdByBoardId($boardId, $dayOfTheWeek); //特定のリストId取得
$exec->argumentExists('list_id', $listId);
$cardsInfo = $exec->getCardsInfoByListId($listId); //リスト内のカード情報取得
$exec->argumentExists('cards_info', $cardsInfo);
$exec->execLabelingToCardsInList($cardsInfo, $labelingColor); //ラベリング実行第二引数でラベルの色指定
echo "labeling successed";