select		
				round((
					(
						select	count(*)
						from		tbl_polling_result pr
						where		pr.id_polling = p.id_polling
					) 
					/
					(
						select	count(*)
						from		tbl_polling_result
					)
				) * 100, 0) as total_semua
				, p.id_polling,
				pc.id_polling_category
from			tbl_polling p
left join	tbl_polling_category pc on pc.id_polling_category = p.id_polling_category
where 		pc.is_active = "Y"
group by		pc.id_polling_category, p.id_polling
order by		pc.id_polling_category
;