<?php

namespace App\Listeners;

use Killyouare\Helpers\AbstractEvent;
use Killyouare\Helpers\AbstractListener;
use App\Models\Lesson;
use App\Models\LessonUser;

class CreateLessonUserListener extends AbstractListener
{
    public function handle(AbstractEvent $event): void
    {
        parent::handle($event);

        $attributes = $event->getAttributes();

        $lessons = Lesson::getItemsByCourseId($attributes['course_id'])->get()->toArray();

        foreach ($lessons as $lesson) {
            LessonUser::createItem([
                'user_id' => $attributes['user_id'],
                'lesson_id' => $lesson['id'],
            ]);
        }
    }
}
