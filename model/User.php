<?php

class ModelUser extends Crud {

    protected $table = 'user';
    protected $primaryKey = 'user_id';

    protected $fillable = ['user_id', 'username', 'email', 'password'];

    public function checkUser($username, $password){
        $sql = "SELECT * FROM $this->table WHERE username = ?";
        $stmt = $this->prepare($sql);
        $stmt->execute(array($username));
        $count = $stmt->rowCount();
        if($count == 1){
            $user_info = $stmt->fetch();
            if(password_verify($password, $user_info['password'])){
                    
                session_regenerate_id();
                $_SESSION['user_id'] = $user_info['user_id'];
                $_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);
                // $tzo = new DateTimeZone('America/New_York');
                // $date = new DateTime;
                // $date->setTimezone($tzo);
                // $_SESSION['login_time'] = date_format($date, 'Y-m-d H:i:s');
                
                requirePage::redirectPage('../..');
                
            }else{
               return "<ul><li>Verifier le mot de passe</li></ul>";  
            }
        }else{
            return "<ul><li>Le nom d'utilisateur n'existe pas</li></ul>";
        }
    }
    
    public function checkPassword($id, $password){
        $sql = "SELECT * FROM $this->table WHERE user_id = ?";
        $stmt = $this->prepare($sql);
        $stmt->execute(array($id));
        $user_info = $stmt->fetch();
        if(password_verify($password, $user_info['password'])){
            return TRUE;
                
        }else{
            return FALSE;  
        }
        
    }

    public function checkUserExist($username){
        $sql = "SELECT * FROM $this->table WHERE username = ?";
        $stmt = $this->prepare($sql);
        $stmt->execute(array($username));
        $count = $stmt->rowCount();
        if($count == 1){
            return false;
        }else {
            return true;
        }
    }

    public function checkEmailExist($email){
        $sql = "SELECT * FROM $this->table WHERE email = ?";
        $stmt = $this->prepare($sql);
        $stmt->execute(array($email));
        $count = $stmt->rowCount();
        if($count == 1){
            return false;
        }else {
            return true;
        }
    }
}