<?php

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Oleh Talanov',
            'email' => 'oleh@webcap.com',
            'role' => UserRoleEnum::Administrator,
        ]);

        User::factory()->create([
            'name' => 'Valentina Dmitrenko',
            'email' => 'valentina@webcap.com',
            'role' => UserRoleEnum::Administrator,
        ]);

        /*User::factory()->create()->each(function (User $user) {
            $vendor = Vendor::factory()->create();

            $user->vendors()->attach([
                $vendor->id => [
                    'role' => UserVendorRoleEnum::Owner,
                    'joined_at' => now(),
                ],
            ]);
        });*/
    }
}
