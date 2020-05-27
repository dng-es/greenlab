<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Http\Requests\NewUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{  

    public function index(Request $request)
    {
        $users = User::select('*')->with('roles');

        //busquedas
        $search =  $request->input("search", '');
        if ($search != "") $users = $users->where('users.name', 'like', '%'.$search.'%');

        //ordernacion del listado
        $order =  $request->input("order", 'DESC');
        $orderby =  $request->input("orderby", 'id');
        
        $users = $users->orderBy($orderby, $order)->paginate(15);

        return view('users.index', ['users' => $users, 'search' => $search, 'orderby' => $orderby, 'order' => $order]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $roles = Role::all();
        return view('users.new', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function store(NewUserRequest $request)
    {
        if ($user = User::create([
                'name'     => $request->input('name'),
                'email'    => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ])){        
            //agregar role
            $user->roles()->attach($request->input('role_id'));
            $status = __('general.InsertOkMessage');
        }
        else $status = __('general.ErrorMessage');

        return redirect()->route('users.edit', ['user' => $user->id])->with('status', $status);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, UpdateUserRequest $request)
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();
        $user->roles()->sync([$request->input('role_id')]);
        return redirect()->back()->with('status',__('general.UpdateOkMessage'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @param  $destino
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('status', __('general.DeleteOkMessage'));
    }    

    /**
     * Export data to the specified format.
     *
     * @param  $exportOption
     * @param  \Illuminate\Http\Request  $request
     * @return Document XLSX, XLS, CSV
     */
    public function export($exportOption = "xlsx", Request $request)
    {
        return Excel::download(new UsersExport($request), 'users.'.$exportOption);
    }

}
