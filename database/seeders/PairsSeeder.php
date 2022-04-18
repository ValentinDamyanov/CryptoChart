<?php

namespace Database\Seeders;

use App\Models\Pair;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PairsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('pairs')->truncate();
        Schema::enableForeignKeyConstraints();

        Pair::insert([
            'name' => config('crypto.pair')
        ]);
    }
}
