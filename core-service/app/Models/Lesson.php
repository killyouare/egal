<?php

namespace App\Models;

use Egal\Model\Model as EgalModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property $id {@property-type field} {@prymary-key}
 * @property $course_id {@property-type field} {@validation-rules required|int}
 * @property $theme {@property-type field} {@validation-rules required|string}
 * @property $created_at {@property-type field}
 * @property $updated_at {@property-type field}
 *
 * @property $course {@property-type relation}
 * 
 * @action getMetadata {@roles-access admin}
 * @action getItem {@roles-access admin}
 * @action getItems {@roles-access user}
 * @action create {@roles-access admin}
 * @action update {@roles-access admin}
 * @action delete {@roles-access admin}
 */
class Lesson extends EgalModel
{
  use HasFactory;


  protected $fillable = [
    'course_id', 'theme',
  ];
}
