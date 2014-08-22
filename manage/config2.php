<?php
define('ROOT_PATH', dirname(__FILE__)); //设置根目录
define('DB_HOST', ''); //数据库服务器地址
define('DB_USER', '');  //数据库用户名
define('DB_PWD', '');//数据库密码
define('DB_NAME', '');  //数据库名称
define('DB_PORT', '3306');  //数据库端口



 
 
class MysqliDb { 
	private $db_host="";
	private $db_user="";
	private $db_pass="";
	private $db_name="";
    //获取对象句柄
    static public function OpenDb() {
		$_mysqli = @new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);
        if (mysqli_connect_errno()) {
                echo '数据库连接错误！错误代码 c：'.mysqli_connect_error();
                exit();
        }
        $_mysqli->set_charset('utf8');
        return $_mysqli;
    }

    //清理，释放资源
    static public function CloseDB(&$_result, &$_db) {
        if (is_object($_result)) {
                $_result->free();
                $_result = null;
        }
        if (is_object($_db)) {
                $_db->close();
                $_db = null;
        }
    }

}
?>