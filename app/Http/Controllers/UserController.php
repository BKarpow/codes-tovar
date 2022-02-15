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


    public function enableAdmin()
    {
        return view('user.enableAdmin', [
            'users' => User::orderBy('id', 'desc')->paginate()
        ]);
    }

    private function getUserIdForEnableAdmin(Request $request):array
    {
        return $request->validate([
            'userId' => 'required|numeric|exists:users,id',
        ]);
        
    }

    public function disableAdminAction(Request $request)
    {
        $data = $this->getUserIdForEnableAdmin($request);
        if (Auth::id() == $data['userId']) {
            return redirect()->back()->withStatus('Вы не можете изменить свой статус, извините.');
        }
        $user = User::findOrFail((int)$data['userId']);
        $user->role = 7;
        $user->save();
        return redirect()->back()->withStatus('Права администратора убрано для '. $user->email);
    }


     public function enableAdminAction(Request $request)
    {
        $data = $this->getUserIdForEnableAdmin($request);
        if (Auth::id() == $data['userId']) {
            return redirect()->back()->withStatus('Вы не можете изменить свой статус, извините.');
        }
        $user = User::findOrFail((int)$data['userId']);
        $user->role = User::ADMIN_CODE;
        $user->save();
        return redirect()->back()->withStatus('Права администратора установлено для '. $user->email);
    }


    public function updateEmailPage()
    {
        return view('user.updateEmail', [
            'user' => User::findOrFail(Auth::id())
        ]);
    }

    public function updateEmailAction(Request $request)
    {
        $d = $request->validate([
            'email' => 'required|max:120|email|unique:App\Models\User,email',
        ]);
        $user = User::findOrFail(Auth::id());
        $user->email = $d['email'];
        $user->save();
        // Выход из аккаунта при успешной смене почти
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
         return redirect('/')->withStatus('Ваш Email изменен на, войдите под ним: '. $user->email);
    }
}
