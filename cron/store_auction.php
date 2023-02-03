<?php
RequirePage::requireModel('CRUD');
RequirePage::requireModel('Auction');

$auction = new ModelAuction;
$auctions = $auction->getAuctionsData();

file_put_contents('data/all.bin', serialize($auctions));

$active = [];
$upcoming = [];
$expired = [];

foreach($auctions as $auction){
    if($auction['status'] == 0){
        array_push($upcoming, $auction);
    }else if($auction['status'] == 1){
        array_push($active, $auction);
    }else if($auction['status'] == 2){
        array_push($expired, $auction);
    }
}

file_put_contents('data/active.bin', serialize($active));
file_put_contents('data/upcoming.bin', serialize($upcoming));
file_put_contents('data/expired.bin', serialize($expired));


