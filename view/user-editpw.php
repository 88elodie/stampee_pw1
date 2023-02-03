<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="https://use.typekit.net/isw1drf.css">
    <!-- alize : regular, demi, bold -->
    <!-- ff-basic-gothic-pro : 300-400-500-600-700 -->
    <!-- urw-antiqua : 400-500-600-700 -->
    <title>Mon profil</title>
</head>
<body>
    <nav>
        <a href="{{path}}" class="logo"><span class="square"></span>stampee</a>
        <div class="liens-nav">
            <a href="#" class="nav-item">fonctionnement</a>
            <div class="menu-deroulant">
                <a href="{{path}}/auction/catalogue?status=all" class="nav-item nav-item-deroulant">enchères</a>
                <div class="liens-nav-deroulant">
                    <a href="{{path}}/auction/catalogue?status=active">actives</a>
                    <a href="#">choix du lord</a>
                    <a href="#">en vedette</a>
                    <a href="{{path}}/auction/catalogue?status=upcoming">futures</a>
                    <a href="{{path}}/auction/catalogue?status=expired">passées</a>
                </div>
            </div>
            <a href="#" class="nav-item">actualités</a>
            <a href="{{path}}/user/profile" class="nav-item">mon profil</a>
            <a href="{{path}}/user/logout" class="nav-item">se déconnecter</a>
        </div>
    </nav>
    <hr class="nav-line">
    <main>
        {% if errors is defined %}
        <span class="error">{{ errors|raw }}</span>
        {% endif %}
        <form action="updatepw" method="post">
        <input type="hidden" name="user_id" value="{{ user.user_id }}">
            <label for="password">Mot de passe actuel</label>
            <input type="text" name="password" id="password">
            <label for="new-password">Nouveau mot de passe</label>
            <input type="text" name="new-password" id="new-password">
            <input type="submit" value="Changer mon mot de passe">
        </form>
    </main>
</body>
</html>