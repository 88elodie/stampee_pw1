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
    <title>Connexion</title>
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
            <a href="{{path}}/user/login" class="nav-item">se connecter</a>
        </div>
    </nav>
    <hr class="nav-line">
    <main class="login-container">
        <section>
        <p>Pas de compte ?<a href="{{path}}/user/register">Inscrivez-vous aujourd'hui ⟶</a></p>
        </section>
        <section>
        <h1>Connexion</h1>
        {% if errors is defined %}
        <span class="error">{{ errors|raw }}</span>
        {% endif %}
        <form action="{{path}}/login/authentication" method="post">
            <label> Nom d'utilisateur<br>
            <input type="text" name="username" value="{{ user.username }}"><br>
            </label>
            <label> Mot de passe<br>
            <input type="password" name="password" value="{{ user.password }}"><br>
            </label>
            <input type="submit" value="Se connecter">
        </form>
        </section>
    </main>
</body>
</html>