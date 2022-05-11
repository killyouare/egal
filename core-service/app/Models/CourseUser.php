<?php

namespace App\Models;

use Egal\Model\Model as EgalModel;
use App\Events\CreatingModelCourseUserEvent;
use App\Events\CreatedModelCourseUserEvent;

/**
 * @property $id {@property-type field} {@prymary-key}
 * @property $user_id {@property-type field} {@validation-rules required|uuid|exists:users,id}
 * @property $course_id {@property-type field} {@validation-rules required|int|exists:courses,id}
 * @property $percentage_passing {@property-type field}
 * @property $created_at {@property-type field}
 * @property $updated_at {@property-type field}
 *
 * @action create {@roles-access user}
 * @action getItems {@roles-access user|admin}
 *
 */
class CourseUser extends EgalModel
{
    protected $fillable = [
        "user_id",
        "course_id",
        "percentage_passing"
    ];

    protected $dispatchesEvents = [
        'creating' => CreatingModelCourseUserEvent::class,
        'created' => CreatedModelCourseUserEvent::class,
    ];

    public static function findByFields(array $fields): self
    {
        return self::query()->where($fields)->firstOrFail();
    }
}
