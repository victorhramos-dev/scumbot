<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TraderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('traders')->insert([
            'name' => 'B_4_Trader',
            'funds' => 10000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('traders')->insert([
            'name' => 'B_4_Mechanic',
            'funds' => 10000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('traders')->insert([
            'name' => 'B_4_Armory',
            'funds' => 10000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('traders')->insert([
            'name' => 'B_4_BoatShop',
            'funds' => 10000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('traders')->insert([
            'name' => 'B_4_Hospital',
            'funds' => 10000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('traders')->insert([
            'name' => 'Z_3_Trader',
            'funds' => 10000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('traders')->insert([
            'name' => 'Z_3_Mechanic',
            'funds' => 10000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('traders')->insert([
            'name' => 'Z_3_Armory',
            'funds' => 10000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('traders')->insert([
            'name' => 'Z_3_BoatShop',
            'funds' => 10000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('traders')->insert([
            'name' => 'Z_3_Hospital',
            'funds' => 10000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('traders')->insert([
            'name' => 'A_0_Trader',
            'funds' => 10000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('traders')->insert([
            'name' => 'A_0_Mechanic',
            'funds' => 10000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('traders')->insert([
            'name' => 'A_0_Armory',
            'funds' => 10000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('traders')->insert([
            'name' => 'A_0_BoatShop',
            'funds' => 10000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('traders')->insert([
            'name' => 'A_0_Hospital',
            'funds' => 10000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('traders')->insert([
            'name' => 'C_2_Trader',
            'funds' => 10000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('traders')->insert([
            'name' => 'C_2_Mechanic',
            'funds' => 10000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('traders')->insert([
            'name' => 'C_2_Armory',
            'funds' => 10000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('traders')->insert([
            'name' => 'C_2_BoatShop',
            'funds' => 10000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('traders')->insert([
            'name' => 'C_2_Hospital',
            'funds' => 10000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
