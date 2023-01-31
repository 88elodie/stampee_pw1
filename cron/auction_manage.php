<?php
RequirePage::requireModel('CRUD');
RequirePage::requireModel('Auction');

$datetime = new DateTime('now', new DateTimeZone('America/New_York'));
$datetime = $datetime->format('Y-m-d H:i:s');

$auction = new ModelAuction;
$auctions = $auction->checkAuctionTime($datetime, 'start_date');

if($auctions){
foreach($auctions as $auction){
    $data = [
        'auction_id' => $auction['auction_id'],
        'status' => 1
    ];
    $auctionModel = new ModelAuction;
    $auctionModel->update($data);
}
}

$auctions = $auction->checkAuctionTime($datetime, 'end_date');
print_r($auctions);

if($auctions){
foreach($auctions as $auction){
    $data = [
        'auction_id' => $auction['auction_id'],
        'status' => 2
    ];
    $auctionModel = new ModelAuction;
    $auctionModel->update($data);
}
}
