<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserPasswordMail;
use App\Models\User;
use App\Models\Dentist;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\UserRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends Controller
{
    use AuthorizesRequests;

    public function __construct(){
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles','permissions')
                    ->withCount('permissions')
                    ->latest()
                    ->get();
        
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('user.create', compact('roles','permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $password = Str::random(10);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $password,
            'name' => $request->name,
            'phone' => $request->phone,
            'gender' => $request->gender,
        ]);

        $user->assignRole($request->role);

        if($request->filled('permissions')) {
            $user->givePermissionTo($request->permissions);
        }

        if($request->role === 'dentist') {
            Dentist::create([
                'id' => $user->id,
                'specialty' => $request->specialty,
                'years_of_experience' => $request->years_of_experience,
            ]);
        }

        Mail::to($user->email)->send(new NewUserPasswordMail($user, $password));

        return redirect()->route('users.index')->with('User Created Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('user.edit', [
            'user' => $user,
            'roles' => $roles,
            'permissions' => $permissions,
            'userRole' => $user->roles->pluck('name')->first(),
            'userPermissions' => $user->permissions->pluck('name')->toArray(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();

        $user->update([
            'username' => $data['username'],
            'email' => $data['email'],
            'name' => $data['name'],
            'phone' => $data['phone'],
            'gender' => $data['gender'],
        ]);

        //update Role
        if(isset($data['role'])) {
            $user->syncRoles([$data['role']]);

            //if the user is no longer a dentist, delete the record from the dentists table.
            if($data['role'] ==! 'dentist' && $user->dentist) {
                $user->dentist->delete();
            }

            //if the user has become a dentist, we will either update or create the record.
            if ($data['role'] === 'dentist') {
                $user->dentist()->updateOrCreate(
                    ['id' => $user->id],
                    [
                        'specialty' => $data['specialty'] ?? null,
                        'years_of_experience' => $data['years_of_experience'] ?? null,
                    ]
                    );
            }
        }
        //update permissions
        if ($request->filled('permissions')){
            $user->syncPermissions($data['permissions']);
        }else{
            $user->syncPermissions([]);
        }

        return redirect()->route('users.index',$user)->with('User Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return to_route('users.index')
                ->with('User Deleted Successfully');
    }
}
