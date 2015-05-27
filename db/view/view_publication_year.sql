create or replace view view_publication_year as 
select 	p.name, year(p.publication_date) as publication_year
from		view_tbl_publication p
group by	p.name, year(p.publication_date)
;
