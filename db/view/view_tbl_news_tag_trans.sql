create or replace view view_tbl_news_tag_trans as
select		x.id_news, x.id_news_tag,
				y.title_id, y.title_en,
				z.news_tag_id, z.news_tag_en
from			tbl_news_tag_trans x
left join	tbl_news y on y.id_news = x.id_news
left join	tbl_news_tag z on z.id_news_tag = x.id_news_tag