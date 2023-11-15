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
    idCategorieArticle integer references categorieArticle(idCategorieArticle)
);
create table fournisseur (
    idFournisseur serial primary key,
    nomFournisseur varchar,
    emailFournisseur varchar
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
    idPersonnel varchar references personnel(matricule),
    idService integer references service(idService)
);
create table finance (
    idfinance integer references poste(idposte)
);
create table achat (
    idachat integer references poste(idposte)
);
create table commercial(
    idcommercial integer references poste(idposte)
);
create table besoin(
    idBesoin serial primary key, 
    idPersonnel varchar references personnel(matricule),
    dateBesoin timestamp,
    datevalidation timestamp 
);
create table detailBesoin (
    idBesoin integer references besoin(idBesoin),
    idArticle integer references article(idArticle),
    quantite numeric
);
create table demandeProforma(
    iddemande serial primary key, 
    dateDemande timestamp,
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
create table bonCommande(
    idBonCommande serial primary key, 
    iddemande integer references demandeProforma(iddemande),
    livraisonPartielle integer default 0, --1=oui, 0=non,
    idModePaiement integer references modePaiement(idModePaiement),
    dateCreation timestamp,
    dateValidationFinance timestamp,
    datevalidationAdjoint timestamp
);
create table detailsBonCommande(
    idBonCommande integer references bonCommande(idBonCommande),
    idFournisseur integer references fournisseur(idFournisseur),
    idArticle integer references article(idArticle),
    quantite numeric, 
    prixUnitaire numeric --denormalisation 
);