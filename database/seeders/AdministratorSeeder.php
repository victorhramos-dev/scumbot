<?php

namespace Database\Seeders;

use App\Models\System\Management\Administrator;

use Artesaos\Defender\Facades\Defender;

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleSuperUser = Defender::createRole('superuser');

        $administrator = Administrator::create([
            'name'     => 'Administrador do Sistema',
            'email'    => 'admin@admin.com',
            'password' => bcrypt('admin'),
        ]);

        $administrator->attachRole($roleSuperUser);
    }
}
