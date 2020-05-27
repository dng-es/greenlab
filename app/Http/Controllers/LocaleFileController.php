<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Lang;

class LocaleFileController extends Controller
{
    private $lang = 'es';
    private $file = 'app';
    private $key;
    private $value;
    private $path;
    private $arrayLang = array();

    public function show() 
    {
    	$this->read();
    	$this->arrayLang;
        return view('locales', ['locales' => $this->arrayLang]); 
    }
//------------------------------------------------------------------------------
// Add or modify lang files content
//------------------------------------------------------------------------------

    public function changeLang(Request $request) 
    {
        $this->lang = app()->getLocale();
        $this->file = 'app';
        foreach ($request->input() as $key => $value) {
        	if ($key != '_token'){
        		$this->arrayLang[$key] = $value;
        	}
        }

        $this->save();

        return redirect()->back()->with('status', __('general.UpdateOkMessage'));
    }

//------------------------------------------------------------------------------
// Add or modify lang files content
//------------------------------------------------------------------------------

    private function changeLangFileContent() 
    {
        $this->read();
        $this->arrayLang[$this->key] = $this->value;
        $this->save();
    }

//------------------------------------------------------------------------------
// Delete from lang files
//------------------------------------------------------------------------------

    private function deleteLangFileContent() 
    {
        $this->read();
        unset($this->arrayLang[$this->key]);
        $this->save();
    }

//------------------------------------------------------------------------------
// Read lang file content
//------------------------------------------------------------------------------

    private function read() 
    {
        if ($this->lang == '') $this->lang = App::getLocale();
        $this->path = base_path().'/resources/lang/'.$this->lang.'/'.$this->file.'.php';
        $this->arrayLang = Lang::get($this->file);
        if (gettype($this->arrayLang) == 'string') $this->arrayLang = array();
    }

//------------------------------------------------------------------------------
// Save lang file content
//------------------------------------------------------------------------------

    private function save() 
    {
        $this->path = base_path().'/resources/lang/'.$this->lang.'/'.$this->file.'.php';
        $content = "<?php\n\nreturn\n[\n";

        foreach ($this->arrayLang as $this->key => $this->value) 
        {
            $content .= "\t'".$this->key."' => '".$this->value."',\n";
        }

        $content .= "];";

        file_put_contents($this->path, $content);

    }
}