create or replace view v_fournisseur as 
    select * 
    from fournisseur 
    where dateSuppression is null;

create or replace view v_article as 
    select * 
    from article 
    natural join categorieArticle
    where dateSuppression is null;

create or replace view v_article_fournisseur as 
    select a.idarticle , f.idfournisseur , a.idcategoriearticle , a.nomarticle , f.emailfournisseur , f.nomfournisseur 
    from articlefournisseur as af 
        join v_fournisseur as f on af.idfournisseur = f.idfournisseur
        join v_article as a on a.idarticle = af.idarticle
    ; 
