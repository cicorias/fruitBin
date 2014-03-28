<?php
/*
DB CLASS - abstarct logic for interactions with the DB - utilize PDO and OOP to have reusable methods (WORK IN PROGRESS)
Shane has no idea wtf he is doing, test with caution! Print statements are your friend :D
 */

class DB
{

    private function __construct()
    {
        try {
            //pulls from core init file to establish connection - make sure you have proper mysql credentials entered!
            $this->_pdo = new PDO('mysql:host='.Config::get('mysql/host').';dbname='.Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
