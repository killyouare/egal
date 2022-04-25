<?php

namespace App\Models;

use App\Events\UpdatedLessonUserEvent;
use App\Events\UpdatingLessonUserEvent;
use Egal\Model\Exceptions\ObjectNotFoundException;
use Egal\Model\Exceptions\UpdateException;
use Egal\Model\Model as EgalModel;


/**
 * @property $id {@property-type field} {@prymary-key} 
 * @property $user_id {@property-type field}
 * @property $lesson_id {@property-type field}
 * @property $is_passed {@property-type field}
 * @property $created_at {@property-type field}
 * @property $updated_at {@property-type field}
 *
 * @action getItems {@statuses-access logged}
 * @action update {@roles-access user}
 */
class LessonUser extends EgalModel
{
  protected $fillable = [
    'user_id', 'lesson_id', 'is_passed'
  ];

  protected $dispatchesEvents = [
    "updating" => UpdatingLessonUserEvent::class,
    "updated" => UpdatedLessonUserEvent::class
  ];

  public static function actionUpdate($id = null, array $attributes = []): array
  {

    $instance = new static();

    if (!isset($id)) {
      if (!isset($attributes[$instance->getKeyName()])) {
        throw new UpdateException('The identifier of the entity being updated is not specified!');
      }

      $id = $attributes[$instance->getKeyName()];
    }

    $instance->makeIsInstanceForAction();
    $instance->validateKey($id);

    /** @var \Egal\Model\Model $entity */
    $entity = $instance->newQuery()->find($id);

    if (!$entity) {
      throw ObjectNotFoundException::make($id);
    }

    $entity->makeIsInstanceForAction();
    $entity->update(['is_passed' => true]);

    return $entity->toArray();
  }
}
