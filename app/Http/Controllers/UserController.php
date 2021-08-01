<?php

namespace App\Http\Controllers;

use App\Models\User; // App\User クラスをインポートする
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\UpdateRequest;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::find($id); // ユーザーID:1 のユーザー情報を取得して $user 変数に代入する
        //dd($user,$user->name); // $user を出力して処理をストップする

        return view('users.show',['user' => $user]);
    }

    public function edit()
    {
        $user = Auth::user();

        return view('users.edit', ['user'=>$user]);
    }

    public function update(UpdateRequest $request)
    {
        $user = Auth::user();
        $user->fill($request->all());
        $user->save();

        return redirect()->back()->with(['message' => '更新しました！']);
    }
}