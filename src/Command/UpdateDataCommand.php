<?php

namespace Aislandener\MixTelematicsLaravel\Command;

use Aislandener\MixTelematicsLaravel\Facades\MixTelematics;
use Aislandener\MixTelematicsLaravel\Models\Driver;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateDataCommand extends Command
{

    protected $signature = "mix-telematics:populate 
                                    {--d|driver : Populate to Driver} 
                                    {--a|asset : Populate to Asset} 
                                    {--g|group : Populate to Group} 
                                    {--A|all : Populate all tables}";

    protected $description = 'Collect data in MiX Telematics and save in database';

    public function handle()
    {
        if(!(collect($this->options())->only(['all', 'driver', 'asset', 'group'])->some(true))) {
            $this->error("Need some parameter");
            return;
        }

        $this->info("Init collect data...");
        if($this->option('driver') || $this->option('all')) {
            $this->populateDriver();
        }

        if($this->option('asset') || $this->option('all')) {
            $this->populateAsset();
        }

        if($this->option('group') || $this->option('all')) {
            $this->populateGroup();
        }
        $this->info("Finish collect data...");
    }

    private function populateDriver()
    {
        $this->alert("Start populate 'Driver' table");

        MixTelematics::drivers()->updateDatabaseByOrganisation(command: $this);

        $this->info("Finish populate 'Driver' table");
    }

    private function populateAsset()
    {
        $this->alert("Start populate 'Asset' table");

        MixTelematics::assets()->getAssetByGroupId(command: $this);

        $this->info("Finish populate 'Asset' table");
    }

    private function populateGroup()
    {
        $this->alert("Start populate 'Group' table");

        MixTelematics::groups()->saveInDatabase(command: $this);

        $this->info("Finish populate 'Group' table");
    }

}