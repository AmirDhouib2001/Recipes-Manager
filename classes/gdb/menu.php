<?php

namespace gdb;
use \pdo_wrapper\PdoWrapper;
class menu extends PdoWrapper
{

    public const UPLOAD_DIR = "images/" ;
    public function __construct(){
        parent::__construct(
            $GLOBALS['db_name'],
            $GLOBALS['db_host'],
            $GLOBALS['db_port'],
            $GLOBALS['db_user'],
            $GLOBALS['db_pwd']) ;
    }

    public function getAllRecettes(){
        return $this->exec(
            "SELECT * FROM recette ORDER BY name",
            null,
            'gdb\renderer') ;
    }



}