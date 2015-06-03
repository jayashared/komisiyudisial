create or replace view view_search_result as
select		n.id_news as primary_key, 'news' as table_name,
				n.title_id, n.title_en,
				n.text_id, n.text_en
from			tbl_news n
union all
select		n.id_announcement as primary_key, 'announcement' as table_name,
				n.title_id, n.title_en,
				n.text_id, n.text_en
from			tbl_announcement n
union all
select		n.id_article as primary_key, 'article' as table_name,
				n.title_id, n.title_en,
				n.text_id, n.text_en
from			tbl_article n
union all
select		n.id_agenda as primary_key, 'agenda' as table_name,
				n.title_id, n.title_en,
				n.text_id, n.text_en
from			tbl_agenda n
union all
select		n.id_video as primary_key, 'video' as table_name,
				n.title_id, n.title_en,
				n.text_id, n.text_en
from			tbl_video n