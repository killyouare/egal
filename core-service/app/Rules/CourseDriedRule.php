<?php

namespace App\Rules;

use App\Models\Course;
use App\Models\Lesson;
use Egal\Validation\Rules\Rule as EgalRule;
use Illuminate\Support\Carbon;

class CourseDriedRule extends EgalRule
{
    /**
     * @param mixed $attribute
     * @param mixed $value
     * @param null $parameters
     *
     * @return bool
     */
    public function validate($attribute, $value, $parameters = null): bool
    {
        $lesson = Lesson::findItem($value);
        $course = Course::find($lesson->course_id);
        return Carbon::parse($course['end_date'])->getTimestamp() > Carbon::now()->getTimestamp();
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return parent::message("Course dried up");
    }
}
