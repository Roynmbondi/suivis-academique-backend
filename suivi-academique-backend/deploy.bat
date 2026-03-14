@echo off
REM Script de déploiement Docker pour Laravel (Windows)

echo.
echo ========================================
echo   Deployment Docker - Suivi Academique
echo ========================================
echo.

REM 1. Vérifier que Docker est installé
echo Verification de Docker...
docker --version > nul 2>&1
if errorlevel 1 (
    echo ERROR: Docker n'est pas installe. Veuillez installer Docker Desktop.
    exit /b 1
)
echo OK: Docker trouve

REM 2. Vérifier que Docker Compose est installé
echo Verification de Docker Compose...
docker-compose --version > nul 2>&1
if errorlevel 1 (
    echo ERROR: Docker Compose n'est pas installe.
    exit /b 1
)
echo OK: Docker Compose trouve

REM 3. Copier .env si nécessaire
if not exist ".env" (
    echo Copie du fichier .env.example...
    copy .env.example .env > nul
)

REM 4. Arrêter les conteneurs existants
echo.
echo Arret des conteneurs existants...
docker-compose down

REM 5. Construire les images
echo.
echo Construction des images Docker...
docker-compose build

REM 6. Démarrer les conteneurs
echo.
echo Demarrage des conteneurs...
docker-compose up -d

REM 7. Attendre que la base de données soit prête
echo.
echo Attente de la base de donnees (10 secondes)...
timeout /t 10 /nobreak

REM 8. Exécuter les migrations
echo.
echo Execution des migrations...
docker-compose exec -T app php artisan migrate --force

REM 9. Créer les liens de stockage
echo.
echo Creation des repertoires de stockage...
docker-compose exec -T app php artisan storage:link

REM 10. Afficher les informations
echo.
echo ========================================
echo   Deployment Termine!
echo ========================================
echo.
echo Information d'acces:
echo   - Application: http://localhost:8080
echo   - Base de donnees: localhost:3306
echo   - Utilisateur BD: root
echo.
echo Commandes utiles:
echo   - Voir les logs: docker-compose logs -f
echo   - Acces a l'app: docker-compose exec app bash
echo   - Commandes Artisan: docker-compose exec app php artisan [command]
echo.
pause
