<?php

namespace App;

use App\Events\CreditEvent;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'member_id', 'credit', 'notes'
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => CreditEvent::class,
    ];

    /**
     * Get the user
     */
    public function user()
    {
        return $this->belongsTo('App\User')->withDefault([
            'name' => '[None]'
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
