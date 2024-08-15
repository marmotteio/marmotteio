<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\HardwareStatus;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Tenant;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Tenant::find('default')?->delete();

        \DB::statement('DROP DATABASE IF EXISTS `tenant_default`;');

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
