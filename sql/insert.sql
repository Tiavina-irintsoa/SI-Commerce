INSERT INTO categorieArticle (libelleCategorie) VALUES
    ('Matériel informatique'),
    ('Fournitures de bureau'),
    ('Équipement de protection individuelle'),
    ('Outils et équipement'),
    ('Mobilier de bureau');

-- Insertion de données dans la table des articles
INSERT INTO article (nomArticle, idCategorieArticle, dateCreation) VALUES
    ('Ordinateur portable', 1, NOW()),
    ('Écran LCD 24 pouces', 1, NOW()),
    ('Stylos', 2, NOW()),
    ('Cahiers', 2, NOW()),
    ('Masques de protection', 3, NOW()),
    ('Perceuse sans fil', 4, NOW()),
    ('Chaise de bureau ergonomique', 5, NOW());

-- Insertion de données dans la table des fournisseurs
INSERT INTO fournisseur (nomFournisseur, emailFournisseur, dateCreation) VALUES
    ('Jumbo Score', 'yoanrazafinjaka@gmail.com', NOW()),
    ('Shoprite', 'rebekaravalison@gmail.com', NOW()),
    ('Leader Price', 'yoanrazafinjaka@gmail.com', NOW()),
    ('Inside Informatique', 'rebekaravalison@gmail.com', NOW()),
    ('IKEA', 'yoanrazafinjaka@gmail.com', NOW());

insert into articleFournisseur values 
(1,4),
(2,4),
(3,1),
(3,2),
(3,3),
(4,1),
(4,2),
(4,3),
(5,1),
(5,2),
(5,3),
(5,4),
(6,5);


insert into service (nomService, iconeService) values
('Achats', 'achats.png'),
('Finance', 'finance.png'),
('Informatique', 'IT.png'),
('Production industrielle', 'production.png'),
('Ressources humaines', 'rh.png'),
('Maintenance et Reparation', 'maintenance.png'),
('Commercial', 'marketing.png');
-- Service Achats
INSERT INTO poste (nomPoste, idService) VALUES
    ('Responsable des achats', 1),
    ('Analyste des achats', 1),
    ('Coordinateur des achats', 1);

-- Service Finance
INSERT INTO poste (nomPoste, idService) VALUES
    ('Responsable financier', 2),
    ('Analyste financier', 2),
    ('Comptable', 2);

-- Service Informatique
INSERT INTO poste (nomPoste, idService) VALUES
    ('Chef de service informatique', 3),
    ('Ingenieur en securite informatique', 3),
    ('Administrateur systeme', 3);


-- Service Production industrielle
INSERT INTO poste (nomPoste, idService) VALUES
    ('Chef de service de production industrielle', 4),
    ('Technicien de production', 4),
    ('Superviseur de production', 4);

-- Service Ressources humaines
INSERT INTO poste (nomPoste, idService) VALUES
    ('Directeur des ressources humaines', 5),
    ('Recruteur', 5),
    ('Gestionnaire de la paie', 5);

-- Service Maintenance et Reparation
INSERT INTO poste (nomPoste, idService) VALUES
    ('Chef de service maintenance', 6),
    ('Electricien de Batiment', 6),
    ('Plombier', 6);

-- Service Marketing
INSERT INTO poste (nomPoste, idService) VALUES
    ('Directeur commercial', 7),
    ('Responsable des Medias Sociaux', 7),
    ('Chef de Produit', 7);

-- Insertion de 50 employés fictifs sur différents postes
INSERT INTO personnel (matricule, nomPersonnel, login, motdepasse, idposte) VALUES
    ('MAT001', 'John Doe', 'john.doe', 'motdepasse1', 1),
    ('MAT002', 'Jane Doe', 'jane.doe', 'motdepasse2', 2),
    ('MAT003', 'Alice Johnson', 'alice.johnson', 'motdepasse3', 2),
    ('MAT004', 'Bob Smith', 'bob.smith', 'motdepasse4', 2),
    ('MAT005', 'Eva Rodriguez', 'eva.rodriguez', 'motdepasse5', 2),
    ('MAT006', 'David Williams', 'david.williams', 'motdepasse6', 3),
    ('MAT007', 'Sophie Brown', 'sophie.brown', 'motdepasse7', 3),
    ('MAT008', 'Michael Davis', 'michael.davis', 'motdepasse8', 4),
    ('MAT009', 'Olivia Miller', 'olivia.miller', 'motdepasse9', 5),
    ('MAT010', 'Liam Wilson', 'liam.wilson', 'motdepasse10', 5),
    ('MAT011', 'Emma Thompson', 'emma.thompson', 'motdepasse11', 5),
    ('MAT012', 'James White', 'james.white', 'motdepasse12', 5),
    ('MAT013', 'Emily Clark', 'emily.clark', 'motdepasse13', 6),
    ('MAT014', 'Daniel Turner', 'daniel.turner', 'motdepasse14', 6),
    ('MAT015', 'Mia Harris', 'mia.harris', 'motdepasse15', 6),
    ('MAT016', 'Oliver Green', 'oliver.green', 'motdepasse16', 7),
    ('MAT017', 'Ava Nelson', 'ava.nelson', 'motdepasse17', 8),
    ('MAT018', 'Lucas Adams', 'lucas.adams', 'motdepasse18', 8),
    ('MAT019', 'Lily Parker', 'lily.parker', 'motdepasse19', 8),
    ('MAT020', 'Jackson Hall', 'jackson.hall', 'motdepasse20', 9),
    ('MAT021', 'Sophia Cook', 'sophia.cook', 'motdepasse21', 9),
    ('MAT022', 'Aiden Murphy', 'aiden.murphy', 'motdepasse22', 10),
    ('MAT023', 'Chloe Bennett', 'chloe.bennett', 'motdepasse23', 11),
    ('MAT024', 'Ethan Reed', 'ethan.reed', 'motdepasse24', 11),
    ('MAT025', 'Madison King', 'madison.king', 'motdepasse25', 11),
    ('MAT026', 'Liam Hayes', 'liam.hayes', 'motdepasse26', 12),
    ('MAT027', 'Emma White', 'emma.white', 'motdepasse27', 12),
    ('MAT028', 'Noah Wright', 'noah.wright', 'motdepasse28', 13),
    ('MAT029', 'Olivia Hill', 'olivia.hill', 'motdepasse29', 14),
    ('MAT030', 'Lucas Morgan', 'lucas.morgan', 'motdepasse30', 14),
    ('MAT031', 'Ava Carter', 'ava.carter', 'motdepasse31', 14),
    ('MAT032', 'Ethan Brooks', 'ethan.brooks', 'motdepasse32', 15),
    ('MAT033', 'Chloe Ward', 'chloe.ward', 'motdepasse33', 15),
    ('MAT034', 'Liam Foster', 'liam.foster', 'motdepasse34', 16),
    ('MAT035', 'Sophia Watson', 'sophia.watson', 'motdepasse35', 17),
    ('MAT036', 'Jackson Cooper', 'jackson.cooper', 'motdepasse36', 17),
    ('MAT037', 'Ava Ross', 'ava.ross', 'motdepasse37', 17),
    ('MAT038', 'Liam Reed', 'liam.reed', 'motdepasse38', 18),
    ('MAT039', 'Emma Bailey', 'emma.bailey', 'motdepasse39', 19),
    ('MAT040', 'Oliver Fisher', 'oliver.fisher', 'motdepasse40', 19),
    ('MAT041', 'Ava Harris', 'ava.harris', 'motdepasse41', 19),
    ('MAT042', 'Lucas Turner', 'lucas.turner', 'motdepasse42', 20),
    ('MAT043', 'Chloe Mitchell', 'chloe.mitchell', 'motdepasse43', 20),
    ('MAT044', 'Emma Simmons', 'emma.simmons', 'motdepasse44', 21),
    ('MAT045', 'Oliver Murphy', 'oliver.murphy', 'motdepasse45', 21),
    ('MAT046', 'Sophia Wright', 'sophia.wright', 'motdepasse46', 2),
    ('MAT047', 'Grace Turner', 'grace.turner', 'motdepasse47', 17),
    ('MAT048', 'Daniel Foster', 'daniel.foster', 'motdepasse48', 17),
    ('MAT049', 'Natalie Young', 'natalie.young', 'motdepasse49', 21),
    ('MAT050', 'Victor Carter', 'victor.carter', 'motdepasse50', 20);
-- Insertion des associations entre les employés et les postes avec des dates d'embauche fictives
INSERT INTO postePersonnel (idPersonnel, idPoste, dateEmbauche) VALUES
    ('MAT001', 1, '2022-01-15'),
    ('MAT002', 2, '2022-02-01'),
    ('MAT003', 2, '2022-03-10'),
    ('MAT004', 2, '2022-04-05'),
    ('MAT005', 2, '2022-05-20'),
    ('MAT006', 3, '2022-06-15'),
    ('MAT007', 3, '2022-07-01'),
    ('MAT008', 4, '2022-08-10'),
    ('MAT009', 5, '2022-09-05'),
    ('MAT010', 5, '2022-10-20'),
    ('MAT011', 5, '2022-11-15'),
    ('MAT012', 5, '2022-12-01'),
    ('MAT013', 6, '2023-01-10'),
    ('MAT014', 6, '2023-02-05'),
    ('MAT015', 6, '2023-03-20'),
    ('MAT016', 7, '2023-04-15'),
    ('MAT017', 8, '2023-05-01'),
    ('MAT018', 8, '2023-06-10'),
    ('MAT019', 8, '2022-07-05'),
    ('MAT020', 9, '2022-08-20'),
    ('MAT021', 9, '2022-09-15'),
    ('MAT022', 10, '2022-10-01'),
    ('MAT023', 11, '2022-11-10'),
    ('MAT024', 11, '2022-12-05'),
    ('MAT025', 11, '2022-01-20'),
    ('MAT026', 12, '2022-02-15'),
    ('MAT027', 12, '2022-03-01'),
    ('MAT028', 13, '2022-04-10'),
    ('MAT029', 14, '2022-05-05'),
    ('MAT030', 14, '2022-06-20'),
    ('MAT031', 14, '2022-07-15'),
    ('MAT032', 15, '2022-08-01'),
    ('MAT033', 15, '2022-09-10'),
    ('MAT034', 16, '2022-10-05'),
    ('MAT035', 17, '2022-11-20'),
    ('MAT036', 17, '2022-12-15'),
    ('MAT037', 17, '2022-01-01'),
    ('MAT038', 18, '2022-02-10'),
    ('MAT039', 19, '2022-03-05'),
    ('MAT040', 19, '2022-04-20'),
    ('MAT041', 19, '2022-05-15'),
    ('MAT042', 20, '2022-06-01'),
    ('MAT043', 20, '2022-07-10'),
    ('MAT044', 21, '2022-08-05'),
    ('MAT045', 21, '2022-09-20'),
    ('MAT046', 2, '2022-10-15'),
    ('MAT047', 17, '2022-11-01'),
    ('MAT048', 17, '2022-12-10'),
    ('MAT049', 21, '2023-01-05'),
    ('MAT050', 20, '2023-02-20');

-- Insertion de chefs de service pour chaque service
INSERT INTO chef_service (idService, idposte) VALUES
    -- Chef du service Achats
    (1, 1),
    -- Chef du service Finance
    (2, 4),
    -- Chef du service Informatique
    (3, 7),
    -- Chef du service Logistique
    (4, 10),
    -- Chef du service Production industrielle
    (5, 13),
    -- Chef du service Ressources humaines
    (6, 16),
    -- Chef du service Commercial
    (7, 18);

insert into achat values(1);
insert into commercial values(7);
insert into finance values(2);