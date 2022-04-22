<?php

namespace App\Models;

use Egal\Model\Model as EgalModel;

/**
 * @property $id {@property-type field} {@prymary-key}
 * @property $last_name {@property-type field} {@validation-rules required|string}
 * @property $first_name {@property-type field} {@validation-rules required|string}
 * @property $phone {@property-type field} {@validation-rules required|string}
 * @property $created_at {@property-type field}
 * @property $updated_at {@property-type field}
 *
 * @action getMetadata {@statuses-access guest|logged}
 * @action getItem {@statuses-access guest|logged}
 * @action getItems {@statuses-access guest}
 * @action create {@statuses-access guest}
 * @action update {@statuses-access logged} 
 * @action delete {@statuses-access logged}
 */
class User extends EgalModel
{

  protected $fillable = [
    'last_name',
    "id",
    'first_name',
    "phone"
  ];
}
