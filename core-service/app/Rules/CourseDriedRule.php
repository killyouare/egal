<?php

namespace App\Rules;

use App\Models\Course;
use App\Models\Lesson;
use Egal\Validation\Rules\Rule as EgalRule;
use Illuminate\Support\Carbon;

class CourseDriedRule extends EgalRule
{

    public function validate($attribute, $value, $parameters = null): bool
    {
        $lesson = Lesson::actionGetItem($value);
        $course = Course::actionGetItem($lesson['course_id']);
        return Carbon::parse($course['end_date'])->getTimestamp() > Carbon::now()->getTimestamp();
    }

    public function message(): string
    {
        // Убрать TODO
        return parent::message("Course dried up"); // TODO
    }
}
