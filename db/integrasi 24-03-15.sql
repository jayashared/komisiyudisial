-- alter table
ALTER TABLE tbl_news ADD
(
	COUNT INT(10) NOT NULL DEFAULT 0
)
;

alter table tbl_gallery add ( 
	 id_gallery_category int(10)
);

update tbl_gallery set id_gallery_category = 1;

CREATE TABLE IF NOT EXISTS `tbl_gallery_category` (
 `id_gallery_category` INT(11) NOT NULL AUTO_INCREMENT,
 `gallery_category_id` VARCHAR(255) NOT NULL,
 `gallery_category_en` VARCHAR(255) NOT NULL,
 `modified_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON
UPDATE CURRENT_TIMESTAMP, PRIMARY KEY (`id_gallery_category`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;


INSERT INTO `tbl_gallery_category` (`id_gallery_category`, `gallery_category_id`, `gallery_category_en`, `modified_date`) VALUES
	(1, 'KY', 'KY', '2016-03-21 15:05:18'),
	(2, 'Kegiatan Tahunan', 'Yearly Activities', '2016-03-22 21:56:26'),
	(3, 'Liburan', 'Holliday', '2016-03-22 21:56:44');



