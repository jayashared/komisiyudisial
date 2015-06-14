create OR REPLACE view view_tbl_laws as
select		l.id_laws, l.id_laws_category, l.laws_id, l.laws_en,
				l.files, l.modified_by, l.modified_date,
				lc.laws_category_id, lc.laws_category_en
from			tbl_laws l
left join	tbl_laws_category lc on lc.id_laws_category = l.id_laws_category