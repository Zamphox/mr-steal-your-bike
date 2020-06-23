<?php

use Illuminate\Database\Seeder;

class OfficerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Officer::class, 30)->create()->each(function ($officer) {
            $officer->save();
        });
    }
}
