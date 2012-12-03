SET foreign_key_checks = 0;

INSERT INTO  `ctrl_auth_resource` (`id`, `resource`)VALUES
(101 , 'routes.CtrlBlog\\Controller');

INSERT INTO  `ctrl_auth_permission` (`id` , `role_id` , `resource_id` , `isAllowed`) VALUES
(NULL , '1',  '101',  '1'),
(NULL , '2',  '101',  '1');

INSERT INTO `ctrl_blog_article` (`id`, `title`, `content`, `dateCreated`) VALUES
(1, 'dsafas', 'Lorem ipsum dolor sit amet, \r\n===\r\nconsectetur adipiscing elit. Pellentesque ac mi eros, sodales euismod tortor. Vivamus venenatis quam eget augue vulputate posuere. Aenean pharetra porttitor eros, vitae ultricies nibh fermentum rhoncus. In magna nisl, imperdiet a adipiscing et, hendrerit ut justo. Praesent aliquet molestie sapien, eu volutpat purus viverra pellentesque. Vivamus vitae eros vel nunc ornare scelerisque. \r\n\r\n    <?php \r\n    echo ''test'';\r\n    ?>\r\n\r\n> Nam ac leo mauris, sed lobortis nisi. Aliquam venenatis hendrerit augue rhoncus tempor. Sed tempor aliquet risus nec tincidunt. Aliquam placerat rhoncus nulla. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. \r\n\r\nSed non risus sapien. Nulla pharetra est euismod libero vestibulum adipiscing. Donec cursus tristique tincidunt.\r\n\r\n* Duis euismod cursus nisl sit amet sodales. \r\n* Phasellus vehicula leo sit amet eros vehicula semper. \r\n* Maecenas dignissim erat quis diam convallis sollicitudin imperdiet libero laoreet. \r\n\r\nEtiam pulvinar consectetur leo nec volutpat. Donec convallis ullamcorper pellentesque. Maecenas eleifend egestas ipsum, non fermentum ligula vehicula varius. Proin luctus libero in lacus vehicula semper. Donec vel libero mi. Donec diam erat, rutrum ut ultrices non, elementum in turpis. \r\n\r\n1. Quisque lobortis dapibus volutpat. \r\n2. Suspendisse at felis diam. \r\n3. Duis venenatis porttitor velit, id bibendum sapien pellentesque non. \r\n\r\nNulla nec venenatis metus. In nec metus sit amet magna condimentum laoreet et ac mi. Curabitur molestie erat at augue euismod quis sollicitudin justo ultricies. Cras fermentum, nisi quis tincidunt ultricies, mauris sem ultricies libero, vel tincidunt velit enim in lorem. \r\n\r\nHere''s some example code:\r\n \r\n    return shell_exec("echo $input | $markdown_script");', '2012-12-03 00:28:40');

INSERT INTO `ctrl_blog_user` (`id`, `ctrlAuthUser_id`, `displayName`) VALUES
(1, 1, 'John Doe');

SET foreign_key_checks = 1;