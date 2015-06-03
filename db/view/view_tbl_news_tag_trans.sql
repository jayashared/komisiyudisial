create or replace view view_tbl_news_tag_trans as
select		x.id_news_tag_trans, x.id_news, x.id_news_tag,
				y.id_news_category, y.date,
				y.title_id, y.title_en, y.text_id, y.text_en,
				y.picture, y.picture_caption_id, y.picture_caption_en,
				z.news_tag_id, z.news_tag_en,
				c.news_category_id, c.news_category_en
from			tbl_news_tag_trans x
left join	tbl_news y on y.id_news = x.id_news
left join	tbl_news_tag z on z.id_news_tag = x.id_news_tag
left join	tbl_news_category c on y.id_news_category = c.id_news_category