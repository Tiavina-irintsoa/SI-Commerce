create or replace view v_chef_service as(
    select 
    personnel.matricule,chef_service .idService,poste.nomPoste,poste.idposte
    from chef_service
    join poste
        on poste.idposte = chef_service.idposte
    join personnel
        on personnel.idposte = poste.idposte
);

create or replace view v_service_poste_personnel as(
    select 
    personnel.matricule,poste.idposte,service.idservice
    from personnel
    join poste 
        on poste.idposte = personnel.idposte
    join service
        on service.idService = poste.idservice
);

create or replace view v_article as(
    select 
    * 
    from article
    where datesuppression is null
);

create or replace view v_besoin_valide as(
    select
    *
    from besoin 
    where datevalidation is not null
);
create or replace view v_besoin_non_consulte as(
    select 
    * 
    from besoin
    where dateValidation is null and dateRefus is null
);
create or replace view v_besoin_semaine as (
    select * from v_besoin_non_consulte
    where extract(week from dateBesoin)  = extract(week from now()) and extract(year from dateBesoin) = extract (year from now())
);
create or replace view v_besoin_semaine_avant_non_consulte as(
    select * from v_besoin_non_consulte
    where extract(week from dateBesoin)  = extract(week from now()) and extract(year from dateBesoin) = extract (year from now())
);
create or replace view v_besoin_valide_sans_proforma as(
    select 
    * 
    from v_besoin_valide
    where demandeProforma is null
);
create or replace view v_besoin_par_nature as 
    select
    sum(detailBesoin.quantite) as quantite,v_article.nomArticle,detailBesoin.idArticle
    from
    detailBesoin
    join v_besoin_valide_sans_proforma
        on v_besoin_valide_sans_proforma.idBesoin = detailBesoin.idBesoin
    join v_article
        on v_article.idArticle = detailBesoin.idArticle
    group by detailBesoin.idArticle,v_article.nomArticle;

create or replace view v_fournisseur as(
    select 
    * 
    from fournisseur
    where datesuppression is null
);


-- ralph
create or replace view v_article_categorie as 
    select * 
    from v_article 
    natural join categorieArticle;

create or replace view v_article_categorie as 
    select * 
    from v_article 
    natural join categorieArticle;

create or replace view v_article_fournisseur as 
    select a.idarticle , f.idfournisseur , a.idcategoriearticle , a.nomarticle , f.emailfournisseur , f.nomfournisseur 
    from articlefournisseur as af 
        join v_fournisseur as f on af.idfournisseur = f.idfournisseur
        join v_article_categorie as a on a.idarticle = af.idarticle
    ; 

create or replace view v_besoin_semaine_personnel_poste as 
    select idbesoin , bs.idpersonnel , datebesoin , datevalidation , daterefus , demandeproforma , nompersonnel  ,     login      ,  motdepasse  , p.idposte  ,    nomposte   , idservice 
    from v_besoin_semaine as bs 
        join personnel as p 
        on p.matricule = bs.idPersonnel
        join poste as po 
        on po.idposte = p.idposte
    ;

create or replace view v_detailbesoin_group as  
    select idbesoin , idarticle , sum(quantite) as quantite
    from detailbesoin as d 
    group by idarticle , idbesoin;

create or replace view v_article_detailbesoin as  
    select *
    from v_detailbesoin_group as d 
        natural join article as a; 

create or replace view v_besoin_semaine_personnel_poste_all as 
    select idbesoin , bs.idpersonnel , datebesoin , datevalidation , daterefus , demandeproforma , nompersonnel  ,     login      ,  motdepasse  , p.idposte  ,    nomposte   , idservice 
    from v_besoin_non_consulte as bs 
        join personnel as p 
        on p.matricule = bs.idPersonnel
        join poste as po 
        on po.idposte = p.idposte
    ;

create or replace view v_besoin_valide_semaine as 
    select * from v_besoin_valide
    where extract(week from dateBesoin)  = extract(week from now()) and extract(year from dateBesoin) = extract (year from now())
;


create or replace view v_besoin_valide_semaine_personnel_poste_all as 
    select idbesoin , bs.idpersonnel , datebesoin , datevalidation , daterefus , demandeproforma , nompersonnel  ,     login      ,  motdepasse  , p.idposte  ,    nomposte   , idservice 
    from v_besoin_valide_semaine as bs 
        join personnel as p 
        on p.matricule = bs.idPersonnel
        join poste as po 
        on po.idposte = p.idposte
;

create or replace view v_besoin_valide_personnel_poste_all as 
    select idbesoin , bs.idpersonnel , datebesoin , datevalidation , daterefus , demandeproforma , nompersonnel  ,     login      ,  motdepasse  , p.idposte  ,    nomposte   , idservice 
    from v_besoin_valide as bs 
        join personnel as p 
        on p.matricule = bs.idPersonnel
        join poste as po 
        on po.idposte = p.idposte
;

create or replace  view v_demande_proforma_fournisseur as 
    select iddemande , idfournisseur
    from fournisseurdemandeproforma  
    group by iddemande , idfournisseur;


create or replace  view v_demande_proforma_fournisseur_nom as 
    select *
    from v_demande_proforma_fournisseur
        natural join fournisseur
        natural join demandeProforma;

create or replace  view v_demande_proforma_fournisseur_groub_article as   
    select f.iddemande , f.idfournisseur , f.idarticle , sum(quantite) as quantite
    from fournisseurdemandeproforma as f 
        natural join detailsdemandeproforma  as d 
    group by f.iddemande , f.idfournisseur , f.idarticle ;

create or replace  view v_demande_proforma_fournisseur_article as   
    select *  
    from v_demande_proforma_fournisseur_groub_article as f
        natural join article;