<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\ClassCategory;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // First, ensure we have class categories
        $categories = [
            ['name' => 'Primary', 'abbreviation' => 'PRI'],
            ['name' => 'Junior Secondary', 'abbreviation' => 'JSS'],
            ['name' => 'Senior Secondary', 'abbreviation' => 'SSS'],
        ];

        foreach ($categories as $category) {
            ClassCategory::firstOrCreate(
                ['abbreviation' => $category['abbreviation']],
                $category
            );
        }

        // Get category IDs
        $primaryCategory = ClassCategory::where('abbreviation', 'PRI')->first();
        $jssCategory = ClassCategory::where('abbreviation', 'JSS')->first();
        $sssCategory = ClassCategory::where('abbreviation', 'SSS')->first();

        // Get existing teachers
        $teachers = Teacher::all();
        $teacherIds = $teachers->pluck('id')->toArray();

        $classrooms = [
            // Primary Classes
            ['name' => 'Primary 1A', 'category_id' => $primaryCategory->id, 'teacher_id' => $teacherIds[0] ?? null],
            ['name' => 'Primary 1B', 'category_id' => $primaryCategory->id, 'teacher_id' => $teacherIds[1] ?? null],
            ['name' => 'Primary 2A', 'category_id' => $primaryCategory->id, 'teacher_id' => $teacherIds[2] ?? null],
            ['name' => 'Primary 2B', 'category_id' => $primaryCategory->id, 'teacher_id' => $teacherIds[3] ?? null],
            ['name' => 'Primary 3A', 'category_id' => $primaryCategory->id, 'teacher_id' => $teacherIds[0] ?? null],
            ['name' => 'Primary 3B', 'category_id' => $primaryCategory->id, 'teacher_id' => $teacherIds[1] ?? null],
            ['name' => 'Primary 4A', 'category_id' => $primaryCategory->id, 'teacher_id' => $teacherIds[2] ?? null],
            ['name' => 'Primary 5A', 'category_id' => $primaryCategory->id, 'teacher_id' => $teacherIds[3] ?? null],
            ['name' => 'Primary 6A', 'category_id' => $primaryCategory->id, 'teacher_id' => $teacherIds[0] ?? null],

            // Junior Secondary Classes
            ['name' => 'JSS 1A', 'category_id' => $jssCategory->id, 'teacher_id' => $teacherIds[1] ?? null],
            ['name' => 'JSS 1B', 'category_id' => $jssCategory->id, 'teacher_id' => $teacherIds[2] ?? null],
            ['name' => 'JSS 2A', 'category_id' => $jssCategory->id, 'teacher_id' => $teacherIds[3] ?? null],
            ['name' => 'JSS 2B', 'category_id' => $jssCategory->id, 'teacher_id' => null],
            ['name' => 'JSS 3A', 'category_id' => $jssCategory->id, 'teacher_id' => null],
            ['name' => 'JSS 3B', 'category_id' => $jssCategory->id, 'teacher_id' => null],

            // Senior Secondary Classes (without teachers for now)
            ['name' => 'SSS 1 Science', 'category_id' => $sssCategory->id],
            ['name' => 'SSS 1 Arts', 'category_id' => $sssCategory->id],
            ['name' => 'SSS 1 Commercial', 'category_id' => $sssCategory->id],
            ['name' => 'SSS 2 Science', 'category_id' => $sssCategory->id],
            ['name' => 'SSS 2 Arts', 'category_id' => $sssCategory->id],
            ['name' => 'SSS 2 Commercial', 'category_id' => $sssCategory->id],
            ['name' => 'SSS 3 Science', 'category_id' => $sssCategory->id],
            ['name' => 'SSS 3 Arts', 'category_id' => $sssCategory->id],
            ['name' => 'SSS 3 Commercial', 'category_id' => $sssCategory->id],
        ];

        foreach ($classrooms as $classroom) {
            // Only include teacher_id if it's set and not null
            $classroomData = [
                'name' => $classroom['name'],
                'category_id' => $classroom['category_id'],
            ];
            
            if (isset($classroom['teacher_id']) && $classroom['teacher_id'] !== null) {
                $classroomData['teacher_id'] = $classroom['teacher_id'];
            }
            
            Classroom::firstOrCreate(
                ['name' => $classroom['name']],
                $classroomData
            );
        }

        $this->command->info('Classrooms seeded successfully!');
    }
}