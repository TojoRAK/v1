CREATE DATABASE final_S2;
USE final_S2;

CREATE TABLE exm_membre (
    id_membre INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    date_naissance DATE,
    genre CHAR,
    email VARCHAR(150) UNIQUE NOT NULL,
    ville VARCHAR(100),
    mdp VARCHAR(100) NOT NULL,
    image_profil VARCHAR(255)
);

CREATE TABLE exm_categorie_objet (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(100) NOT NULL
);

CREATE TABLE exm_objet (
    id_objet INT AUTO_INCREMENT PRIMARY KEY,
    nom_objet VARCHAR(150) NOT NULL,
    id_categorie INT,
    id_membre INT,
    FOREIGN KEY (id_categorie) REFERENCES exm_categorie_objet(id_categorie) ON DELETE SET NULL,
    FOREIGN KEY (id_membre) REFERENCES exm_membre(id_membre) ON DELETE CASCADE
);

CREATE TABLE exm_images_objet (
    id_image INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    nom_image VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_objet) REFERENCES exm_objet(id_objet) ON DELETE CASCADE
);

CREATE TABLE exm_emprunt (
    id_emprunt INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    id_membre INT,
    date_emprunt DATE NOT NULL,
    date_retour DATE,
    FOREIGN KEY (id_objet) REFERENCES exm_objet(id_objet) ON DELETE CASCADE,
    FOREIGN KEY (id_membre) REFERENCES exm_membre(id_membre) ON DELETE CASCADE
);


INSERT INTO exm_membre (nom, date_naissance, genre, email, ville, mdp, image_profil) VALUES
('Marie Dupont', '1985-03-15', 'F', 'marie.dupont@email.com', 'Paris', 'motdepasse123', 'marie_profile.jpg'),
('Jean Martin', '1990-07-22', 'M', 'jean.martin@email.com', 'Lyon', 'password456', 'jean_profile.jpg'),
('Sophie Leroy', '1988-11-08', 'F', 'sophie.leroy@email.com', 'Marseille', 'mdp789', 'sophie_profile.jpg'),
('Pierre Bernard', '1992-01-30', 'M', 'pierre.bernard@email.com', 'Toulouse', 'secret321', 'pierre_profile.jpg');

INSERT INTO exm_categorie_objet (nom_categorie) VALUES
('Esthétique'),
('Bricolage'),
('Mécanique'),
('Cuisine');

INSERT INTO exm_objet (nom_objet, id_categorie, id_membre) VALUES
('Sèche-cheveux professionnel', 1, 1),
('Kit de manucure complet', 1, 1),
('Perceuse électrique', 2, 1),
('Scie sauteuse', 2, 1),
('Clé à molette', 3, 1),
('Kit de vidange', 3, 1),
('Robot pâtissier', 4, 1),
('Blender haute performance', 4, 1),
('Fer à lisser', 1, 1),
('Ponceuse électrique', 2, 1);

INSERT INTO exm_objet (nom_objet, id_categorie, id_membre) VALUES
('Epilateur électrique', 1, 2),
('Miroir lumineux', 1, 2),
('Marteau pneumatique', 2, 2),
('Niveau laser', 2, 2),
('Cric hydraulique', 3, 2),
('Compresseur d\'air', 3, 2),
('Machine à café espresso', 4, 2),
('Multicuiseur', 4, 2),
('Tondeuse à cheveux', 1, 2),
('Visseuse sans fil', 2, 2);

INSERT INTO exm_objet (nom_objet, id_categorie, id_membre) VALUES
('Appareil anti-âge', 1, 3),
('Brosse soufflante', 1, 3),
('Scie circulaire', 2, 3),
('Défonceuse', 2, 3),
('Jeu de clés plates', 3, 3),
('Testeur de batterie', 3, 3),
('Friteuse sans huile', 4, 3),
('Mixeur plongeant', 4, 3),
('Epilateur lumière pulsée', 1, 3),
('Meuleuse d\'angle', 2, 3);

INSERT INTO exm_objet (nom_objet, id_categorie, id_membre) VALUES
('Rasoir électrique', 1, 4),
('Tondeuse barbe', 1, 4),
('Perforateur', 2, 4),
('Scie à métaux', 2, 4),
('Clés dynamométriques', 3, 4),
('Manomètre pneus', 3, 4),
('Yaourtière', 4, 4),
('Machine à pain', 4, 4),
('Brosse nettoyante visage', 1, 4),
('Cloueuse pneumatique', 2, 4);

INSERT INTO exm_emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES
(1, 2, '2025-07-01', '2025-07-08'),  
(15, 1, '2025-07-02', '2025-07-09'), 
(23, 4, '2025-07-03', '2025-07-09'),         
(37, 3, '2025-07-04', '2025-07-11'), 
(3, 4, '2025-07-05', '2025-07-09'),          
(18, 1, '2025-07-06', '2025-07-13'), 
(27, 2, '2025-07-07', '2025-07-09'),         
(33, 3, '2025-07-08', '2025-07-15'), 
(7, 4, '2025-07-09', '2025-07-17'),          
(21, 1, '2025-07-10', '2025-07-17'); 

INSERT INTO exm_emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES
(1, 3, '2025-07-09', '2025-07-16');

CREATE or REPLACE VIEW v_exm_objet_membre as 
SELECT 
    exm_objet.id_objet,
    exm_objet.nom_objet,
    exm_objet.id_membre,
    exm_objet.id_categorie,
    exm_membre.nom 
from exm_objet
join exm_membre on exm_membre.id_membre = exm_objet.id_membre;
    
CREATE OR REPLACE VIEW v_objet_emprunt AS
SELECT 
    v_exm_objet_membre.*,
    exm_categorie_objet.nom_categorie,
    exm_emprunt.id_emprunt,
    exm_emprunt.id_membre as id_mpindrana,
    exm_emprunt.date_emprunt,
    exm_emprunt.date_retour,
    exm_membre.nom as nom_emprunt
FROM v_exm_objet_membre
LEFT JOIN exm_emprunt ON exm_emprunt.id_objet = v_exm_objet_membre.id_objet
LEFT JOIN exm_categorie_objet ON exm_categorie_objet.id_categorie = v_exm_objet_membre.id_categorie
LEFT JOIN exm_membre on exm_membre.id_membre = exm_emprunt.id_membre;


CREATE OR REPLACE TABLE exm_objet_retourner
(
    id_retour INT AUTO_INCREMENT PRIMARY KEY,
    id_membre_mamerina INT,
    id_objet INT,
    etat varchar(10),
    FOREIGN KEY (id_objet) REFERENCES exm_objet(id_objet) ON DELETE CASCADE,
    FOREIGN KEY (id_membre_mamerina) REFERENCES exm_membre(id_membre) ON DELETE CASCADE
);