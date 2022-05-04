<?php

return [

    "include" => (bool)env("DEBUG_MODE", false),
    "debugDir" => env("DEBUG_PATH", 'app/DebugModels/'),

];
