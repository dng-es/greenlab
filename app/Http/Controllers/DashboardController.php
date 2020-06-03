<?php

namespace App\Http\Controllers;


use App\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Request $request, \Codedge\Updater\UpdaterManager $updater)
    {
    	$stock = Product::where('amount', '>', 0)
            ->with('category')
            ->orderBy('name')
            ->get();

        $update_app = false;
        //dd($updater->source());
        // Check if new version is available
        if($updater->source()->isNewVersionAvailable()) {
            $update_app = true;

            // // Get the current installed version
            // echo $updater->source()->getVersionInstalled();

            // // Get the new version available
            // $versionAvailable = $updater->source()->getVersionAvailable();

            // // Create a release
            // $release = $updater->source()->fetch($versionAvailable);

            // // Run the update process
            // $updater->source()->update($release);
            
        }

        return view('dashboard', [
            'stock' => $stock, 
            'update_app' => $update_app
        ]);

    }
}
