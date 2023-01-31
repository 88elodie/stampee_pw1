<?php

abstract class CRUD extends PDO{
    public function __construct(){
    parent::__construct("mysql:host=localhost;dbname=stampee;charset=utf8",
    "root", "");
    }
    public function select(){
        if ($this->table == 'user'){
            $user_id = $_SESSION['user_id'];
            $sql = "SELECT * FROM $this->table WHERE user_id = $user_id";
        }else if($this->table == 'stamp' && isset($_GET['stamp_id'])){
            $stamp_id = $_GET['stamp_id'];
            $sql = "SELECT * FROM $this->table
            LEFT OUTER JOIN colors ON $this->table.color = colors.color_id
            LEFT OUTER JOIN condition_quality ON $this->table.condition_quality = condition_quality.condition_quality_id
            WHERE stamp_id = $stamp_id";
        }else if($this->table == 'auction' && isset($_GET['auction_id'])){
            $auction_id = $_GET['auction_id'];
            $sql = "SELECT * FROM $this->table
            LEFT OUTER JOIN user ON $this->table.seller_id = user.user_id
            LEFT OUTER JOIN stamp AS `a` ON $this->table.stamp_id = a.stamp_id
            LEFT OUTER JOIN colors ON a.color = colors.color_id
            LEFT OUTER JOIN condition_quality ON a.condition_quality = condition_quality.condition_quality_id
            WHERE auction_id = $auction_id";
        }else if($this->table == 'auction'){
            $sql = "SELECT * FROM $this->table
            LEFT OUTER JOIN stamp ON $this->table.stamp_id = stamp.stamp_id";
        }else if($this->table == 'user_bid' && isset($_GET['auction_id'])){
            $auction_id = $_GET['auction_id'];
            $sql = "SELECT * FROM $this->table
            LEFT OUTER JOIN user ON $this->table.bidder_id = user.user_id
            WHERE auction_bid_id = $auction_id
            AND bid_amount = (select max(bid_amount))";
        }else {
            $sql = "SELECT * FROM $this->table";
        }
       
        $query = $this->query($sql);
        return $query->fetchAll();
    }

    public function selectFromUser(){
        $user_id = $_SESSION['user_id'];
        if ($this->table == 'stamp'){
            $sql = "SELECT * FROM $this->table
            LEFT OUTER JOIN colors ON $this->table.color = colors.color_id
            LEFT OUTER JOIN condition_quality ON $this->table.condition_quality = condition_quality.condition_quality_id
            WHERE creator_id = $user_id";
        }else if ($this->table == 'auction'){
            $sql = "SELECT * FROM $this->table
            LEFT OUTER JOIN stamp ON $this->table.stamp_id = stamp.stamp_id
            WHERE seller_id = $user_id";
        }
    
        $query = $this->query($sql);
        return $query->fetchAll();
    }

    public function checkAuctionTime($datetime, $column){
        if($column == 'start_date'){
            $sql = "SELECT * FROM $this->table
            WHERE $column >= $datetime
            AND status = 0";
        }else if($column == 'end_date'){
            $sql = "SELECT * FROM $this->table
            WHERE $column >= $datetime
            AND status = 1";
        }
        $query = $this->query($sql);
        return $query->fetchAll();
    }

    public function insert($data){
        $nomChamp = implode(", ", array_keys($data));
        $valeurChamp = ':'.implode(", :", array_keys($data));

        $sql = "INSERT INTO $this->table ($nomChamp) VALUES ($valeurChamp)";

        $stmt = $this->prepare($sql);
        foreach($data as $key=>$value){
            $stmt->bindValue(":$key", $value);
        }
        if(!$stmt->execute()){
            print_r($stmt->errorInfo());
        }
    }

    public function update($data){
        $champRequete = null;
        foreach($data as $key=>$value) {
            $champRequete .= "$key = :$key, ";
        }
        $champRequete = rtrim($champRequete, ", ");

        $sql = "UPDATE $this->table SET $champRequete WHERE $this->primaryKey = :$this->primaryKey;";
        $stmt = $this->prepare($sql);
        foreach($data as $key=>$value){
            $stmt->bindValue(":$key", $value);
        }
        if(!$stmt->execute()){
            print_r($stmt->errorInfo());
        }
    }

    public function delete($data){
        $sql = "DELETE FROM $this->table WHERE $this->primaryKey = :$this->primaryKey;";
        $stmt = $this->prepare($sql);
        foreach($data as $key=>$value){
            $stmt->bindValue(":$key", $value);
        }
        if(!$stmt->execute()){
            print_r($stmt->errorInfo());
        }
    }
}