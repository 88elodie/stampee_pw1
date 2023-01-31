<?php
RequirePage::requireModel('CRUD');
RequirePage::requireModel('User');
RequirePage::requireModel('Stamp');
RequirePage::requireModel('Auction');
RequirePage::requireModel('Bid');
RequirePage::requireLibrary('Validation');
RequirePage::requireLibrary('CheckSession');

class ControllerAuction {
    public function catalogue(){
        if(CheckSession::SessionConnected()){
            $session = 1;
        }else {
            $session = 0;
        }
        $auction = new ModelAuction;
        $auctions = $auction->select();

        return Twig::render('auction-catalogue.php', ['session' => $session, 'auctions' => $auctions]);
    }

    public function fiche(){
        include('cron/auction_manage.php');
        if(CheckSession::SessionConnected()){
            $session = 1;
        }else {
            $session = 0;
        }
        $auction = new ModelAuction;
        $bid = new ModelBid;

        $select = $auction->select();
        $bid_info = $bid->select();

        if(isset($_SESSION['user_id'])){
            $user = new ModelUser;
            $user_info = $user->select();
            $user_info = $user_info[0];
        }else {
            $user_info = 0;
        }

        return Twig::render('auction-fiche.php', ['session' => $session, 'auction' => $select[0], 'user' => $user_info, 'bid' => $bid_info]);
    }

    public function create(){
        CheckSession::SessionAuth();
        $user = new ModelUser;
        $stamp = new ModelStamp;

        $user_info = $user->select();
        $select = $stamp->select();
        $date = new DateTime('now', new DateTimeZone('America/New_York'));
        $date = $date->format('Y-m-d\TH:i');

        return Twig::render('auction-create.php', ['user' => $user_info[0], 'stamp' => $select[0], 'date' => $date]);
    }

    public function store(){
        CheckSession::SessionAuth();
        $validation = new Validation;
        extract($_POST);
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $floor_price = $_POST['floor_price'];

        $validation->name('start_date')->value($start_date)->required();
        $validation->name('end_date')->value($end_date)->required();
        $validation->name('floor_price')->value($floor_price)->pattern('int')->required();

        $user = new ModelUser;
        $stamp = new ModelStamp;

        $user_info = $user->select();
        $select = $stamp->select();
        $date = new DateTime('now', new DateTimeZone('America/New_York'));
        $date = $date->format('Y-m-d\TH:i');
        //format date pour calculer difference en heures
        $date1 = new DateTime($start_date);
        $date2 = new DateTime($end_date);

        $diff = $date2->diff($date1);

        $hours = $diff->h;
        $hours = $hours + ($diff->days*24);
        // ----
        if($start_date <= $date){
            $errors = "<p>La date et le temps de début doivent être plus récent que la date et le temps actuel</p>";
            twig::render('auction-create.php', ['errors' => $errors, 'auction' => $_POST, 'user' => $user_info[0], 'stamp' => $select[0], 'date' => $date]);
        }else if($hours < 24){
            $errors = "<p>La durée de l'enchère doit être de 24h minimum</p>";
            twig::render('auction-create.php', ['errors' => $errors, 'auction' => $_POST, 'user' => $user_info[0], 'stamp' => $select[0], 'date' => $date]);
        }else if($validation->isSuccess()){
            $auction = new ModelAuction;
            $stamp = new ModelStamp;

            $info = [
                'stamp_id' => $_POST['stamp_id'],
                'is_auction' => 1
            ];

            $stamp->update($info);
            $auction->insert($_POST);
            requirePage::redirectPage('../user/profile');
            
        }else{
            $errors = $validation->displayErrors();
            twig::render('auction-create.php', ['errors' => $errors, 'auction' => $_POST, 'user' => $user_info[0], 'stamp' => $select[0], 'date' => $date]);
        }
    }

    public function delete(){
        CheckSession::SessionAuth();
        $data = ['auction_id' => $_POST['auction_id']];
        $auction = new ModelAuction;
        $stamp = new ModelStamp;
        $auction->delete($data);

        $info = [
            'stamp_id' => $_POST['stamp_id'],
            'is_auction' => '0'
        ];


        $stamp->update($info);
        RequirePage::redirectPage('../user/profile');
    }

    public function bid() {
        CheckSession::SessionAuth();
        if(CheckSession::SessionConnected()){
            $session = 1;
        }else {
            $session = 0;
        }
        $validation = new Validation;
        extract($_POST);
        $bid_amount = $_POST['bid_amount'];

        $validation->name('bid_amount')->value($bid_amount)->required();
        
        $user = new ModelUser;
        $auction = new ModelAuction;
        $bid = new ModelBid;

        $user_info = $user->select();
        $select = $auction->select();
        $bid_info = $bid->select();

        if($_SESSION['user_id'] == $select[0]['seller_id']){
            $errors = "<p>Vous ne pouvez pas miser sur votre propre enchère</p>";
            twig::render('auction-fiche.php', ['errors' => $errors, 'auction' => $select[0], 'user' => $user_info[0], 'session' => $session, 'bid' => $bid_info]);
        }else if($_POST['bidder_id'] == $bid_info[0]['bidder_id']){
            $errors = "<p>Vous avez déjà misé sur cette enchère.</p>";
            twig::render('auction-fiche.php', ['errors' => $errors, 'auction' => $select[0], 'user' => $user_info[0], 'session' => $session, 'bid' => $bid_info]);
        }else if($select[0]['has_bid'] && $_POST['bid_amount'] <= $bid_info[0]['bid_amount']){
            $errors = "<p>Vous devez entrer une mise plus haute que la mise actuelle</p>";
        }else if($validation->isSuccess()){
            $auction = new ModelAuction;
            $bid = new ModelBid;

            $bid->insert($_POST);
            if(!$select[0]['has_bid']){
                $info = [
                    'auction_id' => $_POST['auction_bid_id'],
                    'has_bid' => 1
                ];
                $auction->update($info);
            }
            
            requirePage::redirectPage('../auction/fiche?auction_id='.$_POST['auction_bid_id']);
            
        }else{
            $errors = $validation->displayErrors();
            twig::render('auction-fiche.php', ['errors' => $errors, 'auction' => $select[0], 'user' => $user_info[0], 'session' => $session, 'bid' => $bid_info]);
        }

    }
}