create or replace view view_tbl_news as 
select		n.id_news, n.id_news_category, n.date,
				n.title_id, n.title_en, n.text_id, n.text_en,
				n.picture, n.picture_caption_id, n.picture_caption_en,
				n.modified_by, n.modified_date,
				nc.news_category_id, nc.news_category_en
from			tbl_news n
left join	tbl_news_category nc on nc.id_news_category = n.id_news_category