<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function updateNameAction(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:200|min:2',
        ]);
        $user = User::findOrFail(Auth::id());

        if ($user) {
            $user->name = $request->name;
            $user->save();
            return redirect()->route('home')->withStatus('Имя изменено на '. $request->name);
        }
        return redirect()->back()->withStatus('Ошибка изменения имени');
    }


    public function updateNamePage()
    {
        return view('user.updateName', [
            'user' => User::findOrFail(Auth::id())
        ]);
    }
}
