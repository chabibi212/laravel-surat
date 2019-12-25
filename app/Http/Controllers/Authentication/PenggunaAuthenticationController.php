<?php

namespace App\Http\Controllers\Authentication;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PenggunaAuthenticationRequest;

class PenggunaAuthenticationController extends Controller
{
    /**
     * Block comment
     */
    public function loginForm()
    {
        return view('authentication.pengguna.login_form');
    }

    /**
     * Block comment
     */
    public function login(
        PenggunaAuthenticationRequest $penggunaAuthenticationRequest
    ) {
        # code...
        $nip = $penggunaAuthenticationRequest->nip;
        $password = $penggunaAuthenticationRequest->password;

        $dataLogin = [
            'nip' => $nip,
            'password' => $password
        ];

        if(Auth::guard('pengguna')->attempt($dataLogin)){
            return redirect()
                ->intended();
        }

        return redirect('/autentikasi/form-login')
            ->withErrors([
                'notification' => 'Akun tidak ditemukan! Periksa kembali nip atau kata sandi.'
            ]);
    }

    /**
     * Block comment
     */
    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect('/autentikasi/form-login');
    }
}
