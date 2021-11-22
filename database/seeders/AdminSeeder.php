<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
/*        User::where('username', 'shakyaprabeg')
            ->update(['is_admin' => true]);*/

        // Implementing an alternative to seed admin using factory
        User::factory()->create();
    }
}
