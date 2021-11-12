<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            'Digital Marketing',
            'Project Management',
            'Design',
            'Development',
            'QA',
            'Customer Support'
        ];

        foreach ($departments as $department)
        {
            DB::table('departments')->insert([
                'department_name' => $department
            ]);
        }
    }
}
