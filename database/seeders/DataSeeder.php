<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            "name" => "VTB",
            "description" => "ABABABADOAOBOA",
            "image" => "localhost/123.jpg",
            "rate" => 1.23,
        ]);

        DB::table('tags')->insert([
            "name" => "IT",
        ]);
        DB::table('tags')->insert([
            "name" => "BACKEND",
        ]);

        DB::table('company_tag')->insert([
            "company_id" => "1",
            "tag_id" => "1",
        ]);
        DB::table('company_tag')->insert([
            "company_id" => "1",
            "tag_id" => "2",
        ]);

        DB::table('events')->insert([
            "title" => "VTB habib pogib",
            "text" => "I vot habibibibibibibibi lorem ipsum doleres
            lorem ipsum doleres lorem ipsum doleres lorem ipsum
            dolereslorem ipsum doleres lorem ipsum doleres lorem
            ipsum doleres lorem ipsum doleres lorem ipsum doleres
             lorem ipsum doleres lorem ipsum doleres lorem ipsum doleres",
            "probability" => "100",
        ]);

        DB::table('event_tag')->insert([
            "event_id" => "1",
            "tag_id" => "2",
            "change" => "0.25",
        ]);
    }
}
