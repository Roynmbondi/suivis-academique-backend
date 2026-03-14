# 🐳 Déploiement Docker - Suivi Académique Backend

Ce guide explique comment déployer le projet Laravel avec Docker.

## ✅ Prérequis

Avant de commencer, assurez-vous d'avoir installé:
- **Docker Desktop** ([Télécharger](https://www.docker.com/products/docker-desktop))
- **Docker Compose** (inclus avec Docker Desktop)
- **Git** (optionnel, si le projet n'est pas déjà cloné)

### Vérifier l'installation

```bash
docker --version
docker-compose --version
```

## 🚀 Déploiement Automatique

### Sous Windows

Double-cliquez sur le fichier `deploy.bat` :
```
deploy.bat
```

Ou via PowerShell:
```powershell
.\deploy.bat
```

### Sous Linux/macOS

Rendez le script exécutable et lancez-le:
```bash
chmod +x deploy.sh
./deploy.sh
```

## 🔧 Déploiement Manuel

Si vous préférez faire les étapes manuellement:

### 1. Préparer le fichier d'environnement

```bash
cp .env.example .env
```

### 2. Générer la clé de l'application

```bash
docker-compose run --rm app php artisan key:generate
```

### 3. Construire les images Docker

```bash
docker-compose build
```

### 4. Démarrer les conteneurs

```bash
docker-compose up -d
```

### 5. Exécuter les migrations

```bash
docker-compose exec app php artisan migrate --force
```

### 6. Créer les liens de stockage (optionnel)

```bash
docker-compose exec app php artisan storage:link
```

## 🌐 Accéder à l'Application

Une fois déployée, l'application est accessible à:

- **URL**: http://localhost:8080
- **Base de données**: localhost:3306
- **Utilisateur BD**: root
- **Mot de passe BD**: root (configurable dans `.env`)

## 📝 Configuration Personnalisée

Vous pouvez personnaliser le déploiement en modifiant le fichier `.env`:

```env
APP_NAME=Suivi Academique
APP_DEBUG=true
APP_URL=http://localhost:8080

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=suivi_academique_backend
DB_USERNAME=root
DB_PASSWORD=root
```

Après modification, redémarrez les conteneurs:
```bash
docker-compose down
docker-compose up -d
```

## 📊 Commandes Utiles

### Voir les logs

```bash
docker-compose logs -f
```

### Accéder au conteneur de l'application

```bash
docker-compose exec app bash
```

### Exécuter une commande Artisan

```bash
docker-compose exec app php artisan [commande]
```

### Exécuter les tests

```bash
docker-compose exec app php artisan test
```

### Arrêter les conteneurs

```bash
docker-compose down
```

### Arrêter et supprimer les données

```bash
docker-compose down -v
```

## 🔒 Structure des Conteneurs

Le déploiement crée 3 conteneurs:

| Conteneur | Image | Port | Description |
|-----------|-------|------|-------------|
| `laravel-app` | PHP 8.2-FPM | 9000 | Application Laravel |
| `laravel-web` | Nginx Alpine | 8080 | Serveur web |
| `laravel-db` | MySQL 8.0 | 3306 | Base de données |

## ❌ Dépannage

### Le port 8080 est déjà utilisé

Modifiez le port dans `docker-compose.yml`:
```yaml
ports:
  - "8081:80"  # Utilisez 8081 ou un autre port libre
```

### La base de données n'est pas accessible

Assurez-vous que le conteneur MySQL a le temps de démarrer:
```bash
docker-compose logs laravel-db
```

### Migrations échouées

Vérifiez que la base de données est prête:
```bash
docker-compose exec db mysql -uroot -proot -e "SELECT 1"
```

### Réinitialiser complètement

```bash
docker-compose down -v
docker-compose up -d
docker-compose exec app php artisan migrate:fresh --seed
```

## 📦 Fichiers Docker

- `dockerfile` - Configuration de l'image PHP
- `docker-compose.yml` - Configuration de l'orchestration des conteneurs
- `docker/php/local.ini` - Configuration PHP personnalisée
- `docker/nginx/conf.d/app.conf` - Configuration Nginx
- `.dockerignore` - Fichiers à exclure de la build Docker

## 📞 Support

Pour plus d'aide:
- Consultez la [documentation Docker](https://docs.docker.com/)
- Consultez la [documentation Laravel](https://laravel.com/docs)
- Consultez la [documentation Nginx](https://nginx.org/en/docs/)

---
**Créé pour le projet Suivi Académique Backend**
