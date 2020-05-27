<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'category_id', 'price', 'amount', 'menu',
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
     * Get the category
     */
    public function category()
    {
        return $this->belongsTo('App\Category')->withDefault([
            'name' => '[Deleted]'
        ]);
    }  

    /**
     * Get the warehouses
     */
    public function warehouses()
    {
        return $this->hasMany('App\Warehouse');
    }
}
