Projet : Gestion d’une plateforme de jeux vidéo
A rendre pour le 03 Février 2020 à 23h59 dernier délai


    Nous considérons que la plateforme de gestion offre la gestion suivante:
    - Des utilisateurs qui se connectent au site
    - La liste des jeux vidéo visibles sur le site
    - La liste des éditeurs de jeux vidéo
    Un utilisateur possède les informations suivantes :
    - email
    - mot de passe encodé
    - prénom
    - nom de famille
    - date de naissance (peut être null)
    - date de création (générée automatiquement au moment de la création de l’utilisateur)
    Un jeux vidéo possède les informations suivantes:
    - Un titre
    - Le support pour y jouer (en liste déroulante fixe si possible, sinon en texte libre)
    - Une description
    - Une date de sortie (peut être null)
    Un éditeur possède les informations suivantes :
    - Un nom de société
    - Une nationalité
    Liaison:
    Les jeux vidéo sont liés aux éditeurs de la manière suivante: un jeu vidéo ne peut avoir
    qu’un seul éditeur, et un éditeur peut avoir plusieurs jeux vidéo
    En tant que visiteur non connecté:
    - Je dois pouvoir voir la liste des jeux vidéo disponible
    - Dans la liste des jeux vidéo, je dois pouvoir voir le détail du jeux vidéo et également
    l’éditeur auquel il est lié
    - Je dois pouvoir cliquer sur un lien “Détail” qui m'affiche une page de détail d’un jeux
    vidéo avec son éditeur lié
    - Je dois pouvoir créer un compte utilisateur
    - Je dois pouvoir me connecter au site
    En tant qu'utilisateur connecté (ROLE_USER):
    - Je dois pouvoir voir la liste des jeux vidéo disponibles
    - Dans la liste des jeux vidéo, je dois pouvoir voir le détail du jeux vidéo et également
    l’éditeur auquel il est lié
    - Je dois pouvoir cliquer sur un lien “Détail” qui m'affiche une page de détail d’un jeux
    vidéo
    - Je dois pouvoir voir la liste des éditeurs disponible
    - Dans la liste des éditeurs, je dois pouvoir voir le nom de l’entreprise
    - Je dois pouvoir cliquer sur un lien “Détail” qui m'affiche une page de détail d’un
    éditeur, avec la liste des jeux vidéo qui lui sont liés
    - Je dois pouvoir me déconnecter
    - Je dois pouvoir accéder à mon profil et avoir la possibilité de le modifier
    En tant qu'admin connecté (ROLE_ADMIN):
    - J’ai les même accès que ROLE_USER
    - Je peux créer un nouveau jeu vidéo
    - Je peux modifier et supprimer des jeux vidéo existants
    - Je peux créer un nouvel éditeur
    - Je peux modifier et supprimer des éditeurs existant (si un éditeur est supprimé, les
    jeux vidéo qui lui sont lié ne sont pas supprimés en conséquence)
    - je peux voir la liste des utilisateurs
    - Je peux créer, modifier et supprimer des utilisateurs
    Coté gestion de l’application :
    - Un événement est propagé lorsqu’un utilisateur va créer un compte sur le site. un
    Subscriber va écouter cet événement et écrire un log pour indiquer qu’un utilisateur a
    été créé
    - Avec une commande, je peux créer un utilisateur Admin en utilisant un email et un
    mot de passe (pour la gestion des rôles, l’admin peut posséder ROLE_USER et
    ROLE_ADMIN, ou seulement ROLE_ADMIN si la hiérarchie des rôles est ajoutée
    dans la configuration)
    - Ajouter une barre de navigation avec les liens vers les pages du site, les liens sont
    mis à jour en fonction des accès de l’utilisateur (Anonyme, User ou Admin)
    - Ajouter un message flash de notification lorsqu’un utilisateur est
    créé/modifié/supprimé, qu’un jeux vidéo est créé/modifié/supprimé et qu’un éditeur
    est créé/modifié/supprimé (pour plus de facilité à gérer l’affichage des messages, la
    partie en twig réalisant l’affichage peut être déplacé dans base.html.twig pour qu’elle
    soit appliqué sur toutes les pages de votre site)
    Validation sur les champs des entités :
    - Les emails sont des emails corrects, ne sont pas vides et sont uniques
    (“unique=true” dans la configuration de la colonne avec Doctrine)
    - Les titres et nom d’entreprise ne sont pas vides et font au minimum 2 caractères de
    long
    - Le mot de passe n’est pas vide
    Pousser votre code sur Github ou Gitlab
    Si vous avez des indications à faire n’hésitez pas à commenter votre code, et à remplir un
    README.md à la racine de votre projet
    Vous pouvez repartir du “symfony/website-skeleton” pour commencer votre projet, ou
    repartir sur le projet que nous avons utilisé cette semaine
    La beauté du site n’est pas importante! Le but de l’exercice est de pratiquer les
    composants de Symfony, pas de faire un site magnifique
    Si vous le souhaitez, vous pouvez faire des ajouts fonctionnels et/ou rajouter des
    champs supplémentaires dans vos entités selon vos envies si ces ajouts vous semble
    logique
    Aller un peu plus loin (points en plus):
    - Un utilisateur connecté peut ajouter un ou plusieurs jeux vidéo en favori, soit par un
    simple lien "Ajouter", soit par un formulaire avec une liste déroulante pour les ajouter
    un par un
    - Un utilisateur connecté peut également voir sa liste de favoris et supprimer un jeu de
    cette liste (cette action ne supprime pas le jeu vidéo de la base de donnée)
    - construire des fixtures pour générer aléatoirement des utilisateurs (dont un pourra
    être défini Admin), des éditeurs et des jeux vidéo
    - utiliser la dépendance entre les fixtures pour enregistrer le lien entre un jeux vidéo
    aléatoire et un éditeur aléatoire