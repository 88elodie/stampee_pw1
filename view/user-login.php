<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/main.css">
    <title>Connexion</title>
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
        <h1>Connecter</h1>
        {% if errors is defined %}
        <span class="error">{{ errors|raw }}</span>
        {% endif %}
        <form action="{{path}}/login/authentication" method="post">
            <label> Username
            <input type="text" name="username" value="{{ user.username }}">
            </label>
            <label> Password
            <input type="password" name="password" value="{{ user.password }}">
            </label>
            <input type="submit" value="Se connecter">
        </form>
        <p>Pas de compte ? <a href="{{path}}/user/register">Inscrivez-vous aujourd'hui ⟶</a></p>
    </main>
</body>
</html>