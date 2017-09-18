<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Session;

class PermissionController extends Controller
{
    public function __construct()
    {
        //isAdmin middleware lets only users with a
        //specific permission permission to access these resources
        $this->middleware(['auth', 'isAdmin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get all permissions
        $permissions = Permission::all();
        
        return view('permissions.index')->with('permissions', $permissions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Get all roles
        $roles = Role::get();
        
        return view('permissions.create')->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request, [
                'name'=>'required|max:40',
            ]
        );

        $name = $request['name'];
        $permission = new Permission();
        $permission->name = $name;

        $roles = $request['roles'];

        $permission->save();
        //If one or more role is selected    
        if (!empty($request['roles'])) {
            foreach ($roles as $role) {
                //Match input role to db record
                $r = Role::where('id', '=', $role)->firstOrFail();
                //Match input permission to db record
                //FixMe: Do we really need to fetch the permission again?
                $permission = Permission::where('name', '=', $name)->first();
                $r->givePermissionTo($permission);
            }
        }

        return redirect()->route('permissions.index')
            ->with(
                'flash_message',
                'Permission '. $permission->name.' added!'
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('permissions');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        
        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $this->validate(
            $request, [
            'name'=>'required|max:40',
            ]
        );
        $input = $request->all();
        $permission->fill($input)->save();

        return redirect()->route('permissions.index')
            ->with(
                'flash_message',
                'Permission '. $permission->name.' updated!'
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        
        //Make it impossible to delete this specific permission 
        if ($permission->name == "Administer roles & permissions") {
            return redirect()->route('permissions.index')
            ->with(
                'flash_message',
                'Cannot delete this Permission!'
            );
        }
        
        $permission->delete();

        return redirect()->route('permissions.index')
            ->with(
                'flash_message',
                'Permission deleted!'
            );
    }
}
