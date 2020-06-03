<?php

namespace App;

use App\Traits\EncryptTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Member extends Model
{
    public static function boot()
    {
        parent::boot();
        // self::creating(function ($model) {
        // $model->code = Str::uuid();
        // });
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'vat', 'name', 'last_name', 'telephone', 'email', 'picture', 'born_at', 'active', 'notes', 'credit'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'born_at' => 'date',
    ];

    use EncryptTrait;

    /**
     * The attributes tare encrypted.
     *
     * @var array
     */
    // protected $encrypt = [
    //     'name', 'last_name', 'telephone', 'email', 'picture', 'born_at', 'notes'
    // ];

    /**
     * Get the fees
     */
    public function fees()
    {
        return $this->hasMany('App\Fee');
    }  

    /**
     * Get the warehouses
     */
    public function warehouses()
    {
        return $this->hasMany('App\Warehouse');
    }

    /**
     * Get the credits
     */
    public function credits()
    {
        return $this->hasMany('App\Credit');
    }    

    public function imageProfile()
    {
        if ( \Storage::disk('user_images')->exists($this->picture) ) $filename = $this->picture;
        else $filename = 'default.jpg';
        return \Storage::disk('user_images')->url($filename);
    }
}
