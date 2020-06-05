<?php

namespace App\Http\Controllers;

use App\Category;
use App\Exports\MembersExport;
use App\Http\Requests\MemberRequest;
use App\Http\Requests\MemberUpdateRequest;
use App\Http\Requests\MembersImportRequest;
use App\Imports\MembersImport;
use App\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class MemberController extends Controller
{  

    public function index(Request $request)
    {
        $members = Member::select('*');

        //busquedas
        $search =  $request->input("search", '');
        //if ($search != "") $members = $members->where('last_name', 'like', '%'.$search.'%');


        //ordernacion del listado
        $order =  $request->input("order", 'DESC');
        $orderby =  $request->input("orderby", 'last_name');
        
        //dd($members->orderBy($orderby, $order)->toSql());

        $members = $members->orderBy($orderby, $order)->paginate(15);

        return view('members.index', ['members' => $members, 'search' => $search, 'orderby' => $orderby, 'order' => $order]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('members.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function store(MemberRequest $request)
    {
        $imageName = $request->input('imgBase64', '');
        if ($imageName != ''){
            $image = str_replace('data:image/png;base64,', '', $request->input('imgBase64'));
            $image = str_replace(' ', '+', $image);
            $imageName = "user-".time().".png";
            \File::put(storage_path(). '/app/public/images/users/' . $imageName, base64_decode($image));
        }

        if ($member = Member::create([
                'code'     => $request->input('code'),
                'vat'     => $request->input('vat'),
                'name'     => $request->input('name'),
                'last_name'    => $request->input('last_name'),
                'telephone'    => $request->input('telephone'),
                'email'    => $request->input('email'),
                'born_at'    => $request->input('born_at'),
                'notes'    => $request->input('notes'),
                'picture'    => $imageName,
                'active'    => ($request->has('active') ? $request->input('active') : 0),
            ])){    
            return response()->json(['success'=> __('general.InsertOkMessage'), 'data' => $member]);
        }
        else return response()->json(['error'=> __('general.ErrorMessage')]);        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Member $member)
    {
        $total_month = $member->warehouses()
            ->where('type', 'S')
            ->whereMonth('created_at', Carbon::now()->format('m'))
            ->whereYear('created_at', Carbon::now()->format('Y'))
            ->sum('amount_real');

        return view('members.edit', [
            'member' => $member, 
            'total_month' => $total_month,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProcess(Member $member, MemberUpdateRequest $request)
    {
        $member->name = $request->input('name');
        $member->vat = $request->input('vat');
        $member->last_name = $request->input('last_name');
        $member->telephone = $request->input('telephone');
        $member->email = $request->input('email');
        $member->notes = $request->input('notes');
        $member->born_at = $request->input('born_at');
        $member->active = ($request->has('active') ? $request->input('active') : 0);
        
        $imageName = $request->input('imgBase64', '');
        if ($imageName != ''){
            $image = str_replace('data:image/png;base64,', '', $request->input('imgBase64'));
            $image = str_replace(' ', '+', $image);
            $imageName = "user-".time().".png";
            \File::put(storage_path(). '/app/public/images/users/' . $imageName, base64_decode($image));

            $member->picture = $imageName;
        }

        if ($request->has('code')){
            $member->code = $request->code;
        }

        return $member->save();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Member $member, MemberUpdateRequest $request)
    {
        if ($this->updateProcess($member, $request))
        return response()->json(['success'=> __('general.UpdateOkMessage'), 'data' => $member]);
    }  


    /**
     * Export data to the specified format.
     *
     * @param  $exportOption
     * @param  \Illuminate\Http\Request  $request
     * @return Document XLSX, XLS, CSV
     */
    public function export($exportOption = "xlsx", $credit = false, Request $request)
    {
        return Excel::download(new MembersExport($request, $credit), __('app.Members').'.'.$exportOption);
    }
    /**
     * Return resource.
     *
     * @param  $search
     * @return \Illuminate\Http\Response
     */
    public function search($search = '')
    {
        return Member::orderBy('name')
                ->orderBy('last_name')
                ->when($search != '', function($query) use ($search){
                    return $query->where('code', $search)
                                ->orWhere('name', 'LIKE', '%'.$search.'%')
                                ->orWhere('last_name', 'LIKE', '%'.$search.'%')
                                ->orWhere('vat', 'LIKE', '%'.$search.'%');
                })
                ->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function warehouses(Member $member)
    {
        $warehouses = $member->warehouses()
            ->select('warehouses.amount_real', 'warehouses.price', 'warehouses.total', 'products.name AS product', 'categories.name AS category', 'warehouses.created_at')
            ->leftJoin('products', 'products.id', 'warehouses.product_id')
            ->leftJoin('categories', 'categories.id', 'products.category_id')
            ->orderBy('warehouses.created_at', 'DESC')
            ->paginate(10);

        return view('members.partials.warehouses', ['warehouses' => $warehouses]);
    }  

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function credits(Member $member)
    {
        $credits = $member->credits()
            ->with('user')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        if ($credits->total() > 0){
            $date_credits = $credits->first()->created_at;
            $history_credit = $member->credits()->where('created_at', '>', $date_credits)->sum('credit');
            $balance = ($member->credit - $history_credit);
        }
        else $balance = 0;

        return view('members.partials.credits', ['credits' => $credits, 'balance' => $balance]);
    } 

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function fees(Member $member){
        $fees = $member->fees()
            ->with('user')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('members.partials.fees', ['fees' => $fees]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        if($request->hasFile('filename')){
            $file = $request->file('filename');
            //saneamos el nombre del archivo
            $original_name = $file->getClientOriginalName();
            $extension = \File::extension($original_name);
            $file_name = time().".".$extension;
            if (\Storage::disk('backup')->put($file_name,  \File::get($file))){
                if (Excel::import(new MembersImport, storage_path('app/backup/').$file_name)){
                    return redirect()->back()->with('status',__('general.UploadOk'))->with('status_mode', 'success');
                }
                else return redirect()->back()->with('status',__('general.UploadKo'))->with('status_mode', 'error');
            }

        }
    }
}
