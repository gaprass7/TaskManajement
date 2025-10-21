<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Default redirect (kalau tidak ada role)
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Middleware setup
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Setelah login berhasil, arahkan berdasarkan role user
     */
    protected function authenticated(Request $request, $user)
{
    return $user->role === 'admin'
        ? redirect('/admin/tasks')
        : redirect('/tasks');
}
}
