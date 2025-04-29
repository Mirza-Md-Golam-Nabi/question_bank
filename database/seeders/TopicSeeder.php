<?php

namespace Database\Seeders;

use App\Models\Topic;
use App\Models\Chapter;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = $this->subjectList();
        $topics = $this->topicList();

        foreach ($subjects as $subject) {
            $subject_id = Subject::where('en_name', $subject)->value('id');

            if (! $subject_id) {
                continue;
            }

            if (array_key_exists($subject, $topics)) {
                $chapter_list = array_keys($topics[$subject]);
                foreach ($chapter_list as $chapter) {
                    $chapter_id = Chapter::where('en_name', $chapter)->value('id');
                    foreach ($topics[$subject][$chapter] as $topic) {
                        Topic::firstOrCreate(
                            [
                                'chapter_id' => $chapter_id,
                                'en_name' => $topic['en_name']
                            ],
                            [
                                'bn_name' => $topic['bn_name'],
                                'topic_order' => $topic['topic_order']
                            ]
                        );
                    }
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

    protected function topicList(): array
    {
        return [
            'Physics' => [
                'Physical World and Measurement' => [
                    [
                        'en_name' => 'Concepts of Science and Physics, Applications and Stages of Discovery',
                        'bn_name' => 'বিজ্ঞান ও পদার্থবিজ্ঞানের ধারণা প্রয়োগ ও আবিষ্কারের ধাপসমূহ',
                        'topic_order' => 1,
                    ],
                    [
                        'en_name' => 'Important quantities in physics, their symbols and values',
                        'bn_name' => 'পদার্থবিজ্ঞানের গুরুত্বপূর্ণ রাশিসমূহ, তাদের প্রতীক এবং মানসমূহ',
                        'topic_order' => 2,
                    ]
                ],
                'Vector' => [
                    [
                        'en_name' => 'Concept of vector quantities, characteristics and important formulas',
                        'bn_name' => 'ভেক্টর রাশির ধারণা, বৈশিষ্ট্য এবং গুরুত্বপূর্ণ সূত্রসমূহ',
                        'topic_order' => 1,
                    ],
                    [
                        'en_name' => 'Types of vectors',
                        'bn_name' => 'ভেক্টরের প্রকারভেদ',
                        'topic_order' => 2,
                    ]
                ],
            ],
            'Chemistry' => [
                'Qualitative Chemistry' => [
                    [
                        'en_name' => 'Atomic Theory and Models of the Atom',
                        'bn_name' => 'পারমাণবিক মতবাদ ও পরমাণুর মডেলসমূহ',
                        'topic_order' => 1,
                    ],
                    [
                        'en_name' => 'Quantum numbers',
                        'bn_name' => 'কোয়ান্টাম সংখ্যা',
                        'topic_order' => 2,
                    ]
                ],
                'Periodic Properties of Elements and Chemical Bond' => [
                    [
                        'en_name' => 'Elements of different blocks and their general properties',
                        'bn_name' => 'বিভিন্ন ব্লকের মৌল ও তার সাধারণ ধর্মাবলী',
                        'topic_order' => 1,
                    ],
                    [
                        'en_name' => 'Atomic number, Group and Period related information',
                        'bn_name' => 'পারমাণবিক সংখ্যা, গ্রুপ ও পর্যায় সম্পর্কিত তথ্যাবলী',
                        'topic_order' => 2,
                    ]
                ],
            ],
            'Biology' => [
                'Cell & its structure' => [
                    [
                        'en_name' => 'Cell Wall',
                        'bn_name' => 'কোষ প্রাচীর',
                        'topic_order' => 1,
                    ],
                    [
                        'en_name' => 'Plasmamembrane or Cell membrane',
                        'bn_name' => 'প্লাজমামেমব্রেন বা কোষঝিল্লি',
                        'topic_order' => 2,
                    ],
                    [
                        'en_name' => 'Cytoplasm and Organelles',
                        'bn_name' => 'সাইটোপ্লাজম ও অঙ্গাণু',
                        'topic_order' => 3,
                    ],
                ],
                'Cell Division' => [
                    [
                        'en_name' => 'Amitosis or Direct Cell Division',
                        'bn_name' => 'অ্যামাইটোসিস বা প্রত্যক্ষ কোষ বিভাজন',
                        'topic_order' => 1,
                    ],
                    [
                        'en_name' => 'Mitosis or Equational Cell Division',
                        'bn_name' => 'মাইটোসিস বা সমীকরণিক কোষ বিভাজন',
                        'topic_order' => 2,
                    ],
                    [
                        'en_name' => 'Meiosis or Reductional Cell Division',
                        'bn_name' => 'মায়োসিস বা হ্রাসমূলক কোষ বিভাজন',
                        'topic_order' => 3,
                    ],
                ],
            ]
        ];
    }
}
