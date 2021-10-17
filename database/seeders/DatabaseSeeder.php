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
        // \App\Models\User::factory(10)->create();

        $categories = ['Informatica', 'Fotografia', 'Musica e Film', 'Animali', 'Sport', 'Collezionismo', 'Auto', 'Telefonia', 'Giardinaggio e Fai da Te', 'Abbigliamento'];

        foreach ($categories as $category){
            DB::table('categories')->insert([
                'name' => $category,
            ]);
        }
    }
}
