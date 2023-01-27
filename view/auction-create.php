<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/main.css">
    <title>Mon profil</title>
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
            <a href="{{path}}/user/profile" class="nav-item">mon profil</a>
            <a href="{{path}}/user/logout" class="nav-item">se déconnecter</a>
        </div>
    </nav>
    <hr class="nav-line">
    <main>
        {% if errors is defined %}
        <span class="error">{{ errors|raw }}</span>
        {% endif %}
        <form action="{{path}}/auction/store" method="post">
        <input type="hidden" name="seller_id" value="{{ user.user_id }}">
        <input type="hidden" name="stamp_id" value="{{ stamp.stamp_id }}">
            <h3>Création d'enchère</h3>
            <p>Pour le timbre : {{ stamp.title }}</p>
            <label for="start_date">Date de début</label>
            <input type="datetime-local" name="start_date" id="start_date" value="{{ auction.start_date }}" min="{{ date }}"><br>
            <label for="end_date">Date de fin</label>
            <input type="datetime-local" name="end_date" id="end-date" value="{{ auction.end_date }}" min="{{ date }}"><br>
            <label for="floor_price">Prix plancher</label>
            <input type="number" name="floor_price" id="floor_price" value="{{ auction.floor_price}}"><br>
            
            <p>* Lorsque votre enchère est publiée, il n'est plus possible de la modifier; il faudra la supprimer et en créer une nouvelle.</p>
            <p>* Lorsque vous recevez votre première mise, il n'est également plus possible de supprimer votre enchère, à moins de contacter un administrateur.</p>
            <input type="submit" value="Publier mon enchère">
        </form>
    </main>
</body>
</html>