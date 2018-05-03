create or replace view view_gallery as
select 		x.id_gallery, x.id_gallery_category,
				x.picture, x.title_id, x.title_en, x.text_id, x.text_en,
				x.modified_date, x.modified_by,
				y.gallery_category_id, y.gallery_category_en
from			tbl_gallery x
left join	tbl_gallery_category y on y.id_gallery_category = x.id_gallery_category