<?php

namespace App\Models;

use Egal\Model\Model as EgalModel;
use App\Events\CreatingModelCourseUserEvent;
use App\Events\CreatedModelCourseUserEvent;

/**
 * @property $id {@property-type field} {@prymary-key}
 * @property $user_id {@property-type field} {@validation-rules required|uuid}
 * @property $course_id {@property-type field} {@validation-rules required|int
 * @property $percentage_passing {@property-type field}
 * @property $created_at {@property-type field}
 * @property $updated_at {@property-type field}
 *
 * @action create {@roles-access user}
 */
class CourseUser extends EgalModel
{

  protected $fillable = [
    "user_id",
    "course_id",
    "percentage_passing"
  ];
  protected $guarder = [
    "id"
  ];

  protected $dispatchesEvents = [
    'creating' => CreatingModelCourseUserEvent::class,
    'created' => CreatedModelCourseUserEvent::class,
  ];
}
