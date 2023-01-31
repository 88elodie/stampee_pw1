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
    <title>Fiche</title>
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
            {% if session == 0 %}
            <a href="{{path}}/user/login" class="nav-item">se connecter</a>
            {% endif %}
            {% if session == 1 %}
            <a href="{{path}}/user/profile" class="nav-item">mon profil</a>
            <a href="{{path}}/user/logout" class="nav-item">se déconnecter</a>
            {% endif %}
        </div>
    </nav>
    <hr class="nav-line">
    <main class="fiche-container">
        <span class="breadcrumbs">accueil > enchères > enchères actives > Lot 21 - 166 “9...</span>
        <span class="favoris"> mes favoris </span>

        <section class="photo-infos">
            <div class="photo">
                <figure class="main-photo">
                    <img src="../../media/stamp1.jpg" alt="timbre">
                    <div class="nav-gauche">&lt;</div>
                    <div class="nav-droite">&gt;</div>
                    <div class="loupe"><div class="loupe-icone"></div></div>
                </figure>
                <figure class="photos-min">
                    <div></div><div></div><div></div><div></div>
                </figure>
            </div>
            <div class="infos">
                <h2>{{ auction.title }}</h2>
                <span>Vendeu(r)(euse) : {{ auction.username }}</span>
                <div>
                <span>Début : {{ auction.start_date }}</span><br>
                <span>Fin : {{ auction.end_date }}</span><br>
                <span>Prix plancher : {{ auction.floor_price }} $</span>
                <p>Enchère actuelle : 
                    {% if auction.has_bid == 0 %}
                        Aucune
                    {% endif %}
                    {% if auction.has_bid == 1 %}
                        {{ bid[0].bid_amount }} $ par {{ bid[0].username }}
                    {% endif %}
                </p>
                <form action="{{path}}/auction/bid?auction_id={{ auction.auction_id }}" method="post">
                <input type="hidden" name="bidder_id" value="{{ user.user_id }}">
                <input type="hidden" name="auction_bid_id" value="{{ auction.auction_id }}">
                <input type="number" name="bid_amount" id="bid_amount">
                <input type="submit" value="Miser">
                </form>
                {% if errors is defined %}
                <span class="error">{{ errors|raw }}</span>
                {% endif %}
                </div>
            </div>
        </section>
        <section class="description">
            <h4>Description ⟶</h4>
            <p>{{ auction.description }}</p>
        </section>
        <section class="details">
            <div>
                <h4>Condition</h4>
                <p>{{ auction.condition_name }}</p>
            </div>
            <div>
                <h4>Couleur</h4>
                <p>{{ auction.color_name }}</p>
            </div>
            <div>
                <h4>Pays d'origine</h4>
                <p>{{ auction.origin_country }}</p>
            </div>
            <div>
                <h4>Dimensions</h4>
                <p>{{ auction.dimensions }}</p>
            </div>
            <div>
                <h4>Tirage</h4>
                <p>{{ auction.print_num }}</p>
            </div>
        </section>
    </main>
    <hr class="footer-line">
    <footer>
        <section>
            <h6>Mon compte</h6>
            <ul>
                <li>Devenir Membre</li>
                <li>Se connecter</li>
                <li>Termes et conditions</li>
            </ul>
        </section>
        <section>
            <h6>À propos du Lord Reginald Stampee III</h6>
            <ul>
                <li>La philatélie, c’est la vie</li>
                <li>Biographie du Lord</li>
                <li>Historique Familial</li>
            </ul>
        </section>
        <section>
            <div class="logo">
            <a href="index.html" class="logo"><span class="square"></span>stampee</a>
            </div>
        </section>
        <section>
            <h6>Liens Utiles</h6>
            <ul>
                <li>Actualités</li>
                <li>Fonctionnement de la plateforme</li>
                <li>Contacter le webmestre</li>
            </ul>
        </section>
        <section>
            <h6>Contactez-nous</h6>
            <ul>
                <li>Angleterre</li>
                <li>Canada</li>
                <li>États-unis</li>
                <li>Australie</li>
            </ul>
        </section>
    </footer>
</body>
</html>