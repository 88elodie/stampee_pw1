<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/main.css">
    <title>Inscription</title>
</head>
<body>
    <nav>
        <a href="{{path}}" class="logo"><span class="square"></span>stampee</a>
        <div class="liens-nav">
            <a href="#" class="nav-item">fonctionnement</a>
            <div class="menu-deroulant">
                <a href="{{path}}/auction/catalogue" class="nav-item nav-item-deroulant">enchères</a>
                <div class="liens-nav-deroulant">
                    <a href="#">actives</a>
                    <a href="#">choix du lord</a>
                    <a href="#">en vedette</a>
                    <a href="#">passées</a>
                </div>
            </div>
            <a href="#" class="nav-item">actualités</a>
            <a href="{{path}}/user/login" class="nav-item">se connecter</a>
        </div>
    </nav>
    <hr class="nav-line">
    <main>
        <h1>Nouvel utilisateur</h1>
        {% if errors is defined %}
        <span class="error">{{ errors|raw }}</span>
        {% endif %}
        <form action="{{path}}/user/store" method="post">
            <label> Adresse courriel<br>
            <input type="email" name="email" value="{{ user.email }}">
            </label><br>
            <label> Nom d'utilisateur (ce nom sera affiché lorsque vous faites des mises)<br>
            <input type="text" name="username" value="{{ user.username }}">
            </label><br>
            <label> Mot de passe<br>
            <input type="password" name="password" value="{{ user.user_password }}">
            </label><br>
            <input type="submit" value="Compléter mon inscrption">
        </form>
    </main>
</body>
</html>