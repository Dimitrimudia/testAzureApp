<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Landing Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .hero {
            padding: 100px 20px;
            text-align: center;
            background: url('https://via.placeholder.com/1200x400') no-repeat center center;
            background-size: cover;
            color: white;
        }
        .hero h1 {
            font-size: 50px;
        }
        .hero p {
            font-size: 20px;
        }
        .cta-button {
            background-color: #ff6600;
            padding: 15px 30px;
            color: white;
            text-decoration: none;
            font-size: 18px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
        }
        .features {
            display: flex;
            justify-content: space-around;
            padding: 50px 20px;
            background-color: white;
        }
        .feature {
            width: 30%;
            text-align: center;
        }
        .feature h3 {
            margin-bottom: 15px;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 15px;
        }
    </style>
</head>
<body>

<header>
    <h1>Bienvenue sur Ma Landing Page</h1>
</header>

<section class="hero">
    <h1>Découvrez Notre Solution</h1>
    <p>Améliorez vos performances et atteignez vos objectifs avec notre produit.</p>
    <a href="#contact" class="cta-button">Commencer maintenant</a>
</section>

<section class="features">
    <div class="feature">
        <h3>Facile à utiliser</h3>
        <p>Interface intuitive et accessible à tous.</p>
    </div>
    <div class="feature">
        <h3>Support 24/7</h3>
        <p>Nous sommes disponibles à tout moment pour vous aider.</p>
    </div>
    <div class="feature">
        <h3>Optimisé pour le succès</h3>
        <p>Des outils puissants pour booster vos performances.</p>
    </div>
</section>

<footer id="contact">
    <p>Contactez-nous : contact@exemple.com</p>
</footer>

</body>
</html>
