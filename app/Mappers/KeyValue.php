<?php

namespace App\Mappers;

use Illuminate\Database\Eloquent\Model;

class KeyValue
{
    public mixed $key;

    public mixed $value;

    public function __construct(Model $model)
    {
        $this->key = $model->getKey();
        $this->value = $model->name;
    }
}
