<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

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
        
        $staffId = $this->generateUniqueStaffId();
        $role = $request->role === 'pupuk-admin' ? 1 : 0;
        
        \Log::info('Role after conversion: ' . $role);

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

    private function generateUniqueStaffId()
    {
        $prefix = 'pupukAdmin';
        $existingIds = User::where('staff_id', 'LIKE', $prefix . '%')->pluck('staff_id')->toArray();

        // Start with the first ID
        $newIdNumber = 1;

        // Generate a new ID until a unique one is found
        while (true) {
            $newStaffId = $prefix . str_pad($newIdNumber, 3, '0', STR_PAD_LEFT);
            if (!in_array($newStaffId, $existingIds)) {
                return $newStaffId; // Return the unique ID
            }
            $newIdNumber++;
        }
    }

    public function viewUsers()
    {
        $users = User::all();
        return view('manageProfile.viewusers', compact('users'));
    }
}
