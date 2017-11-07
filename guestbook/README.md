# PHP留言本 #
基于windows7，mysql5.7，nginx1.8，php5.6的php应用，实现的功能有:

- 用户匿名发留言、查看留言
- 管理员回复留言、删除(锁定)留言

数据库名guestbook

主要页面有：

- [guestbook.sql](https://github.com/Memory9527/project/blob/master/%E7%95%99%E8%A8%80%E6%9C%AC/guestbook.sql) 创建留言表的sql语句。
- [user.sql](https://github.com/Memory9527/project/blob/master/%E7%95%99%E8%A8%80%E6%9C%AC/user.sql) 用户表的创建语句，这个表只有一个管理员用户。
- [index.php](https://github.com/Memory9527/project/blob/master/guestbook/index.php) 分页展示部分最新留言，并提供发布表单
- [post.php]() 留言发布页
- [admin/index.html](https://github.com/Memory9527/project/blob/master/guestbook/admin/index.html) 管理员登录页
- [admin/login.php](https://github.com/Memory9527/project/blob/master/guestbook/admin/login.php) 管理员登录验证页
- [admin/reply.php](https://github.com/Memory9527/project/blob/master/guestbook/admin/reply.php) 留言回复页
- [admin/lock.php](https://github.com/Memory9527/project/blob/master/guestbook/admin/lock.php) 留言锁定(删除)页
- [config.php](https://github.com/Memory9527/project/blob/master/guestbook/config.php)全局配置文件，例如存数据库链接信息，每页显示多少条留言等。
- [mysql.class.php](https://github.com/Memory9527/project/blob/master/guestbook/mysql.class.php)数据库(mysql)工具方法文件



