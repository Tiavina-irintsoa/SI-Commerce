\c postgres
drop database commercial;
create database commercial;
\c commercial

create table categorieArticle(
    idCategorieArticle serial primary key, 
    libelleCategorie varchar
);
create table article(
    idArticle serial primary key,
    nomArticle varchar,
    tva numeric, 
    idCategorieArticle integer references categorieArticle(idCategorieArticle),
    dateCreation timestamp default now(),
    dateSuppression timestamp 
);
create table fournisseur (
    idFournisseur serial primary key,
    nomFournisseur varchar,
    emailFournisseur varchar, 
    dateCreation timestamp default NOW(),
    dateSuppression timestamp 
);
create table articleFournisseur(
    idArticle integer references article(idArticle),
    idFournisseur integer references fournisseur(idFournisseur)
);
create table service (
    idService serial primary key, 
    nomService varchar,
    iconeService varchar
);
create table poste(
    idposte serial primary key, 
    nomPoste varchar,
    idService integer references service(idService)
);
create table personnel(
    matricule varchar primary key,
    nomPersonnel varchar,
    login varchar,
    motdepasse varchar,
    idposte integer references poste(idposte) --denormalisation
);
create table postePersonnel (
    idPersonnel varchar references personnel(matricule),
    idposte integer references poste(idposte),
    dateEmbauche date
);
create table chef_service(
    idPoste integer references poste(idposte),
    idService integer references service(idService)
);
create table finance (
    idfinance integer references service(idService)
);
create table achat (
    idachat integer references service(idService)
);
create table commercial(
    idcommercial integer references service(idService)
);
create table besoin(
    idBesoin serial primary key, 
    idPersonnel varchar references personnel(matricule),
    dateBesoin date,
    datevalidation timestamp , 
    dateRefus timestamp, 
    demandeProforma timestamp
);
create table detailBesoin (
    idBesoin integer references besoin(idBesoin),
    idArticle integer references article(idArticle),
    quantite numeric
);
create table demandeProforma(
    iddemande serial primary key, 
    dateDemande timestamp default now(),
    delaiLivraison date
);
create table fournisseur_proforma(
    iddemande integer references demandeProforma(iddemande),
    idFournisseur integer references fournisseur(idFournisseur),
    idArticle integer references article(idArticle)
);

create table proforma(
    idProforma serial primary key, 
    iddemande integer references demandeProforma(iddemande),
    idFournisseur integer references fournisseur(idFournisseur)  
);
create table detailsProforma(
    idProforma integer references proforma(idProforma),
    idArticle integer references article(idArticle),
    disponible numeric,
    prixUnitaire numeric
);
create table modePaiement (
    idModePaiement serial primary key,
    nomMode varchar
);
create sequence s_boncommande;
create table bonCommande(
    idBonCommande varchar primary key default 'BC-'||extract(year from NOW())||extract(month from now())||'-'||nextval('s_boncommande'), 
    iddemande integer references demandeProforma(iddemande),
    livraisonPartielle integer default 0, --1=oui, 0=non,
    idModePaiement integer references modePaiement(idModePaiement),
    dateCreation timestamp,
    dateValidationFinance timestamp,
    datevalidationAdjoint timestamp
);
create table detailsBonCommande(
    idBonCommande varchar references bonCommande(idBonCommande),
    idFournisseur integer references fournisseur(idFournisseur),
    idArticle integer references article(idArticle),
    quantite numeric, 
    prixUnitaire numeric --denormalisation 
);
create table detailsDemandeProforma(
    iddemande integer references demandeProforma(iddemande),
    idArticle integer references article(idArticle),
    quantite numeric
);
create table fournisseurDemandeProforma (
    iddemande integer references demandeProforma(iddemande),
    idArticle integer references article(idArticle),
    idFournisseur integer references fournisseur(idFournisseur)
);

-- ralph

CREATE TABLE mois (
    id_month SERIAL PRIMARY KEY,
    nom_month VARCHAR(20) NOT NULL
);

INSERT INTO mois (nom_month) VALUES
    ('Janvier'),
    ('Février'),
    ('Mars'),
    ('Avril'),
    ('Mai'),
    ('Juin'),
    ('Juillet'),
    ('Août'),
    ('Septembre'),
    ('Octobre'),
    ('Novembre'),
    ('Décembre');
