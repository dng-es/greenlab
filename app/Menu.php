<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'background', 'fontcolor', 'fontsize'
    ];

    public function imageBackground()
    {
        if ( \Storage::disk('menu')->exists($this->background) ) $filename = $this->background;
        else $filename = 'default.jpg';
        return \Storage::disk('menu')->url($filename);
    }    
}
