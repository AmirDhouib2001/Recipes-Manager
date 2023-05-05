<?php

namespace gdb;

use \pdo_wrapper\PdoWrapper ;
class RecetteDB extends PdoWrapper
{


    const UPLOID_DIR = "images";

    public function __construct()
    {
        parent::__construct(
            $GLOBALS['db_name'],
            $GLOBALS['db_host'],
            $GLOBALS['db_port'],
            $GLOBALS['db_user'],
            $GLOBALS['db_pwd']);
    }

    public function createRecette($name, $description=null, $Imgsrc=null){

        $name = htmlspecialchars($name) ;
        $description = htmlspecialchars($description);

        $imgName = null ;
        if($Imgsrc != null){
            $tmpName = $Imgsrc['tmp_name'];
            $imgName = $Imgsrc['name'];
            $imgName = urlencode(htmlspecialchars($imgName));
            $dirname = $GLOBALS['PHP_DIR'].self::UPLOID_DIR ;
            if(!is_dir($dirname)) mkdir($dirname) ;
            $uploaded = move_uploaded_file($tmpName, $dirname.$imgName) ;
            if (!$uploaded) die("FILE NOT UPLOADED") ;
        }else echo "NO IMAGE !!!!" ;

        $query = 'INSERT INTO games(name, description, Imgsrc) VALUES (:name, :description, :image)';
        $params=[
            'name' => htmlspecialchars($name),
            'description' => htmlspecialchars($description),
            'image' => $imgName
        ] ;
        return $this->exec($query, $params) ;
    }



}