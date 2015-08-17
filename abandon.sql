

CREATE TABLE `users` (
  `idUser` int(11) NOT NULL auto_increment,
  `user` varchar(50) collate utf8_unicode_ci NOT NULL,
  `pass` varchar(50) collate utf8_unicode_ci NOT NULL,
  `fullname` varchar(100) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`idUser`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci

GRANT ALL PRIVILEGES ON code.* TO remote_test@'%' IDENTIFIED BY 'dientu@%123456';
GRANT ALL PRIVILEGES ON code.* TO remote_test@'localhost' IDENTIFIED BY 'dientu@%123456';
INSERT  INTO `users`(idUser,user,pass,fullname) VALUE (1,"admin","admin","Adminsitrator");
INSERT  INTO `users`(`user`,`pass`,`fullname`) VALUE ('chuong','chuong','Thien Chuong');

######################################### Update on Aug 04,2015 : 
# Go to code db, and edit table user
Alter table `code`.`users`   
  change `user` `user` varchar(100) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
  change `pass` `pass` varchar(100) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
  add column `idRole` int(11) NOT NULL after `fullname`

# and now table of user :
CREATE TABLE `users` (
  `idUser` int(11) NOT NULL auto_increment,
  `user` varchar(100) collate utf8_unicode_ci NOT NULL,
  `pass` varchar(100) collate utf8_unicode_ci NOT NULL,
  `fullname` varchar(100) collate utf8_unicode_ci NOT NULL,
  `idRole` int(11) NOT NULL,
  PRIMARY KEY  (`idUser`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci

# create table roles , with 1 is admin, 2 is users
CREATE TABLE `roles` (
  `idRole` int(11) NOT NULL auto_increment,
  `nameRole` varchar(50) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`idRole`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci

INSERT INTO `code`.`roles` (`nameRole`) VALUE ('admin');
INSERT INTO `code`.`roles`(`nameRole`) VALUE ('user');

# create navtab_menu
CREATE TABLE `navtab_menu` (
  `idMenu` int(11) NOT NULL auto_increment,
  `inPage` varchar(100) collate utf8_unicode_ci NOT NULL,
  `href` varchar(100) collate utf8_unicode_ci NOT NULL,
  `id` varchar(100) collate utf8_unicode_ci NOT NULL,
  `title` varchar(100) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`idMenu`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `navtab_menu`(`inPage`,`href`,`id`,`title`) VALUE ("mjn_abandon_settings.php","abandon_settings_manageUsers.php","nav_manageUsers","Manage Users");

# create roles_navtab to link roles table and navtab_menu that help we know what permission admin will have
# noted: with link table, it will not need primary key and auto_increment
CREATE TABLE `roles_navtab` (
  `idRole` int(11) NOT NULL,
  `idMenu` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

   # with idRole 1 is admin, it will have menu is 1, 2 or 3 on navtab_menu table
INSERT INTO `code`.`roles_navtab`(`idRole`,`idMenu`) VALUE (1,1);



# Aug 05, 2015 , insert nhinguyen to users AND query navtab_menu.* from idUser to get all navtab that user have
INSERT INTO `code`.`users`(`user`,`pass`,`fullname`,`idRole`) VALUE ("nhinguyen","123456","Nguyễn Ngọc Yến Nhi",2);

SELECT   navtab_menu.* 
FROM   users
INNER JOIN roles_navtab ON users.idRole = roles_navtab.idRole
INNER JOIN navtab_menu ON roles_navtab.idMenu = navtab_menu.idMenu
WHERE   idUser='1'


# Aug07, 2015, create two table : navbar_menu and user_has_navbar to query navbar that user have.
# it's differece with navtab_menu because user will have role id, group id will have navtab
# with navtab : isUser -> idRole -> idNavtab
# with navbar : idUser -> idNavbar (n <-> n)

CREATE TABLE `navbar_menu` (
  `idNavbar` int(11) NOT NULL auto_increment,
  `href` varchar(100) collate utf8_unicode_ci NOT NULL,
  `title` varchar(100) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`idNavbar`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `user_has_navbar` (
  `idUser` int(11) NOT NULL,
  `idNavbar` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `code`.`navbar_menu`(`idNavbar`,`href`,`title`) VALUE (1,"mjn_abandon.php","Abandon");
INSERT INTO `code`.`user_has_navbar`(`idUser`,`id`) VALUE (1,1);
INSERT INTO `code`.`user_has_navbar`(`idUser`,`id`) VALUE (1,2);