<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TableSqlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories= file_get_contents(database_path().'/seeders/categories.sql');
        $sports= file_get_contents(database_path().'/seeders/sports.sql');
        $equipments= file_get_contents(database_path().'/seeders/equipments.sql');
        $equipmentsports= file_get_contents(database_path().'/seeders/equipment_sport.sql');

        DB::Statement($categories);
        DB::Statement($sports);
        DB::Statement($equipments);
        DB::Statement($equipmentsports);
    }
}
