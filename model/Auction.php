<?php
RequirePage::requireLibrary('CheckMatch');

class ModelAuction extends Crud {

    protected $table = 'auction';
    protected $primaryKey = 'auction_id';

    public function filter($filter, $value, $status){
        $auctions = unserialize(file_get_contents('data/'.$status.'.bin'));
        $result = [];
        foreach($auctions as $auction){
            if($auction[$filter] == $value){
                array_push($result, $auction);
            }
        }
        return $result;
    }

    public function sort($sort, $order, $status){
        $auctions = unserialize(file_get_contents('data/'.$status.'.bin'));
        
        if($sort == 'end_date' && $order == 'asc'){
            usort($auctions, function($a, $b) {
                $ad = new DateTime($a['end_date']);
                $bd = new DateTime($b['end_date']);
                
                if ($ad == $bd) {
                    return 0;
                }
                return $ad < $bd ? -1 : 1;
            });
        }else if($sort == 'end_date' && $order == 'desc'){
            usort($auctions, function($a, $b) {
                $ad = new DateTime($a['end_date']);
                $bd = new DateTime($b['end_date']);
                
                if ($ad == $bd) {
                    return 0;
                }
                return $ad < $bd ? 1 : -1;
            });
        }else if($sort == 'floor_price' && $order == 'asc'){
            usort($auctions, fn($a, $b) => $a['floor_price'] <=> $b['floor_price']);
        }else if($sort == 'floor_price' && $order == 'desc'){
            usort($auctions, fn($a, $b) => $b['floor_price'] <=> $a['floor_price']);
        }

        return $auctions;
        
    }

    public function search($search, $status){
        $auctions = unserialize(file_get_contents('data/'.$status.'.bin'));
        $search_words = explode(" ", $search);
        $result = [];
        $match = false;
        foreach($auctions as $auction){
            $data = $auction['title']." ".$auction['description'];
            if(CheckMatch::str_contains_all($data, $search_words)){
                array_push($result, $auction);
            }
        }
        return $result;
    }

    public function getAuctions($status){
        $auctions = unserialize(file_get_contents('data/'.$status.'.bin'));
        return $auctions;
    }

}