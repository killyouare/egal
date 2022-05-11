<?php

namespace App\Listeners;

use Killyouare\Helpers\AbstractEvent;
use Killyouare\Helpers\AbstractListener;
use App\Models\CourseUser;
use App\Models\Lesson;
use App\Models\LessonUser;

class UpdatedLessonUserListener extends AbstractListener
{
    public function handle(AbstractEvent $event): void
    {
        parent::handle($event);

        $attributes = $event->getAttributes();

        $course = Lesson::findItem($attributes['lesson_id'])->course;
        $lessons =  $course->lessons;

        $courseUser = CourseUser::findByFields([
            'course_id' => $course->id,
            'user_id' => $attributes['user_id'],
        ]);

        $countPassed = LessonUser::query()->whereIn('lesson_id', $lessons->pluck('id'))
            ->where([
                'user_id' => $attributes['user_id'],
                'is_passed' => true
            ])->count();

        $courseUser->update(['percentage_passing' => round(($countPassed / $lessons->count() * 100))]);
    }
}
