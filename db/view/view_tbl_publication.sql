create or replace view view_tbl_publication as 
select		year(p.publication_date) as publication_year,
				p.id_publication, p.id_publication_category, p.publication_date, p.expired_date, 
				p.title_id, p.title_en, p.text_id, p.text_en, p.cover,
				p.`file`, p.modified_by, p.modified_date, pc.name, 
				pc.title_id as category_id,
				pc.title_en as category_en
from			tbl_publication p
left join	tbl_publication_category pc on p.id_publication_category = pc.id_publication_category
