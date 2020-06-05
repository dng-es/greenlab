<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\MenuRequest;
use App\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $categories = Category::where('bar', 0)
                    ->orderBy('categories.name')
                    ->get();

        $menu = Menu::findOrfail(1);

        return view('menu.show', [
            'menu' => $menu,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $categories = Category::where('bar', 0)
                    ->orderBy('categories.name')
                    ->get();

        $menu = Menu::findOrfail(1);

        return view('menu.edit', [
            'menu' => $menu,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        $menu->fontsize = $request->input('fontsize');
        $menu->fontcolor = $request->input('fontcolor');

        //agregar foto
        if($request->hasFile('background')){
            $file = $request->file('background');
            //saneamos el nombre del archivo
            $original_name = $file->getClientOriginalName();
            $extension = \File::extension($original_name);
            $file_name = time().".".$extension;
            if (\Storage::disk('menu')->put($file_name,  \File::get($file))){
                $menu->background = $file_name;
            }
        }

        $menu->save();
        return redirect()->back()->with('status', __('general.UpdateOkMessage'));
    }
}
