create or replace view tbl_user_view as
select		u.id_user, u.email,
				u.password
from			tbl_user u 