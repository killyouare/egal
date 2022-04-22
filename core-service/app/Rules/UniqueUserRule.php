<?php

namespace App\Rules;

use App\Models\LessonUser;
use Egal\Validation\Rules\Rule as EgalRule;
use Egal\Core\Session\Session;

class UniqueUserRule extends EgalRule
{

    public function validate($attribute, $value, $parameters = null): bool
    {
        $uuid = Session::getUserServiceToken()->getUid();
        $lesson = LessonUser::where([
            "user_id" => $uuid,
            "lesson_id" => $value,
        ])->first();
        if (!$lesson) {
            return false;
        }
        return true;
    }

    public function message(): string
    {
        return parent::message("You are not participating in this lesson"); // TODO
    }
}
