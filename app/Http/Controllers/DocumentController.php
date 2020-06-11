<?php

namespace App\Http\Controllers;

use App\Document;
use App\Http\Requests\DocumentRequest;
use App\Member;
use Illuminate\Http\Request;

class DocumentController extends Controller
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
    public function store(DocumentRequest $request, Member $member)
    {
        //agregar fichero
        $file = $request->file('file');
        //saneamos el nombre del archivo
        $original_name = $file->getClientOriginalName();
        $extension = \File::extension($original_name);
        $file_name = time().".".$extension;
        
        if (\Storage::disk('user_images')->put($file_name,  \File::get($file))){
            $document = Document::create([
                'member_id' =>$member->id,
                'name' =>$request->input('name'),
                'file' =>$file_name,
            ]);
            return redirect()->back()->with('status', __('general.InsertOkMessage'))->with('status_mode', 'success');
        }
        else return redirect()->back()->with('status', __('general.ErrorMessage'))->with('status_mode', 'error');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        $document->delete();
        return redirect()->back()->with('status', __('general.DeleteOkMessage'));
    }
}
