<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (
            $this->command->confirm(
                'Do you want to create an admin user?',
                true
            )
        ) {
            $this->createAdmin();
        }
    }

    private function createAdmin()
    {
        $user = User::where('email', 'admin@example.com')->first();

        if ($user !== null) {
            $this->command->info('Admin user already exists.');
            return;
        }

        $admin = new User();

        $admin->name = 'Admin';
        $admin->email = 'admin@example.com';
        $admin->password = bcrypt('password');
        $admin->admin = true;

        $admin->save();

        $this->command->info('Admin user created.');

        return;
    }
}
