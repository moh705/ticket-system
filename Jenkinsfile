pipeline {
    agent any

    environment {
        // Variables d'environnement
        DOCKER_HUB_CREDENTIALS = credentials('docker-hub-creds') // Identifiants Docker Hub
        APP_ENV = 'production' // Environnement cible
    }

    stages {
        // Étape 1 : Récupérer le Code Source
        stage('Checkout') {
            steps {
                echo "Récupération du code depuis GitHub..."
                git branch: 'main', url: 'https://github.com/moh705/ticket-system.git'
            }
        }

        // Étape 2 : Installer les Dépendances
        stage('Install Dependencies') {
            steps {
                echo "Installation des dépendances avec Composer et NPM..."
                sh 'composer install --no-interaction --prefer-dist --optimize-autoloader'
                sh 'npm install'
            }
        }

        // Étape 3 : Exécuter les Tests
        stage('Run Tests') {
            steps {
                echo "Exécution des tests unitaires et d'intégration avec PHPUnit..."
                sh './vendor/bin/phpunit --coverage-text'
            }
        }

        // Étape 4 : Construire l'Image Docker
        stage('Build Docker Image') {
            steps {
                echo "Construction de l'image Docker..."
                script {
                    docker.build("gourainy2004/ticket-system:${env.BUILD_NUMBER}")
                }
            }
        }

        // Étape 5 : Publier l'Image Docker sur Docker Hub
        stage('Push Docker Image') {
            steps {
                echo "Connexion à Docker Hub et publication de l'image..."
                script {
                    docker.withRegistry('https://registry.hub.docker.com', 'DOCKER_HUB_CREDENTIALS') {
                        def customImage = docker.image("gourainy2004/ticket-system:${env.BUILD_NUMBER}")
                        customImage.push()
                    }
                }
            }
        }

        // Étape 6 : Déployer avec Docker Compose
        stage('Deploy with Docker Compose') {
            steps {
                echo "Déploiement de l'application avec Docker Compose..."
                sh '''
                cd /path/to/deployment
                docker-compose down
                docker-compose up -d
                '''
            }
        }
    }

    post {
        success {
            echo "Pipeline terminé avec succès !"
        }
        failure {
            echo "Erreur lors de l'exécution du pipeline."
        }
    }
}