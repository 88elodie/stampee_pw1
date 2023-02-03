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
            <label for="main_image">Lien image principale *</label>
            <input type="text" name="main_image" id="main_image"><br>
            <p><a href="https://imgur.com/upload" target="_blank">Héberger mon image sur imgur >></a></p>
            <p>optionel :</p>
            <label for="image2">Lien image 2</label>
            <input type="text" name="image2" id="image2"><br>
            <label for="image3">Lien image 3</label>
            <input type="text" name="image3" id="image3"><br>
            <label for="image4">Lien image 4</label>
            <input type="text" name="image4" id="image4"><br>
            
            <p>* Lorsque votre enchère est publiée, il n'est plus possible de la modifier; il faudra la supprimer et en créer une nouvelle.</p>
            <p>* Lorsque vous recevez votre première mise, il n'est également plus possible de supprimer votre enchère, à moins de contacter un administrateur.</p>
            <input type="submit" value="Publier mon enchère">
        </form>
    </main>
</body>
</html>