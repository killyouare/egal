<?php

namespace App\Models;

use Egal\Model\Model as EgalModel;

/**
 * @property $id {@property-type field} {@prymary-key}
 * @property $user_id {@property-type relation}
 * @property $lesson_id {@property-type relation} {@validation-rules required|int|course_dried|unique_user}
 * @property $created_at {@property-type field}
 * @property $updated_at {@property-type field}
 *
 * @action update {@roles-access user}
 */
class LessonUser extends EgalModel
{
  protected $fillable = [
    'user_id', 'lesson_id', 'is_passed'
  ];
}
