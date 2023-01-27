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
    <title>Enchères</title>
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
    <main class="catalogue-container">
        <span class="breadcrumbs">accueil > enchères</span>
        <span class="favoris"> mes favoris </span>

        <h2>Enchères</h2>
        <article>
            <aside class="filtres">
                <div class="menu-filtres">
                    <h4>Filtres</h4>
                    <div class="filtre">
                        <h5>Années</h5>
                        <div class="filtre-items">
                            <p>1700-1799</p>
                            <p>1800-1899</p>
                            <p>1900-1999</p>
                            <p>2000-2023</p>
                        </div>
                    </div>
                    <div class="filtre">
                        <h5>Pays</h5>
                        <div class="filtre-items">
                            <p>Canada</p>
                            <p>États-Unis</p>
                            <p>Australie</p>
                            <p>Angleterre</p>
                        </div>
                    </div>
                    <div class="filtre">
                        <h5>Couleur</h5>
                        <div class="filtre-items">
                            <p>Rouge</p>
                            <p>Bleu</p>
                            <p></p>
                            <p></p>
                        </div>
                    </div>
                    <div class="filtre">
                        <h5>Condition</h5>
                        <div class="filtre-items">
                            <p>condition 1</p>
                            <p>condition 2</p>
                            <p>condition 3</p>
                            <p>condition 4</p>
                        </div>
                    </div>
                </div>
            </aside>
            <section class="encheres">
                {% for auction in auctions %}
                <div>
                    <img src="../../media/stamp1.jpg" alt="">
                    <p>
                        {{ auction.title }}
                    </p>
                    <span>Début : {{ auction.start_date }}</span>
                    <span>Fin : {{ auction.end_date }}</span>
                    <span>Prix plancher : {{ auction.floor_price }} $</span>
                    <div>
                        <a href="{{path}}/auction/fiche?auction_id={{auction.auction_id}}">Consulter >></a>
                        <span><svg version="1.1" class="heart" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 471.701 471.701" style="enable-background:new 0 0 471.701 471.701;
                                    height: 25px;" xml:space="preserve">
                       <g>
                           <path d="M433.601,67.001c-24.7-24.7-57.4-38.2-92.3-38.2s-67.7,13.6-92.4,38.3l-12.9,12.9l-13.1-13.1
                               c-24.7-24.7-57.6-38.4-92.5-38.4c-34.8,0-67.6,13.6-92.2,38.2c-24.7,24.7-38.3,57.5-38.2,92.4c0,34.9,13.7,67.6,38.4,92.3
                               l187.8,187.8c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-3.9l188.2-187.5c24.7-24.7,38.3-57.5,38.3-92.4
                               C471.801,124.501,458.301,91.701,433.601,67.001z M414.401,232.701l-178.7,178l-178.3-178.3c-19.6-19.6-30.4-45.6-30.4-73.3
                               s10.7-53.7,30.3-73.2c19.5-19.5,45.5-30.3,73.1-30.3c27.7,0,53.8,10.8,73.4,30.4l22.6,22.6c5.3,5.3,13.8,5.3,19.1,0l22.4-22.4
                               c19.6-19.6,45.7-30.4,73.3-30.4c27.6,0,53.6,10.8,73.2,30.3c19.6,19.6,30.3,45.6,30.3,73.3
                               C444.801,187.101,434.001,213.101,414.401,232.701z"/>
                       </g>
                       </svg></span>
                    </div>
                </div>
                {% endfor %}
            </section>
        </article>
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