<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

//Enables us to output flash messaging
use Session;

class UserController extends Controller
{

    public function __construct()
    {
        //isAdmin middleware lets only users with a
        //specific permission to access these resources
        $this->middleware(['auth', 'isAdmin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        ///Get all users and pass it to the view
        $users = User::all(); 
        return view('users.index')->with('users', $users);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Get all roles and pass it to the view
        $roles = Role::get();
        return view('users.create', ['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate name, email and password fields
        $this->validate(
            $request, [
                'name'=>'required|max:120',
                'email'=>'required|email|unique:users',
                'password'=>'required|min:6|confirmed'
            ]
        );
        //Retrieving only the email and password data
        $user = User::create($request->only('email', 'name', 'password'));

        $roles = $request['roles']; //Retrieving the roles field
        //Checking if a role was selected
        if (isset($roles)) {

            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                //Assigning role to user           
                $user->assignRole($role_r);
            }
        }        
        //Redirect to the users.index view and display message
        return redirect()->route('users.index')
            ->with('flash_message', 'User successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('users');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Get user with specified id
        $user = User::findOrFail($id);
        //Get all roles
        $roles = Role::get();
         //pass user and roles data to view
        return view('users.edit', compact('user', 'roles'));
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
        //Get role specified by id
        $user = User::findOrFail($id);
        
        //Validate name, email and password fields  
        $this->validate(
            $request, [
                'name'=>'required|max:120',
                'email'=>'required|email|unique:users,email,'.$id,
                'password'=>'required|min:6|confirmed'
            ]
        );
        //Retreive the name, email and password fields
        $input = $request->only(['name', 'email', 'password']);
        //Retreive all roles
        $roles = $request['roles'];
        $user->fill($input)->save();

        if (isset($roles)) {
            //If one or more role is selected associate user to roles      
            $user->roles()->sync($roles);          
        } else {
            //If no role is selected remove exisiting role associated to a user
            $user->roles()->detach();
        }
        return redirect()->route('users.index')
            ->with('flash_message', 'User successfully edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Find a user with a given id and delete
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')
            ->with('flash_message', 'User successfully deleted.');
    }
}
