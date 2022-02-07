<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UpdatePasswordController extends Controller
{
    


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function pageUpdate()
    {
        return view('auth.passwords.update');
    }

    public function update(UpdatePasswordRequest $request)
    {
        $user = User::findOrFail(auth()->id());
        if ( !Hash::check($request->password, $user->password) ) {
            return redirect()->back()->withStatus('Неправельний поточний пароль');
        }
        $user->password = Hash::make($request->password_new);
        $user->save();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->withStatus('Пароль змінено, сесію скинуто, звйдіть під ноаим паролем');
    }
}
