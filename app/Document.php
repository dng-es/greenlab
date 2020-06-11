<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
	use SoftDeletes;

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'member_id', 'name', 'file'
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
     * Get the member
     */
    public function member()
    {
        return $this->belongsTo('App\Member')->withDefault([
            'name' => '[None]'
        ]); 
    } 
}
