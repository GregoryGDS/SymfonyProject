Binôme avec Charles Panet

- docker-compose.yml en version 3.6 pour utiliser sous windows
- port 8012

- Si vous voulez utiliser les migrations présentent dans le projet, utilisé la commande 
    " docker-compose exec web php bin/console d:s:u -f ", à la place du doctrine:migration:migrate,pour forcer toutes les migrations. Sinon, l'id de liaison en editeur/jeu vidéo et le role dans le user ne sont pas présent.

- L'évent de la création d'un user est bien généré mais il ne créé pas de log. Nous avaons bien utilisé le           subscriber et le EventDispatcher mais aucun log n'est créé. Nous avons donc demandé à des camarades de classe      pour qui la création du log marchait mais ils n'ont pas put nous aider.

- commande de création d'admin : app:create-admin-user mail_requis mdp_requis prenom_optionnel nom_optionnel

- si admin: suppression / mise à jour :
            - user : dans profil user
            - editeur : dans detail editeur
            - jeu vidéo : detail jeu vidéo

- modif utilisateur, on doit aussi modifier le mot de passe

- Navré s'il manque des choses, se sont des oublies de notre part, ça à été assez compliqué d'avancer convennablement entre le projet, le travail et les revisions du partiels.

- Le message flash s'ajoute en dessous de la Navbar
