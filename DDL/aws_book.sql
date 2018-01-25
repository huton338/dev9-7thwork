CREATE TABLE `aws_book` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) DEFAULT NULL,
  `authors` varchar(64) DEFAULT NULL,
  `book_url` text,
  `img_url` text,
  `manufacturer` varchar(64) DEFAULT NULL,
  `releasedate` varchar(64) DEFAULT NULL,
  `memo` text,
  `datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;