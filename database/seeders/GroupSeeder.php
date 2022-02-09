<?php

namespace Aislandener\MixTelematicsLaravel\Database\Seeders;

use Aislandener\MixTelematicsLaravel\Facades\MixTelematics;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MixTelematics::groups()->saveInDatabase();
    }

}