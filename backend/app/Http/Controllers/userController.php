<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/***add link */
use App\Models\user_made;
class userController extends Controller
{

    public function create(Request $request){
        $user=user_made::create(
            [
                "name"=>$request->input("name"),
                "email"=>$request->input("email"),
            ]
        );
        return  response()->json(["data"=>$user],200);
    }

    public function get_all(){
        $user=user_made::all();
        if(!$user){
            return  response()->json(["message"=>"user nor found"]);
        }
        return response()->json(["data"=>$user],200);
    }


    /*public function updateuser  (Request $request, int $id)
    {
        $humane = Humans::find($id);
        $humane->first_name = $request->first_name;
        $humane->last_name = $request->last_name;
        $humane->dob = $request->dob;
        $humane->save();
        return $humane;
    }*/

    public function update(Request $request,int $id){
        $user=user_made::find($id);
        if(!$user){
            return response()->json(["message"=>"user not found"],404);
        }else{
            $user->update(
                [
                    "name"=>$request->input('name'),
                    "email"=>$request->input('email'),
                ],
            );
            return response()->json(["data"=>$user],200);
        }
    }

    public function destroy(int $id){
        $user=user_made::find($id);
        if(!$user){
            return response()->json(["message"=>"user not found"], 404);
        }
        $user->delete();
        return  response()->json(["message"=>"User delete successfully"], 200);
    }

}
