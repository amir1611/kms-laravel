<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Retrieve the user
        $user = User::find($id);

        // Update the user's information
        $user->update($request->all());

        // Determine the role-specific home route
        $homeRoute = 'user.home';
        if ($user->role === 'staff') {
            $homeRoute = 'staff.home';
        } elseif ($user->role === 'admin') {
            $homeRoute = 'admin.home';
        }

        // Redirect to the appropriate home route based on the user's role
        return redirect()->route($homeRoute);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }


    /**
     * Display the specified resource.
     */
    public function registerStaff()
    {
        // Return back to the Admin Profile page
        return view('manageProfile.registeruser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeStaff(Request $request)
    {
        \Log::info('Role received: ' . $request->role);
        
        $defaultPassword = Hash::make('1234');
        
        $staffId = null;
        $role = $request->role === 'pupuk-admin' ? 1 : 0;
        
        \Log::info('Role after conversion: ' . $role);

        if ($request->role === 'pupuk-admin') {
            $lastStaff = User::where('staff_id', 'LIKE', 'pupukAdmin%')
                ->orderBy('staff_id', 'desc')
                ->first();
                
            $staffId = $lastStaff 
                ? 'pupukAdmin' . str_pad(intval(substr($lastStaff->staff_id, 9)) + 1, 3, '0', STR_PAD_LEFT)
                : 'pupukAdmin001';
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $defaultPassword,
            'ic' => $request->ic,
            'gender' => $request->gender,
            'contact' => $request->contact,
            'role' => $role,
            'staff_id' => $staffId,
            'email_verified_at' => now()
        ]);

        return redirect()->back()->with('success', 'User registered successfully.');
    }

    public function viewUsers()
    {
        $users = User::all();
        return view('manageProfile.viewusers', compact('users'));
    }
}
