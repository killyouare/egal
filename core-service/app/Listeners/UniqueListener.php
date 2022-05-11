<?php

namespace App\Listeners;

use Killyouare\Helpers\AbstractEvent;
use Killyouare\Helpers\AbstractListener;
use Killyouare\Helpers\MicroserviceValidator;

class UniqueListener extends AbstractListener
{
    public function handle(AbstractEvent $event): void
    {
        parent::handle($event);

        $attributes = $event->getAttributes();
        $course_id = $attributes['course_id'];

        MicroserviceValidator::validate($attributes, [
            "user_id" => "unique:course_users,user_id,null,null,course_id,$course_id"
        ]);
    }
}
