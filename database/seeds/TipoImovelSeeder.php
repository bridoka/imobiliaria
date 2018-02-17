<?php

use Illuminate\Database\Seeder;

class TipoImovelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipoimovel')->insert(
            ['tipo' => "Casa"]
            );
        DB::table('tipoimovel')->insert(
            ['tipo' => "Apartamento"]
        );
    }
}
