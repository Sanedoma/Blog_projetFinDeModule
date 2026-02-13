# 📝 SyFblog - Blog Symfony Moderne

Un blog professionnel et moderne construit avec **Symfony 6.x**, proposant une interface macOS glassmorphism et un système complet de gestion d'articles avec commentaires.

---

## 🎯 Fonctionnalités Principales

### 👤 Gestion des Utilisateurs
- ✅ Inscription et authentification sécurisée
- ✅ Profil utilisateur avec édition
- ✅ Upload de photo de profil avec sanitisation des fichiers
- ✅ Déactivation de compte par admin
- ✅ Deux rôles: `ROLE_ADMIN` et `ROLE_USER`

### 📰 Gestion des Articles
- ✅ Création, édition, suppression d'articles (ROLE_USER)
- ✅ Système de catégories
- ✅ Articles en vedette (featured)
- ✅ Images pour les articles
- ✅ Filtrage par catégorie, auteur et date
- ✅ Pagination (12 articles par page)
- ✅ Barre de recherche (titre et contenu)

### 💬 Commentaires
- ✅ Commentaires sur les articles
- ✅ Gestion des commentaires (édition, suppression)
- ✅ Affichage hiérarchique des commentaires

### 🎨 Design & UX
- ✅ Design macOS glassmorphism avec blur effects
- ✅ Mode sombre/clair avec toggle en navbar
- ✅ Responsive design (mobile, tablet, desktop)
- ✅ Transitions fluides et hover effects
- ✅ Dark mode CSS variables override
- ✅ Typography professionnelle

### 🔍 Recherche & Filtrage
- ✅ Recherche globale par barre de recherche
- ✅ Filtrage avancé (catégorie, auteur, date)
- ✅ Combinaison des filtres
- ✅ Préservation des paramètres de filtrage en pagination

### 🔐 Sécurité
- ✅ Authentification Symfony Security
- ✅ CSRF protection
- ✅ Contrôle d'accès basé sur les rôles
- ✅ Vérification de propriété (users peuvent éditer leurs articles)
- ✅ Hash des mots de passe

---

## 📁 Structure du Projet

```
Blog_projetFinDeModule/
├── src/
│   ├── Controller/              # Contrôleurs
│   │   ├── HomeController.php   # Accueil avec filtrage et pagination
│   │   ├── PostController.php   # Articles (CRUD)
│   │   ├── CommentController.php # Commentaires
│   │   ├── AdminController.php   # Dashboard admin
│   │   ├── ProfileController.php # Profils utilisateurs
│   │   ├── RegistrationController.php
│   │   ├── SecurityController.php
│   │   └── SeedController.php    # Données de test
│   │
│   ├── Entity/                  # Entités Doctrine
│   │   ├── User.php             # Utilisateur (email, firstName, lastName, roles, profilePicture)
│   │   ├── Post.php             # Article (title, content, picture, featured, publishAt)
│   │   ├── Category.php         # Catégorie (name)
│   │   └── Comment.php          # Commentaire (content, createAt)
│   │
│   ├── Form/                    # Types de formulaires
│   │   ├── PostType.php
│   │   ├── CommentType.php
│   │   ├── CategoryType.php
│   │   └── RegistrationFormType.php
│   │
│   ├── Repository/              # Repositories Doctrine
│   │   ├── PostRepository.php   # findWithFilters() pour recherche
│   │   ├── CommentRepository.php
│   │   ├── CategoryRepository.php
│   │   └── UserRepository.php
│   │
│   ├── DataFixtures/            # Données d'exemple
│   │   └── AppFixtures.php      # 4 users, 4 categories, 12 posts, comments
│   │
│   ├── Security/                # Sécurité
│   │   └── SecurityControllerAuthenticator.php
│   │
│   └── Twig/Extension/          # Extensions Twig
│       └── QueryParamsExtension.php
│
├── templates/
│   ├── base.html.twig           # Template de base avec navbar
│   ├── home/
│   │   └── index.html.twig      # Accueil avec hero + filtres + grid
│   ├── post/
│   │   ├── index.html.twig      # Liste tous les articles
│   │   ├── show.html.twig       # Détail article + commentaires
│   │   ├── new.html.twig        # Créer article
│   │   ├── edit.html.twig       # Éditer article
│   │   └── _form.html.twig      # Formulaire article
│   ├── comment/
│   │   ├── form.html.twig       # Formulaire commentaire
│   │   └── ...
│   ├── profile/
│   │   ├── index.html.twig      # Dashboard utilisateur
│   │   ├── edit.html.twig       # Éditer profil + upload photo
│   │   └── show.html.twig       # Profil public
│   ├── admin/
│   │   ├── dashboard.html.twig  # Dashboard admin
│   │   ├── users.html.twig      # Gestion users
│   │   ├── posts.html.twig      # Gestion posts
│   │   ├── comments.html.twig   # Gestion commentaires
│   │   └── categories.html.twig # Gestion catégories
│   ├── registration/
│   │   └── register.html.twig
│   └── security/
│       └── login.html.twig
│
├── assets/
│   ├── app.js                   # JS principal
│   ├── dark-mode.js             # Toggle dark/light mode
│   ├── stimulus_bootstrap.js    # Stimulus controllers
│   ├── controllers/             # Stimulus controllers
│   │   ├── csrf_protection_controller.js
│   │   └── hello_controller.js
│   └── styles/
│       ├── app.css              # Styles principaux
│       └── macos.css            # Design system macOS (1500+ lignes)
│           - Variables CSS light/dark
│           - Navbar avec glassmorphism
│           - Hero section
│           - Post cards
│           - Pagination
│           - Forms et inputs
│           - Tables
│           - Badges et alerts
│           - Dark mode overrides
│
├── config/
│   ├── bundles.php
│   ├── services.yaml            # profiles_directory parameter
│   ├── packages/
│   └── routes/
│
├── migrations/                  # Migrations Doctrine
│   └── Version*.php
│
├── public/
│   ├── index.php                # Point d'entrée
│   └── uploads/
│       └── profiles/            # Dossier photos de profil
│
├── bin/
│   ├── console                  # CLI Symfony
│   ├── phpunit
│   └── seed-data.php           # Script pour données de test
│
├── composer.json                # Dépendances PHP
├── phpunit.dist.xml
├── compose.yaml                 # Docker compose
├── compose.override.yaml
└── README.md                     # Ce fichier
```

---

## 🚀 Installation sur un Nouveau PC

### Prérequis
- **PHP 8.1+** (ou via Docker)
- **Composer**
- **Node.js & npm** (pour assets)
- **MySQL/MariaDB** (ou SQLite pour dev)
- **Git**

### 1. Cloner le Projet
```bash
git clone <repository-url>
cd Blog_projetFinDeModule
```

### 2. Installer les Dépendances PHP
```bash
composer install
```

### 3. Configurer l'Environnement
Créer fichier `.env.local` (copie de `.env`):
```bash
cp .env .env.local
```

Adapter les variables (DB, MAILER, etc.):
```env
DATABASE_URL="mysql://user:password@localhost:3306/blog_db?serverVersion=8.0"
# ou pour SQLite en développement:
DATABASE_URL="sqlite:///%kernel.project_dir%/var/app.db"
```

### 4. Créer la Base de Données
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### 5. Charger les Données de Test
```bash
php bin/console doctrine:fixtures:load
```

### 6. Installer les Assets
```bash
npm install
npm run build
# ou en mode watch:
npm run watch
```

### 7. Démarrer le Serveur
```bash
symfony serve
# ou
php -S localhost:8000 -t public/
```

Accéder à: **http://localhost:8000**

---

## 👥 Utilisateurs Pré-créés

### Admin
| Email | Mot de passe | Rôle |
|-------|-------------|------|
| `admin@blog.com` | `admin123` | ROLE_ADMIN |

### Utilisateurs Standards
| Email | Mot de passe | Rôle |
|-------|-------------|------|
| `jean@blog.com` | `user123` | ROLE_USER |
| `marie@blog.com` | `user123` | ROLE_USER |
| `pierre@blog.com` | `user123` | ROLE_USER |

**Note**: Les mots de passe sont hachés avec `bcrypt` et stockés en base de données de manière sécurisée.

---

## 📊 Données de Démonstration

### Catégories (4)
- 💻 Développement
- 🌟 Lifestyle
- 📰 Actualités
- 🎨 Design

### Articles (12)
12 articles réalistes sur des sujets tech:
- Symfony & PHP
- JavaScript & React
- Docker & DevOps
- Web3 & Blockchain
- Performance & Optimisation
- AI & Machine Learning
- Et plus...

Chaque article contient:
- Titre descriptif
- Contenu riche (plusieurs paragraphes)
- Image de bannière
- Auteur (user aléatoire)
- Catégorie
- Date de publication (variée)
- Flag "featured" pour certains

### Commentaires
2 à 5 commentaires par article, réalistes et variés.

---

## 🛠️ Stack Technologique

### Backend
- **Symfony 6.x** - Framework PHP moderne
- **Doctrine ORM** - Gestion de la base de données
- **Symfony Security** - Authentification & autorisation
- **KnpPaginatorBundle** - Pagination professionnelle
- **Symfony Forms** - Gestion des formulaires
- **Symfony Slug Component** - URL-friendly slugs

### Frontend
- **Bootstrap 5.3** - Framework CSS responsive
- **FontAwesome 6.4** - Icônes
- **Stimulus.js** - Interactivité légère
- **Custom CSS** - macOS design system (1500+ lines)

### Outils
- **Composer** - Gestionnaire de dépendances PHP
- **npm** - Gestionnaire d'assets
- **Docker** - Conteneurisation (optionnel)
- **MySQL/SQLite** - Base de données

---

## 🎨 Design & Thèmes

### Système de Design macOS
Le projet utilise un **design system basé sur macOS** avec:

**Couleurs**:
- Bleu primaire: `#0071e3`
- Gris (light mode): `#f5f5f7` à `#1d1d1f`
- Gris (dark mode): `#0a0a0b` à `#5a5a5f`

**Effets**:
- Glassmorphism (blur + transparency)
- Ombres subtiles
- Transitions fluides
- Animations au hover

**Composants**:
- Navbar avec glassmorphism
- Hero sections avec gradients
- Post cards avec hover effects
- Pagination moderne
- Forms minimalistes

### Mode Sombre/Clair
Utilise les **CSS variables** pour basculer entre les thèmes:
- Toggle en navbar
- Persistance localStorage
- Détection du système
- Toutes les composants supportés

---

## 🔑 Fonctionnalités Principales Par Rôle

### Visiteur (Non authentifié)
- ✅ Voir la homepage avec filtrage
- ✅ Voir la liste des articles
- ✅ Lire un article en détail
- ✅ Voir les commentaires
- ✅ Accéder à la page de connexion/inscription

### Utilisateur Connecté (ROLE_USER)
- ✅ Toutes les permissions du visiteur
- ✅ Éditer son profil
- ✅ Upload de photo de profil
- ✅ Créer de nouveaux articles
- ✅ Éditer/supprimer ses propres articles
- ✅ Laisser des commentaires
- ✅ Éditer/supprimer ses commentaires
- ✅ Accéder au dashboard utilisateur

### Administrateur (ROLE_ADMIN)
- ✅ Toutes les permissions de l'utilisateur
- ✅ Dashboard admin avec statistiques
- ✅ Gérer tous les articles (éditer/supprimer)
- ✅ Gérer tous les commentaires
- ✅ Gérer les utilisateurs (activer/désactiver)
- ✅ Créer/éditer les catégories
- ✅ Voir les détails des utilisateurs

---

## 📋 Routes Principales

### Public
- `/` - Accueil avec filtrage
- `/post` - Liste de tous les articles (paginée)
- `/post/{id}` - Détail d'un article

### Authentification
- `/register` - Inscription
- `/login` - Connexion
- `/logout` - Déconnexion

### Utilisateur
- `/profile` - Mon profil/dashboard
- `/profile/edit` - Éditer mon profil
- `/profile/{userId}` - Profil public d'un utilisateur
- `/post/new` - Créer un article
- `/post/{id}/edit` - Éditer un article
- `/post/{id}/delete` - Supprimer un article
- `/post/{postId}/comment/{id}/edit` - Éditer commentaire
- `/post/{postId}/comment/{id}/delete` - Supprimer commentaire

### Admin
- `/admin` - Dashboard admin
- `/admin/users` - Gestion des utilisateurs
- `/admin/posts` - Gestion des articles
- `/admin/comments` - Gestion des commentaires
- `/admin/categories` - Gestion des catégories

---

## 🔒 Sécurité

- ✅ CSRF Protection sur tous les formulaires
- ✅ Hash des mots de passe avec bcrypt
- ✅ Contrôle d'accès granulaire
- ✅ Sanitisation des fichiers uploadés
- ✅ Validation des données côté serveur
- ✅ Authentification session Symfony

---

## 📦 Dépendances Clés

```json
{
  "symfony/framework-bundle": "^6.0",
  "symfony/orm-pack": "^2.0",
  "symfony/security-bundle": "^6.0",
  "symfony/form": "^6.0",
  "symfony/validator": "^6.0",
  "symfony/string": "^6.0",
  "knplabs/knp-paginator-bundle": "^6.0",
  "bootstrap": "^5.3",
  "fortawesome/font-awesome": "^6.4"
}
```

---

## 🐛 Dépannage

### Erreur de base de données
```bash
php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

### Assets non chargés
```bash
npm run build
# ou en développement:
npm run watch
```

### Cache Symfony
```bash
php bin/console cache:clear
```

### Permissions uploads
```bash
chmod -R 755 public/uploads/profiles/
```

---

## 📝 Notes de Développement

- **Base de données**: Les migrations sont incluses, Doctrine gère le schéma
- **Fixtures**: Chargées avec `doctrine:fixtures:load`
- **CSS**: Utilise les variables CSS pour le theming
- **JS**: Minimal, Framework Stimulus.js pour interactivité
- **Formulaires**: Symfony Form avec validation
- **Pagination**: KnpPaginatorBundle avec templates personnalisés

---

## 🎓 Apprentissages Clés

Ce projet démontre:
- Architecture MVC avec Symfony
- Doctrine ORM et migrations
- Authentification et autorisation
- Gestion des formulaires
- Pagination et filtrage
- Design system CSS moderne
- Dark mode avec CSS variables
- Upload de fichiers sécurisé
- CSRF protection
- Relations Doctrine (One-to-Many, Many-to-One)

---

## 📄 License

Ce projet est un exercice pédagogique. Utilisé à titre d'exemple.

---

## 👨‍💻 Auteur

Projet final de module - Blog Symfony moderne avec design macOS

**Date**: Février 2026
**Framework**: Symfony 6.x
**Version PHP**: 8.1+

---

## 📞 Support

Pour toute question ou problème:
1. Vérifier les logs Symfony: `var/log/`
2. Vérifier la base de données
3. Vérifier les permissions des dossiers
4. Relancer `php bin/console` commands

Bon développement! 🚀
