<?php

namespace Database\Seeders;

use App\Models\Chapter;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class ChapterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = $this->subjectList();
        $chapters = $this->chapterList();

        foreach ($subjects as $subject) {
            $subject_id = Subject::where('en_name', $subject)->value('id');

            if (! $subject_id) {
                continue;
            }

            if (array_key_exists($subject, $chapters)) {
                foreach ($chapters[$subject] as $chapter) {
                    Chapter::firstOrCreate(
                        [
                            'subject_id' => $subject_id,
                            'en_name' => $chapter['en_name']
                        ],
                        [
                            'bn_name' => $chapter['bn_name'],
                            'chapter_order' => $chapter['chapter_order']
                        ]
                    );
                }
            }
        }
    }

    protected function subjectList(): array
    {
        return [
            'Physics',
            'Chemistry',
            'Biology'
        ];
    }

    protected function chapterList(): array
    {
        return [
            'Physics' => [
                [
                    'en_name' => 'Physical World and Measurement',
                    'bn_name' => 'ভৌত জগৎ ও পরিমাপ',
                    'chapter_order' => 1,
                ],
                [
                    'en_name' => 'Vector',
                    'bn_name' => 'ভেক্টর',
                    'chapter_order' => 2,
                ],
            ],
            'Chemistry' => [
                [
                    'en_name' => 'Safe Use of Laboratory',
                    'bn_name' => 'ল্যাবরেটরির নিরাপদ ব্যবহার',
                    'chapter_order' => 1,
                ],
                [
                    'en_name' => 'Qualitative Chemistry',
                    'bn_name' => 'গুণগত রসায়ন',
                    'chapter_order' => 2,
                ],
            ],
            'Biology' => [
                [
                    'en_name' => 'Cell & its structure',
                    'bn_name' => 'কোষ ও এর গঠন',
                    'chapter_order' => 1,
                ],
                [
                    'en_name' => 'Cell Division',
                    'bn_name' => 'কোষ বিভাজন',
                    'chapter_order' => 2,
                ],
                [
                    'en_name' => 'Cell Chemistry',
                    'bn_name' => 'কোষ রসায়ন',
                    'chapter_order' => 3,
                ],
                [
                    'en_name' => 'Micro-Organism / Microbe',
                    'bn_name' => 'অণুজীব',
                    'chapter_order' => 4,
                ],
            ]
        ];
    }
}
