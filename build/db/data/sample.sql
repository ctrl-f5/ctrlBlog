SET foreign_key_checks = 0;

INSERT INTO `article` (`id`, `title`, `content`, `dateCreated`) VALUES
(1, 'dsafas', 'dsadsadsadsa\r\ndsa\r\nfd\r\ngsfdg\r\nfh\r\nghdyty\r\nbg\r\nfgfdsgfdgsdf', '2012-11-15 13:00:00');

INSERT INTO `blog_user` (`id`, `ctrlAuthUser_id`, `displayName`) VALUES
(1, 1, 'John Doe');

INSERT INTO `ctrl_auth_user` (`id`, `username`, `password`, `email`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'example@example.com');

INSERT INTO `ctrl_auth_role` (`id`, `name`) VALUES
(1, 'superuser'),
(1, 'guest');

INSERT INTO `ctrl_auth_user_role` (`role_id`, `user_id`) VALUES
('1', '1');

INSERT INTO  `ctrl_auth_resource` (`id`, `resource`)VALUES
(1 , 'global');

INSERT INTO  `ctrl_blog`.`ctrl_auth_permission` (`id` , `role_id` , `resource_id` , `isAllowed`) VALUES
(1 , '1',  '1',  '1');

SET foreign_key_checks = 1;