<?php

use App\App;

$project_rules = [
    App::PROJECT_ID_TRAD3R => [
        //MAIN
        "login" => "auth/login",
        "logout" => "auth/logout",
        "recovery" => "auth/recovery",
        "change-password" => "auth/change-password",

        //ADMIN
        'admin/introduce'                   => 'admin/auth/login',
        'admin/logout'                      => 'admin/auth/logout',
        "admin/users"                       => "admin/user/client",
        "admin/managers"                    => "admin/user/manager",
        "admin/manager/edit/<id:\d+>"       => "admin/user/manager-edit",
        "admin/user/edit/<id:\d+>"          => "admin/user/client-edit",
    ]
];

return $project_rules[PROJECT_ID];