<?php
require("/Users/naoki/trello_automation/trelloAutomation/trelloInfoConstant.php");

class trelloAutomation extends TrelloInfoConstant
{
    /**
     * curlの共通実行部分の関数科
     * 
     * @param string $curl
     * @param string $parameter
     * @return string
     */
    public function execCurlProcess($curl, $parameter){
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $parameter);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 証明書の検証を行わない
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // curl_execの結果を文字列で返す
        return curl_exec($curl);;
    }

    /**
     * 特定のボードのboardIdの取得
     * 取得できない場合はfalseを返す。
     * 
     * @return string|bool
     */
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

    /**
     * 特定のリストのlistIdの取得
     * 取得できない場合はfalseを返す。
     * 
     * @param string $boardId
     * @param string $dayOfTheWeek
     * @return string|bool
     */
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

    /**
     * 特定のリスト内の全カード情報の取得
     * 取得できない場合はfalseを返す。
     * 
     * @param string $listId
     * @return array|bool
     */
    public function getCardsInfoByListId($listId){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->baseUrl. '/lists/' . $listId . '/cards?key=' . $this->key . '&token=' . $this->token);
        $response = $this->execCurlProcess($curl, 'GET');
        curl_close($curl);
        return json_decode($response, true);
    }

    /**
     * 特定のリスト内の全カードへのラベリング実行
     * 
     * @param array $cardInfo
     * @param string $color
     */
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