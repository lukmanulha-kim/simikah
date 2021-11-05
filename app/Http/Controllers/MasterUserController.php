<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class MasterUserController extends Controller
{
    public function data()
    {
        $user = DB::table('users')
                        ->get();
        return view('master.user.data', ['dataUser' => $user]);
    }

    public function add()
    {   
        
    }

    public function addProsses(Request $request)
    {
        $data = $request->input();
        DB::table('users')->insert([
            'name' => $data['nama'],
            'level' => $data['level'],
            'email' => $data['username'],
            'password' => bcrypt($data['password']),
            'remember_token' => Str::random(60)
        ]);
        return redirect('master/user');
    }

    public function edit($id)
    {   
        $user = DB::table('users')
                        ->where('id', '=', $id)
                        ->get();
        return view('master.user.edit', ['dataUser' => $user]);
    }

    public function update(Request $request)
    {
        $data = $request->input();
        if($data['password']==null){
            DB::table('users')
                ->where('id', '=', $data['id'])
                ->update([
                'name' => $data['name'],
                'email' => $data['username'],
                'level' => $data['level']
            ]);
        }else{
            DB::table('users')
                ->where('id', '=', $data['id'])
                ->update([
                'name' => $data['name'],
                'email' => $data['username'],
                'password' => bcrypt($data['password']),
                'level' => $data['level']
            ]); 
        }
        return redirect('master/user');
    }
}
