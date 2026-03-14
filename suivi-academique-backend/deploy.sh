#!/bin/bash

# Script de déploiement Docker pour Laravel

echo "🚀 Démarrage du déploiement Docker..."

# 1. Vérifier que Docker est installé
if ! command -v docker &> /dev/null; then
    echo "❌ Docker n'est pas installé. Veuillez installer Docker d'abord."
    exit 1
fi

echo "✅ Docker trouvé"

# 2. Vérifier que Docker Compose est installé
if ! command -v docker-compose &> /dev/null; then
    echo "❌ Docker Compose n'est pas installé. Veuillez installer Docker Compose d'abord."
    exit 1
fi

echo "✅ Docker Compose trouvé"

# 3. Générer la clé APP si elle n'existe pas
if [ ! -f ".env" ]; then
    echo "📝 Copie du fichier .env.example..."
    cp .env.example .env
fi

# 4. Générer la clé APP_KEY
if ! grep -q "^APP_KEY=base64:" .env || [ -z "$(grep '^APP_KEY=' .env | cut -d= -f2-)" ]; then
    echo "🔑 Génération de la clé APP..."
    APP_KEY=$(docker-compose run --rm app php artisan key:generate --show 2>/dev/null || echo "base64:$(openssl rand -base64 32)")
    sed -i.bak "s/^APP_KEY=.*/APP_KEY=${APP_KEY}/" .env
    rm -f .env.bak
fi

# 5. Arrêter les conteneurs existants
echo "🛑 Arrêt des conteneurs existants..."
docker-compose down

# 6. Construire les images
echo "🔨 Construction des images Docker..."
docker-compose build

# 7. Démarrer les conteneurs
echo "▶️ Démarrage des conteneurs..."
docker-compose up -d

# 8. Attendre que la base de données soit prête
echo "⏳ Attente de la base de données..."
sleep 10

# 9. Exécuter les migrations
echo "🗄️ Exécution des migrations..."
docker-compose exec -T app php artisan migrate --force

# 10. Créer les répertoires de cache
echo "📁 Création des répertoires de cache..."
docker-compose exec -T app php artisan storage:link || true

# 11. Afficher les informations
echo ""
echo "✅ Déploiement terminé avec succès!"
echo ""
echo "📋 Informations d'accès:"
echo "   - Application: http://localhost:8080"
echo "   - Base de données: localhost:3306"
echo "   - Utilisateur DB: root"
echo ""
echo "🐳 Commandes utiles:"
echo "   - Voir les logs: docker-compose logs -f"
echo "   - Accéder à l'app: docker-compose exec app bash"
echo "   - Artisan CLI: docker-compose exec app php artisan [command]"
echo ""
