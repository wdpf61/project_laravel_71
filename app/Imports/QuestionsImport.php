<?php

namespace App\Imports;

use App\Models\Course;
use App\Models\Module;
use App\Models\CompetencyUnit;
use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class QuestionsImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    public function rules(): array
    {
        return [
            '*.course_code'   => ['required', 'string', 'exists:courses,code'],
            '*.question_text' => ['required', 'string'],
            '*.question_type' => ['required', 'string'],
            '*.marks'         => ['required', 'numeric'],
            '*.option_1'      => ['required', 'string'],
            '*.option_2'      => ['required', 'string'],
        ];
    }

    public function customValidationMessages()
    {
        return [
            '*.course_code.required' => 'Course code is mandatory.',
            '*.course_code.exists'   => 'Given course code does not exist in the database.',
            '*.question_text.required' => 'Question text cannot be empty.',
        ];
    }

    public function collection(Collection $rows)
    {
        DB::transaction(function () use ($rows) {
            foreach ($rows as $row) {
                // 1. Fetch Course ID
                $course = Course::where('code', trim($row['course_code']))->first();

                // 2. Find or Create Module (prevent duplicate under course)
                $module = null;
                if (!empty($row['module_code'])) {
                    $module = Module::firstOrCreate(
                        ['code' => trim($row['module_code'])],
                        [
                            'name' => $row['module_name'] ?? $row['module_code'],
                            'course_id' =>   $course->id,
                            'status' => 'active',
                        ]
                    );
                }

                // 3. Find or Create Competency Unit
                $unit = null;
                if (!empty($row['unit_code'])) {
                    $unit = CompetencyUnit::firstOrCreate(
                        ['code' => trim($row['unit_code'])],
                        [
                            'name' => $row['unit_name'] ?? $row['unit_code'],
                            'module_id' => $module->id,
                            'status' => 'active',
                        ]
                    );
                }

                // 4. Find or Create Question (Prevent exact duplicates)
                $question = Question::firstOrCreate(
                    [
                        'question_text' => trim($row['question_text']),
                    ],
                    [
                        'course_id' =>   $course->id,
                        'module_id' => $module->id,
                        'competency_unit_id' =>  $unit->id,
                        'question_type' => $row['question_type'] ?? 'mcq',
                        'marks'         => $row['marks'] ?? 1.00,
                        'difficulty'    => $row['difficulty'] ?? 'medium',
                        'explanation'   => $row['explanation'] ?? null,
                        'status'        => 'active',
                        'created_by'    => auth()->id(),
                    ]
                );

                // 5. Insert Options for the Question
                for ($i = 1; $i <= 4; $i++) {
                    $optText = $row["option_{$i}"] ?? null;
                    $isCorrect = $row["is_correct_{$i}"] ?? 0;

                    if (!empty($optText)) {
                        QuestionOption::updateOrCreate(
                            [
                                'question_id'  => $question->id,
                                'option_order' => $i,
                            ],
                            [
                                'option_text'  => trim($optText),
                                'is_correct'   => (bool) $isCorrect,
                            ]
                        );
                    }
                }
            }
        });
    }
}