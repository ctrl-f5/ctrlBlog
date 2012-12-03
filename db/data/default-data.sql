SET foreign_key_checks = 0;

INSERT INTO  `ctrl_auth_resource` (`id`, `resource`)VALUES
(101 , 'routes.CtrlBlog\\Controller');

INSERT INTO  `ctrl_auth_permission` (`id` , `role_id` , `resource_id` , `isAllowed`) VALUES
(NULL , '1',  '101',  '1'),
(NULL , '2',  '101',  '1');

INSERT INTO `ctrl_blog_article` (`id`, `title`, `content`, `dateCreated`) VALUES
(1, 'dsafas', 'dsadsadsadsa\r\ndsa\r\nfd\r\ngsfdg\r\nfh\r\nghdyty\r\nbg\r\nfgfdsgfdgsdf', '2012-11-15 13:00:00');

INSERT INTO `ctrl_blog_user` (`id`, `ctrlAuthUser_id`, `displayName`) VALUES
(1, 1, 'John Doe');

SET foreign_key_checks = 1;