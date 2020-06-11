<?php

namespace App;

use App\Events\WarehouseDeleteEvent;
use App\Events\WarehouseEvent;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'member_id', 'product_id', 'supplier_id', 'price', 'amount', 'amount_real', 'total', 'type'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'born_at' => 'date',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => WarehouseEvent::class,
        'deleted' => WarehouseDeleteEvent::class,
    ];    

    /**
     * Get the user
     */
    public function user()
    {
        return $this->belongsTo('App\User')->withDefault([
            'name' => '[Deleted]'
        ]); 
    }  

    /**
     * Get the product
     */
    public function product()
    {
        return $this->belongsTo('App\Product')->withDefault([
            'name' => '[Deleted]'
        ]);
    }  

    /**
     * Get the member
     */
    public function member()
    {
        return $this->belongsTo('App\Member')->withDefault([
            'name' => '[None]'
        ]); 
    }

    /**
     * Get the supplier
     */
    public function supplier()
    {
        return $this->belongsTo('App\Supplier')->withDefault([
            'name' => '[None]'
        ]); 
    } 

    /**
     * Get the IN movements 
     */
    public function entradas()
    {
        return $this->where('type', 'E');
    } 

    /**
     * Get the OUT movements 
     */
    public function salidas()
    {
        return $this->where('type', 'S');
    } 
}
