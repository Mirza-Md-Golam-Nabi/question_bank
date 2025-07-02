<?php

namespace Database\Seeders;

use App\Models\Chapter;
use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Database\Seeders\Concerns\SeederHelper;

class ChapterSeeder extends Seeder
{
    use SeederHelper;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = $this->getSchoolScienceSubjectList();
        $chapters = $this->getSchoolScienceChapterList();

        foreach ($subjects as $subject) {
            $subject_id = Subject::where('name', $subject)->value('id');

            if (! $subject_id) {
                continue;
            }

            if (array_key_exists($subject, $chapters)) {
                foreach ($chapters[$subject] as $chapter) {
                    Log::info($chapter);
                    Chapter::firstOrCreate(
                        [
                            'subject_id' => $subject_id,
                            'name' => $chapter['name']
                        ],
                        [
                            'chapter_order' => $chapter['chapter_order']
                        ]
                    );
                }
            }
        }
    }
}
