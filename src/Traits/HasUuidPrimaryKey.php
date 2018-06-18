<?php

namespace AlexChadwick\Uuid\Traits;

use AlexChadwick\Uuid\Uuid;

trait HasUuidPrimaryKey {

    static $uuidVersion = 4;

    public static function bootHasUuidPrimaryKey()
    {
        // Set model primary key to generated UUID.
        // The method ‘getKeyName’ will get the name of the primary key, just in case it is you changed into something else then ‘id’
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::generate(self::$uuidVersion)->string;
        });
    }
}