<?php
require("/Users/naoki/trello_automation/trelloAutomation/trelloAutomationController.php");
//引数 1 曜日
//引数 2 ラベルの色

class Exec extends trelloAutomation
{
     /**
     *　該当変数がfalseな場合処理をexit
     * 
     * @param array $variableName
     * @param string $arg
     */
    public function argumentExists($variableName, $arg=false) {
        if (!$arg) {
            echo "could not find " . $variableName;
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