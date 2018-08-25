<?php
include ('interface.php');
    class MySql {
        static private $instance;
        static private $db = NULL;

        function __construct() {    }
        function __clone() {    }
        function __wakeup() {   }

        static function i() {
            if(is_null(self::$instance)) {
                self::$instance = new MySql();

                try {
                    self::$db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=UTF8',
                                DB_USER, DB_PASSWORD);

                    self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch(PDOException $error) {
                    $this->error($error);
                }
            }

            return self::$instance;
        }

        function error($error) {
            file_put_contents('logs/mysql.log', $error->getMessage() . "\n", FILE_APPEND);

            //header('HTTP/1.1 500 Internal server error');
           // header('Status: 500 Internal server error');
            error('<b>Етить колотить!</b>
			<br>
			Где огурцы — там и хуйцы. 
			<br>
			База данных сайта приказала долго жить.
			<br>Херово, но не очень. Скоро всё будет збс.');
        }

        function query() {
            $args = func_get_args();
            if(empty($args))
                return;

            try {
                $request = self::$db->prepare($args[0]);
                $request->setFetchMode(PDO::FETCH_ASSOC);

                if(sizeof($args) > 1) {
                    $args = array_splice($args, 1);
                    $request->execute($args);
                } else
                    $request->execute();
            } catch(PDOException $error) {
                $this->error($error);
            }

            return $request;
        }
    }
