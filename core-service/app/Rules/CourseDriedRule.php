<?php

namespace App\Rules;

use App\Models\Lesson;
use Egal\Validation\Rules\Rule as EgalRule;
use Illuminate\Support\Carbon;

class CourseDriedRule extends EgalRule
{

    public function validate($attribute, $value, $parameters = null): bool
    {
        $end_date = Lesson::where("id", $value)->course()->end_date;
        return Carbon::parse($end_date)->getTimestamp() < Carbon::now()->getTimestamp();
    }

    public function message(): string
    {
        return parent::message("Course dried up"); // TODO
    }
}
