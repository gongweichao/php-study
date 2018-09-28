<?php
/**
 * Created by PhpStorm.
 * User: gwc
 * Date: 2018/9/21
 * Time: 10:27
 */

/**
 * Class PdoMysql
 */

class PdoMysql{
    //数据库配置信息
    public static $config = array();
    //数据库连接符
    public static $link = null;
    //是否开启长连接
    public static $pconnect = false;
    //保存PDOStatement 对象
    public  static $PDOStatement;
    //sql语句
    public static $queryStr = null;
    //错误
    public  static $error = null;
    /**
    * PdoMysql constructor.
    * @param string $dbConfig
    */
    public function __construct($dbConfig='')
    {
        //判断是否支持PDO
        if(!class_exists('PDO')){
            self::error('不支持PDO');
        }
        if(!is_array($dbConfig)){
            $dbConfig = array(
                'hostname'=>DB_HOST,
                'username'=>DB_USER,
                'password'=>DB_PWD,
                'database'=>DB_NAME,
                'hostport'=>DB_PORT,
                'dbms'=>DB_TYPE,
                'dsn'=>DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME
            );
        }
        if(empty($dbConfig['hostname'])) self::show_error('请配置数据库信息');
        self::$config = $dbConfig;
        if(empty(self::$config['params']))self::$config['params'] = array();
        if(!isset(self::$link))
        {
            $config = self::$config;
            if(self::$pconnect){
                //开启长连接
                $config['params'][constant('PDO::ATTR_PERSISTENT')] = true;
            }
            try
            {
             self::$link = new PDO($config['dsn'],$config['username'],$config['password'],$config['params']);
                self::$link->exec('SET NAMES'.DB_CHARSET);
            }catch (PDOException $e)
            {
                self::show_error($e->getMessage());
            }
            //设置字符集
            if(!self::$link){
                self::show_error('PDO连接错误');
                return false;
            }
            unset($config);
        }
    }

    /**
     * 获取结果集中所有数据
     * @param null $sql
     * @return mixed
     */
    public static function getAll($sql=null)
    {
        if($sql!=null){
            self::query($sql);
        }
        $result = self::$PDOStatement->fetchAll(constant("PDO::FETCH_ASSOC"));
        return $result;
    }

    public  static function getRow($sql=null)
    {
        if($sql!=null)
        {
            self::query($sql);
        }
        $result =  self::$PDOStatement->fetch(constant("PDO::FETCH_ASSOC"));
        return $result;
    }


    /**
     * 释放PDOStatement对象结果
     */
    public static function free()
    {
        self::$PDOStatement = null;
    }

    /**
     * 执行sql语句
     * @param string $sql
     * @return bool
     */
    public static function query($sql='')
    {
        $link = self::$link;
        if(!$link) return false;
        if(!empty(self::$PDOStatement)) self::free();
        self::$queryStr = $sql;
        self::$PDOStatement = $link->prepare(self::$queryStr);
        $res =  self::$PDOStatement->execute();
        //检查sql是否执行错误
        self::haveSqlError();
        return $res;

    }
    public static function haveSqlError()
    {
        $obj = empty(self::$PDOStatement)?self::$link:self::$PDOStatement;
        $arrError = $obj->errorInfo();
        if($arrError[0]!='00000')
        {
            self::$error = '数据库错误代码'.$arrError[0].'<br>sql error:'.$arrError[2].'<br>error Sql:'.self::$queryStr;
            self::show_error(self::$error);
        }
    }

    public static function show_error($errorMsg)
    {
        echo $errorMsg;
    }


}

define("DB_HOST",'localhost');
define("DB_USER",'root');
define('DB_PWD','');
define('DB_NAME','study');
define('DB_PORT','3306');
define('DB_TYPE','mysql');
define('DB_CHARSET','utf8');

$pdo = new PdoMysql();
var_dump($pdo);
$sql =  'select * from user';
$res = $pdo->getAll($sql);
var_dump($res);
