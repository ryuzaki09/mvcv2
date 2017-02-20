<?php

 return [
        "autoload" => [
                    "input" => "system\common\Input",
                    ],
        "config" => [
                    "home" => "DEFAULT",
                    ],
        "defaults" => [
                    system\mvc\View::class,
                    system\Session::class,
                    system\configs\DB::class,

                    ],
];

