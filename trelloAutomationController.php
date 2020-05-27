<?php
require("/Users/naoki/trello_automation/trelloInfoConstant.php");

class trelloAutomation extends TrelloInfoConstant
{
    public function execCurlProcess($curl, $parameter){
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $parameter);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 証明書の検証を行わない
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // curl_execの結果を文字列で返す
        return curl_exec($curl);;
    }

    public function getBoardIdByBoardName(){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->baseUrl. '/members/me/boards?key=' . $this->key . '&token=' . $this->token);
        $response = $this->execCurlProcess($curl, 'GET');
        $boardsInfo   = json_decode($response, true);
        curl_close($curl);
        foreach ($boardsInfo as $board) {
            if ($board['name'] == $this->boardName) {
                return $board['id'];
            }
        }
        return false;
    }

    public function getListIdByBoardId($boardId, $dayOfTheWeek) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->baseUrl. '/boards/' . $boardId . '/lists?key=' . $this->key . '&token=' . $this->token);
        $response = $this->execCurlProcess($curl, 'GET');
        $listsInfo   = json_decode($response, true);
        curl_close($curl);

        //特定のリストのid取得
        foreach ($listsInfo as $key => $list) {
            if ($list['name'] ==  $dayOfTheWeek) {
                return $list['id'];
            }
        }
        return false;
    }

    public function getCardsInfoByListId($listId){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->baseUrl. '/lists/' . $listId . '/cards?key=' . $this->key . '&token=' . $this->token);
        $response = $this->execCurlProcess($curl, 'GET');
        curl_close($curl);
        return json_decode($response, true);
    }

    public function execLabelingToCardsInList($cardsInfo, $color) {  
        foreach ($cardsInfo as $card) {
            $cardId  = $card['id'];
            $color   = $color;
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $this->baseUrl. '/cards/' . $cardId . '/labels?color=' . $color . '&key=' . $this->key . '&token=' . $this->token);
            $response = $this->execCurlProcess($curl, 'POST');
            $result   = json_decode($response, true);
            curl_close($curl);
            var_dump($result);
        }
    }
}