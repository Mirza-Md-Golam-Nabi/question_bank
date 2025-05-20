<?php

namespace Database\Seeders;

use App\Models\Topic;
use App\Models\Chapter;
use App\Models\Subject;
use App\Models\Question;
use App\Models\QuestionUser;
use App\Models\QuestionOption;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = $this->subjectList();
        $questions = $this->questionList();

        foreach ($subjects as $subject) {
            $subject_id = Subject::where('en_name', $subject)->value('id');

            if (! $subject_id) {
                continue;
            }

            if (array_key_exists($subject, $questions)) {
                $chapter_list = array_keys($questions[$subject]);

                foreach ($chapter_list as $chapter) {
                    $chapter_id = Chapter::where('en_name', $chapter)->value('id');

                    if (! $chapter_id) {
                        continue;
                    }

                    $topic_list = array_keys($questions[$subject][$chapter]);
                    foreach ($topic_list as $topic) {
                        $topic_id = Topic::where('en_name', $topic)->value('id');

                        foreach ($questions[$subject][$chapter][$topic] as $question) {
                            $q = Question::firstOrCreate(
                                [
                                    'subject_id' => $subject_id,
                                    'chapter_id' => $chapter_id,
                                    'topic_id' => $topic_id,
                                    'question_text' => $question['question'],
                                    'correct_option_index' => $question['correct_option_index']
                                ]
                            );

                            QuestionOption::create([
                                'question_id' => $q->id,
                                'options' => $question['options'],
                            ]);

                            $q->users()->attach(2);
                        }
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

    protected function questionList(): array
    {
        return [
            'Physics' => [
                'Physical World and Measurement' => [
                    'Concepts of Science and Physics, Applications and Stages of Discovery' => [
                        [
                            'question' => 'বলের একক কী?',
                            'options' => [
                                'জুল (Joule)',
                                'নিউটন (Newton)',
                                'ওয়াট (Watt)',
                                'পাস্কাল (Pascal)',
                            ],
                            'correct_option_index' => 1
                        ],
                        [
                            'question' => 'তাপমাত্রা পরিমাপের একক কোনটি?',
                            'options' => [
                                'কিলোগ্রাম (kg)',
                                'কেলভিন (K)',
                                'অ্যাম্পিয়ার (A)',
                                'ক্যান্ডেলা (cd)',
                            ],
                            'correct_option_index' => 1
                        ],
                        [
                            'question' => 'বিদ্যুৎ প্রবাহের একক কী?',
                            'options' => [
                                'ভোল্ট (V)',
                                'ওহম (Ω)',
                                'অ্যাম্পিয়ার (A)',
                                'ফ্যারাড (F)',
                            ],
                            'correct_option_index' => 2
                        ]
                    ],
                ],
            ],
            'Chemistry' => [
                'Qualitative Chemistry' => [
                    'Atomic Theory and Models of the Atom' => [
                        [
                            'question' => 'নিম্নলিখিত কোনটি d-ব্লক এর উপাদান?',
                            'options' => [
                                'সোডিয়াম (Na)',
                                'আয়রন (Fe)',
                                'বোরন (B)',
                                'নাইট্রোজেন (N)',
                            ],
                            'correct_option_index' => 1
                        ],
                        [
                            'question' => 'লোহায় মরিচা ধরা কোন ধরনের বিক্রিয়া?',
                            'options' => [
                                'প্রতিস্থাপন',
                                'জারণ-বিজারণ',
                                'সংযোজন',
                                'নিরপেক্ষকরণ',
                            ],
                            'correct_option_index' => 1
                        ],
                        [
                            'question' => 'পরমাণুর নিউক্লিয়াসে কী থাকে?',
                            'options' => [
                                'শুধু ইলেকট্রন',
                                'প্রোটন ও নিউট্রন',
                                'শুধু নিউট্রন',
                                'শুধু প্রোটন',
                            ],
                            'correct_option_index' => 1
                        ]
                    ],
                ]
            ],
            'Biology' => [
                'Cell & its structure' => [
                    'Cell Wall' => [
                        [
                            'question' => 'মানবদেহের কোন কোষে মাইটোকন্ড্রিয়া নেই?',
                            'options' => [
                                'লোহিত রক্তকণিকা',
                                'স্নায়ু কোষ',
                                'পেশী কোষ',
                                'যকৃত কোষ',
                            ],
                            'correct_option_index' => 0
                        ],
                        [
                            'question' => 'নিচের কোনটি DNA-এর গঠনগত একক?',
                            'options' => [
                                'অ্যামিনো অ্যাসিড',
                                'নিউক্লিওটাইড',
                                'গ্লিসারল',
                                'ফ্যাটি অ্যাসিড',
                            ],
                            'correct_option_index' => 1
                        ],
                        [
                            'question' => 'ফটোসিনথেসিসের সময় উদ্ভিদ কোন গ্যাস বায়ুমণ্ডলে নির্গত করে?',
                            'options' => [
                                'কার্বন ডাইঅক্সাইড',
                                'অক্সিজেন',
                                'নাইট্রোজেন',
                                'মিথেন',
                            ],
                            'correct_option_index' => 1
                        ],
                    ]
                ],
            ]
        ];
    }
}
