<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\User;

class AuthController extends Controller
{
    // Show login form
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect('dashboard');
        }

        return view('login');
    }

    // Process login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Check if the login attempt is successful
        if (Auth::attempt($credentials)) {
            // Fetch the user with roles
            $user = User::with('roles')->find(Auth::id());

            // Check if the user has any roles
            if ($user->roles->isEmpty()) {
                return response()->json(['error' => 'User has no roles assigned'], 404);
            }

            // Store current role in session (first role by default)
            $currentRole = $user->roles->first();
            Session::put('active_role', $currentRole->name);

            // Redirect to dashboard based on the active role
            return redirect()->intended($this->getDashboardRoute($currentRole->name));
        }

        return redirect('login')->with('error', 'Invalid email or password');
    }

    // Switch role functionality
    public function switchRole(Request $request)
    {
        $newRoleId = $request->input('role_id');

        // Find the user's role
        $user = Auth::user();
        $newRole = $user->roles->where('id', $newRoleId)->first();

        if ($newRole) {
            // Update the current role in session
            Session::put('active_role', $newRole->name);

            // Optionally, switch the user's email to the one for that role
            // Assuming a table role_user with role-specific emails
            $roleEmail = DB::table('role_user')
                ->where('user_id', $user->id)
                ->where('role_id', $newRoleId)
                ->value('email');

            // Update user's email to the role-specific email
            $user->email = $roleEmail;

            // Redirect to the new role's dashboard
            return redirect()->intended($this->getDashboardRoute($newRole->name));
        }

        return redirect('dashboard')->with('error', 'Role switch failed');
    }

    // Determine the dashboard route based on role
    protected function getDashboardRoute($roleName)
    {
        switch ($roleName) {
            case 'Mahasiswa':
                return 'mhs.dashboard';
            case 'Dekan':
                return 'dekan.dashboard';
            case 'Ketua Program Studi':
                return 'kaprodi.dashboard';
            case 'Bagian Akademik':
                return 'staff.dashboard';
            case 'Pembimbing Akademik':
                return 'dosen.dashboard';
            default:
                return 'dashboard';
        }
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}