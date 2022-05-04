<?php

namespace App\Models;

use Egal\Model\Model as EgalModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property $id {@property-type field} {@prymary-key}
 * @property $title {@property-type field} {@validation-rules required|string}
 * @property $student_capacity {@property-type field} {@validation-rules required|int}
 * @property $start_date {@property-type field} {@validation-rules required|date_format:Y-m-d|after:yesterday}
 * @property $end_date {@property-type field} {@validation-rules required|date_format:Y-m-d|after:start_date}
 * @property $has_certificate {@property-type field} {@validation-rules bool}
 * @property $created_at {@property-type field}
 * @property $updated_at {@property-type field}
 *
 * @property Collection $lessons {@property-type relation}
 *
 * @action getMetadata {@roles-access admin}
 * @action getItem {@roles-access user}
 * @action getItems {@roles-access user|admin}
 * @action create {@roles-access admin}
 * @action update {@roles-access admin}
 * @action delete {@roles-access admin}
 */
class Course extends EgalModel
{
    use HasFactory;

    protected $fillable = [
        "title",
        "student_capacity",
        "start_date",
        "end_date",
        "has_certificate",
    ];
    protected $guarder = [
        "id"
    ];

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    public static function findItem(int $id): self
    {
        return self::query()->where("id", $id)->firstOrFail();
    }
}
