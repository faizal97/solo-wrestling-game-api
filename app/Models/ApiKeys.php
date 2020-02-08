<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApiKeys extends Model
{
    use SoftDeletes;

    protected $tableName = "api_keys";
    protected $primaryKey = "id";
    protected $guard = [];

    /**
     * Get ApiKey record by key value
     *
     * @param string $key
     * @return bool
     */
    public static function getByKey($key)
    {
        return self::where([
            'key'    => $key,
            'active' => 1
        ])->first();
    }
}