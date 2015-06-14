create or replace view view_tbl_sitemap as
select		s.id_sitemap, s.sitemap_code, s.id_parent, s.name,
				s.description, s.title_id, s.title_en, s.url,
				s.css_class, s.css_id, s.icon, s.sort_no, s.modified_by,
				s.modified_date,
				round((length(replace(s.sitemap_code,'.','')) / 2),0) AS sitemap_level,
				concat(s.sitemap_code, ' - ', s.description) as parent
from			tbl_sitemap s 