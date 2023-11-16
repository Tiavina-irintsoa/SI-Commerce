create or replace view v_fournisseur as 
    select * from fournisseur 
    where dateSuppression is null;

create or replace view v_article as 
    select * from article 
    natural join categorieArticle
    where dateSuppression is null;