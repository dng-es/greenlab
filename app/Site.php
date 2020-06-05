<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'logo', 'lang'
    ];

    public function logoSite()
    {
        if ( \Storage::disk('sites')->exists($this->logo) ) $filename = $this->logo;
        else $filename = 'default.png';
        return \Storage::disk('sites')->url($filename);
    } 
}
