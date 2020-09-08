<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class BackupController extends Controller
{
    
    /**
     * Generate backup
     *
     * @return \Illuminate\Http\Response
     */
    public function generate()
    {
        Artisan::call('backup:run');
        return redirect()->back()->with('status', __('general.Backup_successful'));
    }
}
