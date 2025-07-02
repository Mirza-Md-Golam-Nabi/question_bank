<?php

namespace Database\Seeders\Concerns;

trait SeederHelper
{
    protected function getAcademicClasses(): array
    {
        return [
            'Class 09-10',
            'Class 11-12',
        ];
    }

    protected function getDepartments(): array
    {
        return [
            'Science',
            'Commerce',
            'Arts',
        ];
    }

    protected function getSchoolSubjectList(): array
    {
        return [
            'Science' => [
                'Higher Mathematics',
                'Physics',
                'Chemistry',
                'Biology',
            ],
            'Commerce' => [
                'Accounting',
                'Business Organization and Management',
                'Finance, Banking, and Insurance',
                'Production Management & Marketing',
            ],
            'Arts' => [
                'Economics',
                'History',
                'Geography',
                'Sociology',
            ],
        ];
    }

    protected function getCollegeSubjectList(): array
    {
        return [
            'Science' => [
                'Higher Mathematics 1st Paper',
                'Physics 1st Paper',
                'Chemistry 1st Paper',
                'Biology 1st Paper',
                'Higher Mathematics 2nd Paper',
                'Physics 2nd Paper',
                'Chemistry 2nd Paper',
                'Biology 2nd Paper',
            ],
            'Commerce' => [
                'Accounting 1st Paper',
                'Business Organization and Management 1st Paper',
                'Finance, Banking, and Insurance 1st Paper',
                'Production Management & Marketing 1st Paper',
                'Accounting 2nd Paper',
                'Business Organization and Management 2nd Paper',
                'Finance, Banking, and Insurance 2nd Paper',
                'Production Management & Marketing 2nd Paper',
            ],
            'Arts' => [
                'Economics 1st Paper',
                'History 1st Paper',
                'Geography 1st Paper',
                'Sociology 1st Paper',
                'Economics 2nd Paper',
                'History 2nd Paper',
                'Geography 2nd Paper',
                'Sociology 2nd Paper',
            ],
        ];
    }

    protected function getSchoolScienceSubjectList(): array
    {
        $school_subjects = $this->getSchoolSubjectList();

        return $school_subjects['Science'];
    }

    protected function getSchoolScienceChapterList(): array
    {
        return [
            'Physics' => [
                [
                    'name' => 'ভৌত জগৎ ও পরিমাপ',
                    'chapter_order' => 1,
                ],
                [
                    'name' => 'ভেক্টর',
                    'chapter_order' => 2,
                ],
            ],
            'Chemistry' => [
                [
                    'name' => 'গুণগত রসায়ন',
                    'chapter_order' => 1,
                ],
                [
                    'name' => 'মৌলের পর্যায়বৃত্ত ধর্ম ও রাসায়নিক বন্ধন',
                    'chapter_order' => 2,
                ],
            ],
            'Biology' => [
                [
                    'name' => 'কোষ ও এর গঠন',
                    'chapter_order' => 1,
                ],
                [
                    'name' => 'কোষ বিভাজন',
                    'chapter_order' => 2,
                ],
                [
                    'name' => 'কোষ রসায়ন',
                    'chapter_order' => 3,
                ],
            ]
        ];
    }

    protected function getSchoolScienceTopicList(): array
    {
        return [
            'Physics' => [
                'ভৌত জগৎ ও পরিমাপ' => [
                    [
                        'name' => 'বিজ্ঞান ও পদার্থবিজ্ঞানের ধারণা প্রয়োগ ও আবিষ্কারের ধাপসমূহ',
                        'topic_order' => 1,
                    ],
                    [
                        'name' => 'পদার্থবিজ্ঞানের গুরুত্বপূর্ণ রাশিসমূহ, তাদের প্রতীক এবং মানসমূহ',
                        'topic_order' => 2,
                    ]
                ],
                'ভেক্টর' => [
                    [
                        'name' => 'ভেক্টর রাশির ধারণা, বৈশিষ্ট্য এবং গুরুত্বপূর্ণ সূত্রসমূহ',
                        'topic_order' => 1,
                    ],
                    [
                        'name' => 'ভেক্টরের প্রকারভেদ',
                        'topic_order' => 2,
                    ]
                ],
            ],
            'Chemistry' => [
                'গুণগত রসায়ন' => [
                    [
                        'name' => 'পারমাণবিক মতবাদ ও পরমাণুর মডেলসমূহ',
                        'topic_order' => 1,
                    ],
                    [
                        'name' => 'কোয়ান্টাম সংখ্যা',
                        'topic_order' => 2,
                    ]
                ],
                'মৌলের পর্যায়বৃত্ত ধর্ম ও রাসায়নিক বন্ধন' => [
                    [
                        'name' => 'বিভিন্ন ব্লকের মৌল ও তার সাধারণ ধর্মাবলী',
                        'topic_order' => 1,
                    ],
                    [
                        'name' => 'পারমাণবিক সংখ্যা, গ্রুপ ও পর্যায় সম্পর্কিত তথ্যাবলী',
                        'topic_order' => 2,
                    ]
                ],
            ],
            'Biology' => [
                'কোষ ও এর গঠন' => [
                    [
                        'name' => 'কোষ প্রাচীর',
                        'topic_order' => 1,
                    ],
                    [
                        'name' => 'প্লাজমামেমব্রেন বা কোষঝিল্লি',
                        'topic_order' => 2,
                    ],
                    [
                        'name' => 'সাইটোপ্লাজম ও অঙ্গাণু',
                        'topic_order' => 3,
                    ],
                ],
                'কোষ বিভাজন' => [
                    [
                        'name' => 'অ্যামাইটোসিস বা প্রত্যক্ষ কোষ বিভাজন',
                        'topic_order' => 1,
                    ],
                    [
                        'name' => 'মাইটোসিস বা সমীকরণিক কোষ বিভাজন',
                        'topic_order' => 2,
                    ],
                    [
                        'name' => 'মায়োসিস বা হ্রাসমূলক কোষ বিভাজন',
                        'topic_order' => 3,
                    ],
                ],
            ]
        ];
    }
}
