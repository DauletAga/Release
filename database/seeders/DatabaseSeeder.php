<?php

namespace Database\Seeders;

use App\Models\ActionType;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $action_types = collect([
            'created', 'updated', 'deleted', 'trashed', 'restored', 'active', 'inactive'
        ])->each(fn ($item) => ActionType::query()->create(['name' => $item]));

        Role::query()->create([
            'name' => 'admin',
            'is_show' => 1,
            'sort_num' => 1
        ]);

        $user = new User([
            'first_name' => 'Admin',
            'phone' => '+77770000000',
            'email' => 'admin@admin.com',
            'password' => 'Admin123',
            'role_id' => 1
        ]);
        $user->saveQuietly();
    }
}
