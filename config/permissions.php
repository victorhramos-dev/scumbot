<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Permission Groups
    |--------------------------------------------------------------------------
    |
    | Aqui fica definido os grupos de permissão que serão listados no sistema.
    |
    */
    'groups' => [
        [
            'name'        => 'Players',
            'permissions' => [
                'customer.index'   => 'Listar Players',
                'customer.create'  => 'Cadastrar Player',
                'customer.edit'    => 'Editar Player',
                'customer.destroy' => 'Deletar Player',
            ],
        ],
        [
            'name'        => 'Administradores',
            'permissions' => [
                'administrator.index'   => 'Listar Administradores',
                'administrator.create'  => 'Cadastrar Administrador',
                'administrator.edit'    => 'Editar Administrador',
                'administrator.destroy' => 'Deletar Administrador',
            ],
        ],
        [
            'name'        => 'Permissões em Geral',
            'permissions' => [
                'settings.general' => 'Editar Configurações',
            ],
        ],
    ],
];
