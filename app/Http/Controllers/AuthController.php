<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Teacher;
use App\Models\Apprentice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showApprenticeAccess()
    {
        return view('Auth.apprentice-access');
    }

    public function apprenticeAccess(Request $request)
    {
        $validated = $request->validate([
            'document_type' => 'required|in:CC,TI,PAS',
            'document_number' => 'required|string|max:30',
            'password' => 'required|string',
        ]);

        $user = User::where('document_type', $validated['document_type'])
            ->where('document_number', $validated['document_number'])
            ->first();

        if ($user && Hash::check($validated['password'], $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->intended(route('apprentices.index'));
        }

        $teacher = Teacher::where('document_number', $validated['document_number'])
            ->where('access_code', $validated['password'])
            ->first();

        if ($teacher) {
            $request->session()->regenerate();
            $request->session()->put('instructor_id', $teacher->id);
            return redirect()->intended(route('apprentices.index'));
        }

        $apprentice = Apprentice::where('document_type', $validated['document_type'])
            ->where('document_number', $validated['document_number'])
            ->first();

        if ($apprentice && $apprentice->password && Hash::check($validated['password'], $apprentice->password)) {
            $request->session()->regenerate();
            $request->session()->put('apprentice_id', $apprentice->id);
            return redirect()->intended(route('apprentices.index'));
        }

        return back()->withErrors(['document_number' => 'Los datos de acceso no coinciden con un registro autorizado.'])->withInput();
    }
    /**
     * Show login form
     */
    public function showLogin()
    {
        return view('Auth.login');
    }

    /**
     * Handle login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $request->session()->forget('instructor_id');
            return redirect()->intended('/')->with('success', 'Bienvenido');
        }

        $teacher = Teacher::where('email', $credentials['email'])
            ->where('access_code', $credentials['password'])
            ->first();

        if ($teacher) {
            $request->session()->regenerate();
            $request->session()->put('instructor_id', $teacher->id);

            return redirect()->route('teachers.index')->with('success', 'Bienvenido, instructor.');
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    /**
     * Show register form
     */
    public function showRegister()
    {
        return view('Auth.register');
    }

    /**
     * Handle register
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Registro exitoso. Bienvenido');
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->forget('instructor_id');

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Sesión cerrada correctamente.');
    }
}
