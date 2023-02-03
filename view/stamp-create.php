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
        <form action="{{path}}/stamp/store" method="post">
        <input type="hidden" name="creator_id" value="{{ user.user_id }}">
            <label for="title">Titre (utilisé également comme titre de votre enchère) *</label><br>
            <input type="text" name="title" id="title" value="{{ stamp.title }}"><br>
            <label for="description">Description du timbre *</label><br>
            <textarea name="description" id="description" cols="30" rows="10">{{ stamp.description }}</textarea><br>
            <label for="country">Pays d'origine *</label>
            <select name="origin_country" id="country">
                <option value="canada">Canada</option>
                <option value="usa">États-unis</option>
                <option value="mexico">Mexique</option>
            </select><br>
            <label for="condition_quality">Condition du timbre *</label>
            <select name="condition_quality" id="condition_quality">
                {% for condition in conditions %}
                <option value="{{ condition.condition_quality_id }}">{{ condition.condition_name }}</option>
                {% endfor %}
            </select><br>
            <label for="certificate">Le timbre a-t-il un certificat?</label>
            <input type="checkbox" name="certificate" id="certificate" value='1'> Oui<br>
            <label for="print_num">Numéro d'impression</label>
            <input type="text" name="print_num" id="print_num" value="{{ stamp.print_num }}"><br>
            <label for="dimensions">Dimensions du timbre *</label>
            <input type="text" name="dimensions" id="dimensions" value="{{ stamp.dimensions}}"><br>
            <label for="color">Couleur principale *</label>
            <select name="color" id="color">
                {% for color in colors %}
                <option value="{{ color.color_id }}">{{ color.color_name }}</option>
                {% endfor %}
            </select><br>
            
            <input type="submit" value="Ajouter mon timbre">
        </form>
    </main>
</body>
</html>