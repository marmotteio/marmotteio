<?php

namespace App\Console\Commands;

use App\Models\HardwareStatus;
use App\Models\Team;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateDefaultTenantCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-default-tenant-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tenant = Tenant::where('id', 'default')->first();

        if ($tenant) {
            return;
        }

        $tenant = Tenant::create(['id' => 'default']);
        $tenant->domains()->create(['domain' => '127.0.0.1']);
        $tenant->run(function () {
            $team = Team::create([
                'name' => 'Team 1',
            ]);

            if (! User::exists()) {
                $user = User::create([
                    'name' => 'Admin',
                    'email' => 'admin@marmotte.io',
                    'password' => Hash::make('marmotte.io'),
                ]);

                $team->users()->attach($user);
            }

            $hardwareStatusesNames = [
                'Deployed',
                'In Stock',
                'In Repair',
                'Retired',
                'Lost/Stolen',
            ];

            foreach ($hardwareStatusesNames as $statusName) {
                HardwareStatus::create(['team_id' => $team->id, 'name' => $statusName]);
            }
        });
    }
}
