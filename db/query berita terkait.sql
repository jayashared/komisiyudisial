select	*
from		tbl_news z
where		z.id_news in
(
			select	y.id_news
			from		tbl_news_tag_trans y
			where		y.id_news_tag in
			(
						select	x.id_news_tag
						from		tbl_news_tag_trans x
						where		x.id_news = 8
			)
) and		z.id_news != 8

;