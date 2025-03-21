<?php

namespace Xyz\PruebaTecnica\Core;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{
    public static function init()
    {
        // Se carga la configuracion de la bd
        $config = require __DIR__ . '/../../config/database.php';
        $connectionConfig = $config['connections'][$config['default']];

        // Se inicia el orm
        $capsule = new Capsule;
        $capsule->addConnection($connectionConfig);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}