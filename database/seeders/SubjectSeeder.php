<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\Department;
use App\Models\AcademicClass;
use Database\Seeders\Concerns\SeederHelper;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    use SeederHelper;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $academics = $this->getAcademicClasses();
        $departments = $this->getDepartments();
        $school = $this->getSchoolSubjectList();
        $college = $this->getCollegeSubjectList();

        foreach ($academics as $academic) {
            $academic_id = AcademicClass::where('name', $academic)->value('id');
            $subject = $academic == 'Class 09-10' ? $school : $college;

            foreach ($departments as $department) {
                $dept_id = Department::where([
                    'academic_class_id' => $academic_id,
                    'name' => $department
                ])->value('id');

                foreach ($subject[$department] as $sub) {
                    Subject::firstOrCreate(
                        ['name' => $sub],
                        ['department_id' => $dept_id]
                    );
                }
            }
        }
    }
}
