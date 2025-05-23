<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Gestion des Tickets IT</title>
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

        /* Conteneur Principal */
        .container {
            max-width: 400px;
            width: 100%;
            padding: 2rem;
            background-color: rgba(0, 0, 0, 0.7); /* Fond semi-transparent pour contraste */
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        /* Titre */
        h2 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem; /* Espacement entre l'icône et le texte */
        }

        h2 i {
            color: #dda15e; /* Couleur marron pour l'icône */
        }

        /* Champs de Saisie */
        .form-control {
            display: block;
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: 2px solid #fefae0; /* Bordure marron */
            border-radius: 9999px;
            background-color: transparent;
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #fefae0; /* Bordure plus foncée au focus */
            box-shadow: 0 0 8px rgba(127, 85, 57, 0.5); /* Ombre subtile */
        }

        /* Bouton de Connexion */
        .btn-login {
            display: inline-block;
            width: 100%;
            padding: 0.75rem;
            background-color: #dda15e; /* Marron clair */
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 9999px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background-color: #7f5539; /* Marron foncé au survol */
        }

        /* Lien Mot de Passe Oublié */
        .forgot-password {
            display: block;
            margin-top: 1rem;
            color: #4299e1; /* Bleu clair */
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .forgot-password:hover {
            text-decoration: underline;
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
    <!-- Conteneur Principal -->
    <div class="container">
        <!-- Titre avec Icône -->
        <h2>
            <i class="fas fa-sign-in-alt"></i> <!-- Icône Connexion -->
            Connexion
        </h2>

        <!-- Formulaire de Connexion -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Champ Email -->
            <input type="email" name="email" id="email" placeholder="Email" required
                class="form-control">

            <!-- Champ Mot de Passe -->
            <input type="password" name="password" id="password" placeholder="Mot de passe" required
                class="form-control">

            <!-- Case à Cocher "Se souvenir de moi" -->
            <label for="remember_me" class="flex items-center text-sm text-gray-300">
                <input type="checkbox" name="remember" id="remember_me" class="mr-2">
                Se souvenir de moi
            </label>

            <!-- Bouton de Connexion -->
            <button type="submit" class="btn-login">
                <i class="fas fa-arrow-right-to-bracket"></i> <!-- Icône Flèche -->
                Se connecter
            </button>

            <!-- Lien Mot de Passe Oublié -->
            <a href="#" class="forgot-password">
                <i class="fas fa-question-circle"></i> <!-- Icône Point d'Interrogation -->
                Mot de passe oublié ?
            </a>
        </form>
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