<?php

namespace App\Http\Controllers;

use App\Models\user_made;
/***add link */
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;

class userController extends Controller
{
    /** StorePostRequest to verified it in requests StorePostRequest*/
    public function create(Request $request){
        $file_name = time().'_'.$request->file->getClientOriginalName();
        $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');

        $user=user_made::create(
            [
                "name"=>$request->input("name"),
                "email"=>$request->input("email"),
                "date_naissance"=>$request->input("date_naissance"),
                "avatar"=>'/storage/' . $file_path
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

    public function find_by_id(int $id){
        $user=user_made::find($id);
        if(!$user){
            return  response()->json(["message"=>"user nor found"]);
        }
        return response()->json(["data"=>$user],200);
    }

    public function search($search){
        $user=user_made::where("name",'like','%'.$search.'%')->get();
           if(!$user){
                return response()->json(['message'=>'User Not Found'],400);
            }else{
                return  response()->json(['data'=>$user], 200);
            }
        //}
        /*$search=$request->get('champ_search');
        $user= user_made::where('name','%'.$search.'%')->get();
        if(!$user){
            return  response()->json(["message"=>"user nor found"],401);
        }else{
            return response()->json(["data"=>$user],200);
        }*/

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
            if(user_made::where("email",$request->email)->where("id","<>",$id)->count()>0){
                return response()->json(["message"=>"Email already in use"], 400);
            }
            else{
                $user->update(
                    [
                        "name"=>$request->input('name'),
                        "email"=>$request->input('email'),
                        "date_naissance"=>$request->input('date'),
                    ],
                );
                return response()->json(["data"=>$user],200);
            }
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

    public function recover(Request $request){
        if(isset($request->search)){
            $user=user_made::where("name",'like','%'.$request->search.'%')->paginate(5);
        }else{
            $user=user_made::paginate(5);
        }
        return response()->json($user, 200);
    }

}
