<?php
// 重定向到后台登陆页面
/*header('Location:../index.php/Admin/Login/login');*/
header('Location:../index.php?m=Admin&c=Login&a=login');
exit();
