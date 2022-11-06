<?php

namespace App\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Console\Migrations\MigrateCommand;
use Illuminate\Database\Console\WipeCommand;
use Symfony\Component\Console\Input\InputOption;

class SetupDbCommand extends Command
{
    /**
     * @var string
     */
    protected $name = "app:setup-db";

    /**
     * @var string
     */
    protected $description = "Run the application database setup";

    protected function getOptions(): array
    {
        return [
            [
                "drop",
                null,
                InputOption::VALUE_NONE,
                "If given, the existing database tables are dropped and recreated.",
            ],
        ];
    }

    public function handle()
    {
        $drop = $this->option("drop");
        if ($drop) {
            $this->info("Dropping all database tables...");

            $this->call(WipeCommand::class);

            $this->warn("Data deleted, starting from fresh database.");
        }

        $this->info("Running database migrations...");

        $this->call(MigrateCommand::class);

        $this->call('key:generate');
        $this->call('migrate:refresh');
        $this->call('config:clear');
        $this->call('cache:clear');
        $this->call('view:clear');
        $this->call('route:clear');
        // \App\Models\User::factory(10)->create();
        for ($i = 1; $i <= 10; $i++){
            $instance = \App\Models\Instance::create(['name' => 'instance'.$i]);

            $zone = \App\Models\Zones::create(['name' => 'az'.$i]);

            $instance->zones()->syncWithoutDetaching($zone);

            $this->info('instance ' . $i . ' added successfully');
            $this->info('availabilty zone ' . $i . ' added successfully');
        }

        foreach($instance->zones as $unavailable){
            $unavailable->instances()->updateExistingPivot($instance,["active_zone"=> false]);
        }
        
        $instance->zones()->updateExistingPivot($zone,['active_zone'=> true]);
    }
}
