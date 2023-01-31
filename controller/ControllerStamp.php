<?php
RequirePage::requireModel('CRUD');
RequirePage::requireModel('User');
RequirePage::requireModel('Stamp');
RequirePage::requireModel('Colors');
RequirePage::requireModel('Condition');
RequirePage::requireLibrary('Validation');
RequirePage::requireLibrary('CheckSession');

class ControllerStamp {

    public function create(){
        CheckSession::SessionAuth();
        $user = new ModelUser;
        $color = new ModelColors;
        $condition = new ModelCondition;

        $user_info = $user->select();
        $user_info = $user_info[0];
        $colors = $color->select();
        $conditions = $condition->select();

        return Twig::render('stamp-create.php', ['user' => $user_info, 'colors' => $colors, 'conditions' => $conditions]);
    }

    public function store(){
        CheckSession::SessionAuth();
        $validation = new Validation;
        extract($_POST);
        $title = $_POST['title'];
        $description = $_POST['description'];
        $country = $_POST['origin_country'];
        $condition = $_POST['condition_quality'];
        $print_num = $_POST['print_num'];
        $dimensions = $_POST['dimensions'];
        $color = $_POST['color'];

        $validation->name('title')->value($title)->pattern('text')->required()->max(100);
        $validation->name('description')->value($description)->pattern('text')->required();
        $validation->name('country')->value($country)->required();
        $validation->name('condition')->value($condition)->required();
        $validation->name('print_num')->value($print_num)->pattern('int');
        $validation->name('dimensions')->value($dimensions)->pattern('text')->required();
        $validation->name('color')->value($color)->required();

        $user = new ModelUser;
        $color = new ModelColors;
        $condition = new ModelCondition;

        $user_info = $user->select();
        $colors = $color->select();
        $conditions = $condition->select();

        if($validation->isSuccess()){
            $stamp = new ModelStamp;
            $stamp->insert($_POST);
            requirePage::redirectPage('../user/profile');
            
        }else{
            $errors = $validation->displayErrors();
            twig::render('stamp-create.php', ['errors' => $errors, 'stamp' => $_POST, 'user' => $user_info[0], 'colors' => $colors, 'conditions' => $conditions]);
        }
    }

    public function edit(){
        CheckSession::SessionAuth();
        $stamp = new ModelStamp;
        $color = new ModelColors;
        $condition = new ModelCondition;

        $select = $stamp->select();
        $colors = $color->select();
        $conditions = $condition->select();

        twig::render('stamp-edit.php', ['stamp' => $select[0], 'colors' => $colors, 'conditions' => $conditions]);
    }

    public function update(){
        CheckSession::SessionAuth();
        $validation = new Validation;
        extract($_POST);
        $title = $_POST['title'];
        $description = $_POST['description'];
        $country = $_POST['origin_country'];
        $condition = $_POST['condition_quality'];
        $print_num = $_POST['print_num'];
        $dimensions = $_POST['dimensions'];
        $color = $_POST['color'];

        $validation->name('title')->value($title)->pattern('text')->required()->max(100);
        $validation->name('description')->value($description)->pattern('text')->required();
        $validation->name('country')->value($country)->required();
        $validation->name('condition')->value($condition)->required();
        $validation->name('print_num')->value($print_num)->pattern('int');
        $validation->name('dimensions')->value($dimensions)->pattern('text')->required();
        $validation->name('color')->value($color)->required();

        $user = new ModelUser;
        $color = new ModelColors;
        $condition = new ModelCondition;

        $user_info = $user->select();
        $colors = $color->select();
        $conditions = $condition->select();

        if($validation->isSuccess()){
            $stamp = new ModelStamp;
            $stamp->update($_POST);
            requirePage::redirectPage('../user/profile');
            
        }else{
            $errors = $validation->displayErrors();
            twig::render('stamp-edit.php', ['errors' => $errors, 'stamp' => $_POST, 'user' => $user_info[0], 'colors' => $colors, 'conditions' => $conditions]);
        }
    }

    public function delete(){
        CheckSession::SessionAuth();
        $data = $_POST;
        $stamp = new ModelStamp;
        $stamp->delete($data);
        RequirePage::redirectPage('../user/profile');
    }
}