<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Profile\UpdateRequest;
use Illuminate\Http\Request;
use Hash;

class ProfileController extends Controller
{
    public function openProfilePage()
    {
        $user = auth()->user();
        return view ('auth.profile',compact('user'));
    }

    public function storeProfilePage(UpdateRequest $request)
    {
        $user = auth()->user();
        try{
            if(! $request->password){

                $user->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                ]);
            }else{
                $user->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=> Hash::make($request->password),
                ]);
            }
            $request->session()->flash('alert-success',' Profile Updated successfully');
        }
        catch(\Exception $ex){
            return back()->withErrors($ex->getMessage());
        }
        return to_route('auth.profile.index');
    }
}
