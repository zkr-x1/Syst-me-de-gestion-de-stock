# 🎨 Documentation Frontend : Gestion de Stock

Cette section explique comment est construit l'affichage de notre application web (le "Frontend") et comment les interfaces interagissent avec Laravel.

## 📌 Les Pages Principales du Site
L'interface utilisateur est divisée en plusieurs grands écrans pour simplifier la navigation :
- **🔐 Authentification :** Des pages dédiées pour se connecter ou s'inscrire, afin de sécuriser l'accès à l'inventaire.
- **🏠 Dashboard (Tableau de bord) :** La page d'accueil principale affichant un résumé global (statistiques du stock, alertes, produits les plus vendus).
- **📦 Liste des Produits :** Un tableau récapitulatif montrant tous les articles disponibles avec leurs quantités et prix respectifs.
- **➕ Formulaire Produit :** Une page permettant d'ajouter ou de modifier facilement les informations d'un produit.
- **📁 Catégories :** Une interface pour créer, lister et gérer les groupes de familles de produits.

## 🏗️ Structure des Fichiers Blade (Les Vues HTML)
Laravel utilise un système très pratique appelé **Blade** (`.blade.php`) pour générer le code HTML. Pour éviter de répéter le même code sur chaque page, on utilise une architecture par "blocs" :
- **Le `layout` général :** C'est le "squelette" principal du site (souvent nommé `app.blade.php`). Il contient les balises principales `<html>`, `<head>`, et `<body>`.
- **Les `partials` :** Ce sont des morceaux de code réutilisables qui viennent se greffer au layout, comme un `header` (Menu du haut), un `footer` (Pied de page) ou une barre latérale.
- **Les pages spécifiques :** Chaque page (comme la liste des produits) vient simplement "s'injecter" au milieu du layout général. Ainsi, si on veut modifier le menu, on ne le fait qu'à un seul endroit !

## 🎨 Les Fichiers de Design (CSS, JS, Images)
Le design visuel de l'application s'appuie sur des fichiers classiques du web :
- Les fichiers **CSS** (pour les couleurs et la mise en forme), **JS** (pour les animations ou interactions, comme les alertes) et les **Images** doivent être stockés dans le dossier principal **`public/`** de Laravel (ex: `public/css/style.css`).
- Dans vos fichiers Blade, vous pouvez lier un fichier de design très facilement à l'aide de la fonction native de Laravel : 
  `<link rel="stylesheet" href="{{ asset('css/style.css') }}">`

## 🔄 Interaction entre le Frontend et le Backend
Voici ce qui se passe sous le capot pour afficher ou sauvegarder des données :
- **Affichage des données :** Le backend (Laravel) récupère par exemple tous les produits depuis la base de données, et les "envoie" à la page HTML. Dans cette page, une directive simplifiée (`@foreach`) va boucler sur ces données pour générer automatiquement une ligne de tableau par produit.
- **Soumission de formulaire :** Lorsque vous remplissez un formulaire pour créer un produit et cliquez en bas sur "Valider", la page HTML envoie ces informations (Requête `POST`) au backend. Laravel exige d'ailleurs qu'on ajoute une balise `@csrf` dans le formulaire pour vérifier que l'envoi est sécurisé et légitime.

## 💡 Conseils d'organisation pour les débutants
Afin de garder votre code le plus clair possible, voici l'organisation idéale du projet :
- **`resources/views/` :** Mettez toutes vos pages principales, rangées dans des sous-dossiers (ex: `resources/views/products/` ou `resources/views/auth/`).
- **`resources/views/layouts/` :** Placez-y vos squelettes (`app.blade.php`).
- **`resources/views/partials/` :** Conservez ici vos petits bouts de page (En-tête, menu latéral).

## 🚀 Lancer le projet et visualiser le Frontend
Prêt à voir le résultat s'afficher dans votre navigateur de vos propres yeux ? 
1. Ouvrez votre terminal (invite de commande) au niveau du dossier de votre projet.
2. Lancez le serveur local intégré avec cette commande : 
   ```bash
   php artisan serve
   ```
3. Ouvrez un navigateur web (Chrome, Firefox...) et tapez l'adresse URL affichée par la commande (le plus souvent `http://localhost:8000` ou `http://127.0.0.1:8000`).
