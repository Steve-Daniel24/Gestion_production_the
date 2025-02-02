-- Insertion des variétés de thé
INSERT INTO `varietes_the` (`nom`, `surface_pied`, `rendement_pied`, `prix_vente`) VALUES
('Assam', 1.50, 2.00, 15.00),
('Darjeeling', 1.20, 1.80, 18.00),
('Sencha', 1.30, 2.20, 20.00),
('Earl Grey', 1.40, 1.90, 22.00),
('Oolong', 1.60, 2.50, 25.00);

-- Insertion des parcelles
INSERT INTO `parcelles` (`numero`, `surface`, `variete_the_id`) VALUES
('P001', 100.00, 1),
('P002', 120.50, 2),
('P003', 95.75, 3),
('P004', 110.30, 4),
('P005', 130.00, 5);

-- Insertion des cueilleurs
INSERT INTO `cueilleurs` (`nom`, `genre`, `date_naissance`) VALUES
('Jean Dupont', 'M', '1985-07-14'),
('Marie Curie', 'F', '1990-05-22'),
('Paul Martin', 'M', '1988-11-03'),
('Sophie Durant', 'F', '1995-09-18'),
('Lucien Moreau', 'M', '1992-06-25');
