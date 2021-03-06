<?php

namespace App\Models;

use Egal\Model\Model as EgalModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property $id {@property-type field} {@prymary-key}
 * @property $course_id {@property-type field} {@validation-rules required|int|exists:courses,id}
 * @property $theme {@property-type field} {@validation-rules required|string}
 * @property $created_at {@property-type field}
 * @property $updated_at {@property-type field}
 *
 * @property $course {@property-type relation}
 *
 * @action getItem {@roles-access admin}
 * @action getItems {@roles-access user|admin}
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

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public static function getItemsByCourseId(int $course_id): mixed
    {

        return self::query()->where(['course_id' => $course_id]);
    }

    public static function findItem(int $id): self
    {
        return self::query()->where(["id" => $id])->firstOrFail();
    }
}
