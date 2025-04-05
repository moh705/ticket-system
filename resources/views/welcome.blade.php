<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Tickets IT</title>
    <!-- Font Awesome pour les icônes -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Styles de Base */
        body {
            background: url('{{ asset('images/background.png') }}') no-repeat center center fixed;
            background-size: cover;
            color: white;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .image-container {
            width: 50%;
        }

        .image-container img {
            max-width: 100%;
            height: auto;
        }

        .text-container {
            width: 50%;
        }

        h1 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 2rem;
        }

        /* Style Général des Boutons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem; /* Espacement entre l'icône et le texte */
            padding: 1rem 2rem;
            margin: 0.5rem;
            border-radius: 9999px;
            font-weight: bold;
            text-decoration: none;
            color: white; /* Texte en blanc pour contraste */
            transition: all 0.3s ease;
        }

        /* Bouton Connexion */
        .btn-login {
            background-color: #dda15e; /* Marron clair */
        }

        .btn-login:hover {
            background-color: #7f5539; /* Marron foncé au survol */
        }

        /* Bouton Inscription */
        .btn-register {
            background-color: #dda15e; /* Marron clair */
        }

        .btn-register:hover {
            background-color: #7f5539; /* Marron foncé au survol */
        }

        /* Footer */
        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.6); /* Fond semi-transparent */
            color: white;
            padding: 1rem 0;
            font-size: 0.9rem;
            text-align: center;
        }

        footer a {
            color: #4299e1; /* Lien bleu clair */
            text-decoration: none;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem; /* Espacement entre l'icône et le texte */
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Contenu Principal -->
    <div class="container">
        <div class="image-container">
            <img src="{{ asset('images/technician.png') }}" alt="Technicien en maintenance">
        </div>
        <div class="text-container">
            <!-- Titre avec Icône -->
            <h1>
                <i class="fas fa-ticket-alt"></i> <!-- Icône Ticket -->
                Gestion des Tickets IT
            </h1>

            <!-- Boutons avec Icônes -->
            <a href="{{ route('login') }}" class="btn btn-login">
                <i class="fas fa-sign-in-alt"></i> <!-- Icône Connexion -->
                Connexion
            </a>
            <a href="{{ route('register') }}" class="btn btn-register">
                <i class="fas fa-user-plus"></i> <!-- Icône Inscription -->
                Inscription
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        © 2025 Gestion des Tickets IT. Tous droits réservés.
        <br>
        <a href="#">
            <i class="fas fa-file-contract"></i> <!-- Icône Mentions Légales -->
            Mentions légales
        </a>
        |
        <a href="#">
            <i class="fas fa-shield-alt"></i> <!-- Icône Politique de Confidentialité -->
            Politique de confidentialité
        </a>
    </footer>
</body>
</html>