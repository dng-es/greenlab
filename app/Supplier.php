<?php

namespace App;

use App\Traits\EncryptTrait;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'notes'
    ];

    use EncryptTrait;

    /**
     * The attributes tare encrypted.
     *
     * @var array
     */
    protected $encrypt = [
        'notes'
    ];

    /**
     * Get the warehouses
     */
    public function warehouses()
    {
        return $this->hasMany('App\Warehouse');
    }
}
