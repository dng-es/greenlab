<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'supplier_id', 'amount', 'price', 'total', 'notes', 'date_at'
    ];

    protected $casts = [
        'date_at' => 'date',
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
        'date_at',
        'created_at',
        'updated_at',
        'deleted_at'
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
     * Get the supplier
     */
    public function supplier()
    {
        return $this->belongsTo('App\Supplier')->withDefault([
            'name' => '[None]'
        ]);
    }
}
