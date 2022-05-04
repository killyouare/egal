<?php

namespace App\Models;

use App\Events\UpdatedLessonUserEvent;
use App\Events\UpdatingLessonUserEvent;
use Egal\Model\Model as EgalModel;

/**
 * @property $id {@property-type field} {@prymary-key}
 * @property $user_id {@property-type field} {@validation-rules exists:users,id}
 * @property $lesson_id {@property-type field} {@validation-rules exists:lessons,id}
 * @property $is_passed {@property-type field}
 * @property $created_at {@property-type field}
 * @property $updated_at {@property-type field}
 *
 * @action getItems {@roles-access user|admin}
 * @action update {@roles-access user}
 */
class LessonUser extends EgalModel
{
    protected $fillable = [
        'user_id',
        'lesson_id',
        'is_passed'
    ];

    protected $dispatchesEvents = [
        "updating" => UpdatingLessonUserEvent::class,
        "updated" => UpdatedLessonUserEvent::class
    ];

    public static function createItem(array $items)
    {
        $course = new static();
        $course->fill($items);
        $course->save();
        return $course;
    }
}
