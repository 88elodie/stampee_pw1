<?php
RequirePage::requireModel('CRUD');
RequirePage::requireModel('Auction');

$datetime = new DateTime('now', new DateTimeZone('America/New_York'));
$datetime = $datetime->format('Y-m-d H:i');

$auction = new ModelAuction;
$auctions = $auction->checkAuctionTime($date, 'start_date');

if($auctions){
foreach($auctions[0] as $auction){
    $data = [
        'auction_id' => $auction['auction_id'],
        'status' => 1
    ];
    $auction->update($data);
}
}

$auctions = $auction->checkAuctionTime($date, 'end_date');

if($auctions){
foreach($auctions[0] as $auction){
    $data = [
        'auction_id' => $auction['auction_id'],
        'status' => 2
    ];
    $auction->update($data);
}
}
