<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReferenceValeurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // run a sql file
        $sql = file_get_contents(database_path('sql/reference_valeurs.sql'));
        $sql = str_replace('','', $sql);
        DB::unprepared($sql);        
    }
}
