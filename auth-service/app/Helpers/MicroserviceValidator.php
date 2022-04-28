<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Validator;
use Egal\Model\Exceptions\ValidateException;

class MicroserviceValidator implements ValidatorInterface
{

  public static function validate(
    array $attributes,
    array $rules
  ): void {
    $validator = Validator::make(
      $attributes,
      $rules,
    );

    if ($validator->fails()) {
      $exception = new ValidateException();
      $exception->setMessageBag($validator->errors());

      throw $exception;
    }
  }
}
