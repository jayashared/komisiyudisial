create or replace view view_tbl_sitemap as
select		s.id_sitemap, s.sitemap_code, s.id_parent, s.name,
				s.description, s.title_id, s.title_en, s.url,
				s.css_class, s.css_id, s.icon, s.sort_no, s.modified_by,
				s.modified_date, s.external_link,
				round((length(replace(s.sitemap_code,'.','')) / 2),0) AS sitemap_level,
				concat(s.sitemap_code, ' - ', s.description) as parent
from			tbl_sitemap s 
;

create or replace view view_tbl_publication as 
select		year(p.publication_date) as publication_year,
				p.id_publication, p.id_publication_category, p.publication_date, p.expired_date, 
				p.title_id, p.title_en, p.text_id, p.text_en, p.cover,
				p.`file`, p.modified_by, p.modified_date, pc.name, 
				pc.title_id as category_id,
				pc.title_en as category_en
from			tbl_publication p
left join	tbl_publication_category pc on p.id_publication_category = pc.id_publication_category
;

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
;

create or replace view view_tbl_news as 
select		n.id_news, n.id_news_category, n.date,
				n.title_id, n.title_en, n.text_id, n.text_en,
				n.picture, n.picture_caption_id, n.picture_caption_en,
				n.modified_by, n.modified_date,
				nc.news_category_id, nc.news_category_en
from			tbl_news n
left join	tbl_news_category nc on nc.id_news_category = n.id_news_category
;

create OR REPLACE view view_tbl_laws as
select		l.id_laws, l.id_laws_category, l.laws_id, l.laws_en,
				l.files, l.modified_by, l.modified_date,
				lc.laws_category_id, lc.laws_category_en
from			tbl_laws l
left join	tbl_laws_category lc on lc.id_laws_category = l.id_laws_category
;

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
;

create or replace view view_publication_year as 
select 	p.name, year(p.publication_date) as publication_year
from		view_tbl_publication p
group by	p.name, year(p.publication_date)
;

create or replace view view_news_ticker as 
select		n.id_news,
				n.date,
				n.title_id, n.title_en, n.text_id, n.text_en
from			tbl_news n
where			date(n.date) = date(now())
;

create or replace view tbl_user_view as
select		u.id_user, u.email,
				u.password
from			tbl_user u 
;
