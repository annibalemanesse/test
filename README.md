TEST TECHNIQUE 
# MySQL
##### Récupérer le prénom et le nom de famille de tous les clients qui ont commandé le produit PRODUIT_1; 
` SELECT `firstName`, `lastName` FROM `customer`
     JOIN `order` ON customer.id = `order`.id_customer
     JOIN `order_details` ON `order`.id = `order_details`.`id_order`
     JOIN `product` ON `order_details`.`id_product` = `product`.id
         WHERE `product`.`name` = 'PRODUCT_1';`
 
##### Récupérer tous les noms et quantités des produits vendus sur les 7 derniers jours.

` SELECT `name`, `order_details`.`quantityOrdered` FROM `product` 
    JOIN `order_details` ON `product`.id = `order_details`.id_product 
    JOIN `order` ON `order_details`.`id_order` = `order`.id 
        WHERE (`status` = 'confirmed' OR `status` = 'shipped') AND `order`.`orderDate`>= DATE_ADD(CURDATE(),INTERVAL -7 DAY)
         `
# PHP: 
#### Stockage des commentaires
 J'ai privilégié le stockage des commentaires en base de données. En effet, j'ai trouvé pertinent de garder une trace persistante de chaque commentaire laissé sur le site.
#### Classes
 Lors de la conception j'ai décidé de créer trois classes:
  - `ProductRetriever`, utile pour récupérer les produits depuis une API. 
  - `Comment`
  - `User` Il m'est apparu nécessaire de créer un système d'authentification pour gérer les permissions liées aux commentaires :
    * seuls les utilisateurs connectés peuvent commenter un produit
    * seuls les auteurs d'un commentaires peuvent modifier et/ou supprimer celui-ci. 
    
#### Commentaires

- La base de données contenant les tables `comments` et `user` se trouve dans le fichier `reviews.sql`.
- Les informations de connexion à la base de données sont à remplir dans le fichier `config.php`.

- l'application étant de taille réduite, je n'ai pas développé en MVC, bien que j'aie séparé certaines vues du code pour un minimum de clarté.
- J'ai volontairement peu commenté mon code car je m'entraîne à le rendre lisible et compréhensible.
- Lors de l'ajout ou de la modification d'un commentaire, il est nécessaire de recharger la page pour que le nouveau commentaire s'affiche. Je pense qu'il faudrait récupérer les commentaires après le script vérifiant la soumission et récupérant le `$_POST` mais en dépit de tous mes essais, ça ne fonctionnait pas.



