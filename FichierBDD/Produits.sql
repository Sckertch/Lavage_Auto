-- Création de la table Produit
CREATE TABLE Produit (
    Id INT PRIMARY KEY,
    nom VARCHAR(255),
    caractéristiques TEXT,
    description TEXT,
    prix DECIMAL(10, 2),
    link TEXT
);

-- Insertion des données dans la table Produit
INSERT INTO Produit (Id, nom, caractéristiques, description, prix,link) VALUES
(1, 'Coffret lavage normal', 'Le coffret lavage normal, permet un lavage simple pour l’extérieur de votre véhicule. Il est composé de : Bouteille de savon ultra moussant, Éponge désincrustante, Peau de chamois.', 'Sous réserve de stock disponible. Pas de livraison possible, passez en magasin.', 12.00,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRPmvU5FZlTOO4POKmpy20LhY1ImpjhVmyKog&s'),
(2, 'Coffret lavage prémium', 'Le coffret lavage prémium, permet un lavage efficace pour l’extérieur de votre véhicule. Il est composé de : Bouteille de savon ultra moussant, Éponge désincrustante, Peau de chamois, Pulvérisateur lustrage déperlant, Micro fibre.', 'Sous réserve de stock disponible. Pas de livraison possible, passez en magasin.', 21.00,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZMcWAcLdXS1FQgBGnmw-sn5hFMxaICokCltcwEH9u5Dq4maHndBGbzDTg9ienzKBun2g&usqp=CAU'),
(3, 'Coffret lavage exclusif', 'Le coffret lavage exclusif, permet un lavage total pour l’extérieur de votre véhicule pour une durabilité maximale. Il est composé de : Bouteille de savon ultra moussant, Éponge désincrustante, Peau de chamois, Pulvérisateur lustrage déperlant, Micro fibre, Cire lustrante, Patin d’application de cire.', 'Sous réserve de stock disponible. Pas de livraison possible, passez en magasin.', 35.00,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStrLsutRZrOnu80-7b1tE6tIky5QLq02irTQ&s'),
(4, 'Bouteille de savon ultra moussant', 'Ce savon vous permet la décontamination de votre carrosserie et la désincrustation de salissures et goudron.', 'Sous réserve de stock disponible. Pas de livraison possible, passez en magasin.', 6.90,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSh4Xe3o0hrXlTMYcEsR_EqXN6kYmlCE21qwQ&s'),
(5, 'Pulvérisateur lustrant déperlant', 'Grace à ce pulvérisateur, les salissures adhèrent moins à la carrosserie et évite les traces de calcaire.', 'Sous réserve de stock disponible. Pas de livraison possible, passez en magasin.', 4.90,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR67SDTa_gj_j4QmhKx-_AD7eYAfpoyK4gnNg&s'),
(6, 'Cire lustrante', 'Cette cire s’applique sur une carrosserie sèche et permet une brillance extrême.', 'Sous réserve de stock disponible. Pas de livraison possible, passez en magasin.', 16.90,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTMduHo0_QD2asBI7PuD31Ftz4Wyd7VJgHGgQ&s');
