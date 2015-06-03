create or replace view view_news_ticker as 
select		n.id_news,
				n.date,
				n.title_id, n.title_en, n.text_id, n.text_en
from			tbl_news n
where			date(n.date) = date(now())