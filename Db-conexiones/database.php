<?php

/**
 * clase que envuelve una instancia de la clase PDO
 * para el manejo de la base de datos
 */
 require_once 'data_config.php';

 class Database
 {
    //unica instancia de la base
    private static $db=null;

    //instancia de PDO
    private static $pdo;
    final private function __construct()
    {
        try{
            //crear conexion PDO
            self::getDb();

        }catch(PDOException $e){
            //manejo de excepciones
        }
    }
    /**
     * Retorna en la unica instancia de la clase
     * @return Database|null
     */
    public static function getInstance()
    {
        if(self::$db===null){
            self::$db=new self();
        }
        return self::$db;
    }
    /**
     * crear nueva conexion PDO basada en los datos de conexion
     * @return PDO Objeto PDO
     */
    public function getDB()
    {
        if(self::$pdo==null)
        {
            self::$pdo=new PDO(
                'mysql:dbname='.DBNAME.
                ';host='.HOSTNAME.
                ';port:3306;',
                USERNAME,
                PASSWORD,
                array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8")
            );
            //Habilitar excepciones
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }
    /**
    *Evita clonacion del Objeto
    */
    final protected function __clone(){}
    function __destructor(){self::$pdo=null;}
 }
 ?>