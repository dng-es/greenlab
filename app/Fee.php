<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fee extends Model
{
    use SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'member_id', 'init_at', 'end_at', 'price', 'notes'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'init_at' => 'date',
        'end_at' => 'date',
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
        'deleted_at',
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
     * Get the member
     */
    public function member()
    {
        return $this->belongsTo('App\Member')->withDefault([
            'name' => '[None]'
        ]); 
    }  
}
