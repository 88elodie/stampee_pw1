<?php
RequirePage::requireModel('CRUD');
RequirePage::requireModel('User');
RequirePage::requireModel('Stamp');
RequirePage::requireModel('Colors');
RequirePage::requireModel('Condition');
RequirePage::requireModel('Auction');
RequirePage::requireLibrary('Validation');
RequirePage::requireLibrary('CheckSession');

class ControllerUser{

    public function profile() {
        CheckSession::SessionAuth();
        $user = new ModelUser;
        $select = $user->select();
        $select = $select[0];
        $stamp = new ModelStamp;
        $stamps = $stamp->selectFromUser();
        $auction = new ModelAuction;
        $auctions = $auction->selectFromUser();

        twig::render('user-profile.php', ['user' => $select, 'stamps' => $stamps, 'auctions' => $auctions]);
    }

    public function register(){
        twig::render('user-register.php');
    }
    
    public function store(){
        $validation = new Validation;
        extract($_POST);
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $validation->name('email')->value($email)->pattern('email')->required()->max(254);
        $validation->name('username')->value($username)->pattern('alphanum')->required()->max(20);
        $validation->name('user_password')->value($password)->max(20)->min(6);

        if($validation->isSuccess()){
            $user = new ModelUser;
            if($user->checkUserExist($username) && $user->checkEmailExist($email)){
                $options = [
                    'cost' => 10,
                ];
                $_POST['password']= password_hash($_POST['password'], PASSWORD_BCRYPT, $options);
                $user->insert($_POST);
                requirePage::redirectPage('../user/login');
            }else if(!$user->checkUserExist($username)){
                $errors = "Ce nom d'utilisateur est déjà utilisé";
                twig::render('user-register.php', ['errors' => $errors, 'user' => $_POST]);
            }else if(!$user->checkEmailExist($email)){
                $errors = "Cette adresse courriel est déjà utilisée";
                twig::render('user-register.php', ['errors' => $errors, 'user' => $_POST]);
            }
            
        }else{
            $errors = $validation->displayErrors();
            twig::render('user-register.php', ['errors' => $errors, 'user' => $_POST]);
        }
    }

    public function edit() {
        $user = new ModelUser;
        $select = $user->select();
        $select = $select[0];
        CheckSession::SessionAuth();
        twig::render('user-edit.php', ['user' => $select]);
    }

    public function editpw() {
        $user = new ModelUser;
        $select = $user->select();
        $select = $select[0];
        CheckSession::SessionAuth();
        twig::render('user-editpw.php', ['user' => $select]);
    }

    public function update(){
        CheckSession::SessionAuth();
        $validation = new Validation;
        extract($_POST);
        $email = $_POST['email'];
        $username = $_POST['username'];
        $validation->name('email')->value($email)->pattern('email')->required()->max(254);
        $validation->name('username')->value($username)->pattern('alphanum')->required()->max(20);

        if($validation->isSuccess()){
            $user = new ModelUser;
            $user_info = $user->select();

            if(($user->checkUserExist($username) && $user->checkEmailExist($email)) || $username = $user_info[0]['username'] || $email = $user_info[0]['email']){
                $user->update($_POST);
                requirePage::redirectPage('../user/profile');
            }else if(!$user->checkUserExist($username)){
                $errors = "Ce nom d'utilisateur est déjà utilisé";
                twig::render('user-edit.php', ['errors' => $errors, 'user' => $_POST]);
            }else if(!$user->checkEmailExist($email)){
                $errors = "Cette adresse courriel est déjà utilisée";
                twig::render('user-edit.php', ['errors' => $errors, 'user' => $_POST]);
            }
        }else{
            $errors = $validation->displayErrors();
            twig::render('user-edit.php', ['errors' => $errors, 'user' => $_POST]);
        }
    }

    public function updatepw(){
        CheckSession::SessionAuth();
        $validation = new Validation;
        extract($_POST);
        $password = $_POST['password'];
        $id = $_POST['user_id'];
        $new_password = $_POST['new-password'];
        $validation->name('password')->value($password)->max(20)->min(6);

        if($validation->isSuccess()){
            $user = new ModelUser;

            if($user->checkPassword($id, $password) && ($password != $new_password)){
                $options = [
                    'cost' => 10,
                ];
                $new_password = password_hash($new_password, PASSWORD_BCRYPT, $options);
                $data = [
                    'user_id' => $id,
                    'password' => $new_password
                ];
                $user->update($data);
                requirePage::redirectPage('../user/profile');
            }else if(!$user->checkPassword($id, $password)){
                $errors = "Vérifier le mot de passe";
                twig::render('user-editpw.php', ['errors' => $errors, 'user' => $_POST]);
            }else if($password == $new_password){
                $errors = "Veuillez choisir un nouveau mot de passe différent de l'actuel";
                twig::render('user-editpw.php', ['errors' => $errors, 'user' => $_POST]);
            }

        }else{
            $errors = $validation->displayErrors();
            twig::render('user-editpw.php', ['errors' => $errors, 'user' => $_POST]);
        }
    }

    public function login(){
        twig::render('user-login.php');
    }

    public function logout(){
        session_destroy();
        requirePage::redirectPage('../..');
    }

    public function delete(){
        CheckSession::SessionAuth();
        $data = $_POST;
        $user = new ModelUser;
        session_destroy();
        $user->delete($data);
        RequirePage::redirectPage('../..');
    }
}




?>