<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteRequest;
use App\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $site = Site::findOrfail(1);

        return view('sites.show', [
            'site' => $site,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function edit(Site $site)
    {
        $site = Site::findOrfail(1);

        return view('sites.edit', [
            'site' => $site,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function update(SiteRequest $request, Site $site)
    {
        $site->name = $request->input('name');
        $site->lang = $request->input('lang');

        //agregar logo
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            //saneamos el nombre del archivo
            $original_name = $file->getClientOriginalName();
            $extension = \File::extension($original_name);
            $file_name = time().".".$extension;
            if (\Storage::disk('sites')->put($file_name, \File::get($file))) {
                $site->logo = $file_name;
            }
        }

        $site->save();
        return redirect()->back()->with('status', __('general.UpdateOkMessage'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function destroy(Site $site)
    {
        //
    }
}
