<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'bar', 'notes'
    ];

    protected $hidden = [
        'deleted_at',
    ];    

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Get the products
     */
    public function products()
    {
        return $this->hasMany('App\Product');
    }

    /**
     * Get the products
     */
    public function productsActive()
    {
        return $this->products()->where('menu', 1);
    }    
}
