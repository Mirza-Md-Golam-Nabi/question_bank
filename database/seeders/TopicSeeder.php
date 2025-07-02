<?php

namespace Database\Seeders;

use App\Models\Topic;
use App\Models\Chapter;
use App\Models\Subject;
use Database\Seeders\Concerns\SeederHelper;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    use SeederHelper;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = $this->getSchoolScienceSubjectList();
        $topics = $this->getSchoolScienceTopicList();

        foreach ($subjects as $subject) {
            $subject_id = Subject::where('name', $subject)->value('id');

            if (! $subject_id) {
                continue;
            }

            if (array_key_exists($subject, $topics)) {
                $chapter_list = array_keys($topics[$subject]);

                foreach ($chapter_list as $chapter) {
                    $chapter_id = Chapter::where('name', $chapter)->value('id');

                    foreach ($topics[$subject][$chapter] as $topic) {
                        Topic::firstOrCreate(
                            [
                                'chapter_id' => $chapter_id,
                                'name' => $topic['name']
                            ],
                            [
                                'topic_order' => $topic['topic_order']
                            ]
                        );
                    }
                }
            }
        }
    }
}
