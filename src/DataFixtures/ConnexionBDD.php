<?php

namespace App\DataFixtures;

use PDO;
use PDOException;

/** Classe ConnexionBdd */
class ConnexionBdd
{
    private static $cnx;

    // Singleton to connect db.
    private static $instance = null;

    // The db connection is established in the private constructor.
    private function __construct()
    {
        $host = 'ec2-34-242-8-97.eu-west-1.compute.amazonaws.com';
        $db = 'dd10rejoq6phvu';
        $user = 'kgqphlyfdjgcxc';
        $pass = '86d22f4042bd343d264a3a5df8c88f90f1c21bd369ed48c67997ebc9659adc82';
        $charset = 'utf8';

        $dsn = "postgres://kgqphlyfdjgcxc:86d22f4042bd343d264a3a5df8c88f90f1c21bd369ed48c67997ebc9659adc82@ec2-34-242-8-97.eu-west-1.compute.amazonaws.com:5432/dd10rejoq6phvu";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            self::$cnx = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            //throw new PDOException($e->getMessage(), (int)$e->getCode());
            echo 'erreur connexion';
        }
    }

    public static function getConnexion()
    {
        if (!self::$instance) {
            self::$instance = new ConnexionBdd();
        }

        return self::$cnx;
    }
}
