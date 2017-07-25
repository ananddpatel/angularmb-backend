<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiModel extends Model
{
    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }
}