<?php

namespace App\Models;

use Egal\Model\Model as EgalModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property uuid $id {@property-type field} {@primary-key}
 * @property string $phone {@property-type field} {@validation-rules required|string|unique:users}
 * @property string $last_name {@property-type field} {@validation-rules required|string}
 * @property string $first_name {@property-type field} {@validation-rules required|string}
 * @property $created_at {@property-type field}
 * @property $updated_at {@property-type field}
 *
 * @action getMetadata {@roles-access admin}
 * @action getItem {@roles-access admin}
 * @action getItems {@statuses-access guest}
 * @action create {@statuses-access guest}
 * @action update {@roles-access admin}
 * @action delete {@roles-access admin}
 */
class User extends EgalModel
{
  use HasFactory;

  public $incrementing = false;

  protected $fillable = [
    'last_name',
    'id',
    'first_name',
    'phone'
  ];
}
