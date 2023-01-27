<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{path}}/../css/main.css">
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
    <main class="profile-container">
        <h3>Mon profil</h3>
        <section class='account-info'>
            <h4>Gérer mon compte</h4>
            <h5>{{ user.username }}</h5>
            <p>mon courriel : {{ user.email }}</p>
            <a href="{{path}}/user/edit">modifier mes informations</a>
            <a href="{{path}}/user/editpw">modifier mon mot de passe</a>
            <form action="delete" method="post">
            <input type="hidden" name="user_id" value="{{ user.user_id }}">
            <input type="submit" value="supprimer mon compte">
            </form>
        </section>
        <section>
            <h4>mes timbres</h4>
            <a href="{{path}}/stamp/create">Ajouter un timbre</a>
            <div class="user-stamps-container">
                {% for stamp in stamps %}
                <div>
                <p>{{ stamp.title }}</p>
                <p>{{ stamp.color_name }}</p>
                <p>{{ stamp.condition_name }}</p>

                {% if stamp.is_auction == 0 %}
                <a href="{{path}}/auction/create?stamp_id={{ stamp.stamp_id }}">Mettre en enchère</a><br>
                <a href="{{path}}/stamp/edit?stamp_id={{ stamp.stamp_id }}">Modifier timbre</a>
                <form action="{{path}}/stamp/delete" method="post">
                <input type="hidden" name="stamp_id" value="{{ stamp.stamp_id }}">
                <input type="submit" value="supprimer ce timbre">
                </form>
                {% endif %}
                
                {% if stamp.is_auction %}
                <p><b>Ce timbre est en enchère.</b></p>
                {% endif %}
                
                </div>
                {% endfor %}
            </div>
            <h4>mes enchères</h4>
            <div class="user-stamps-container">
                {% for auction in auctions %}
                <div>
                <p>{{ auction.title }}</p>
                <p>Début : {{ auction.start_date }}</p>
                <p>Fin : {{ auction.end_date }}</p>
                <p>Prix Plancher : {{ auction.floor_price }} $</p>
                <p>Mise du moment : </p>

                <a href="{{path}}/auction/fiche?auction_id={{ auction.auction_id }}">Consulter l'enchère ⟶</a>
                <form action="{{path}}/auction/delete" method="post">
                <input type="hidden" name="auction_id" value="{{ auction.auction_id }}">
                <input type="hidden" name="stamp_id" value="{{ auction.stamp_id }}">
                <input type="submit" value="supprimer cette enchère">
                </form>
                </div>
                {% endfor %}
            </div>

        </section>
    </main>
</body>
</html>