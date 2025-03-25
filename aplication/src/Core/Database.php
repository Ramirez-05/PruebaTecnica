<?php

namespace Xyz\PruebaTecnica\Core;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{
    public static function init()
    {
        $config = require __DIR__ . '/../../config/database.php';
        $connectionConfig = $config['connections'][$config['default']];

        $capsule = new Capsule;
        $capsule->addConnection($connectionConfig);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
        
        $capsule::connection()->enableQueryLog();
    }
}