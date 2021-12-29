<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [ 'id' => 1, 'name' => 'Pasimetęs' ],
            [ 'id' => 2, 'name' => 'Rastas' ],
            [ 'id' => 3, 'name' => 'Pas šeimininką' ],
        ];

        DB::table('statuses')->insert($statuses);
    }
}
