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
    select * from v_besoin_valide
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
    where dateproforma is null
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
create or replace view v_article_fournisseur as (
    select 
    v_fournisseur.nomFournisseur,v_article.idArticle, v_article.nomArticle,v_fournisseur.idFournisseur
    from v_article
    join articleFournisseur
        on articleFournisseur.idArticle = v_article.idArticle
    join v_fournisseur
        on v_fournisseur.idFournisseur = articleFournisseur.idFournisseur            
);