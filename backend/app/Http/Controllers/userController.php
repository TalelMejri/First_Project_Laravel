<?php

namespace App\Http\Controllers;

use App\Models\user_made;
/***add link */
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;

class userController extends Controller
{
    /** StorePostRequest to verified it in requests StorePostRequest*/
    public function create(StorePostRequest $request){

        $file_name = time().'_'.$request->file->getClientOriginalName();
        $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');

        /*$file_identity=time().'_'.$request->file_identity->getClientOriginalName();
        $file_path_identity = $request->file('file_identity')->storeAs('uploads', base64_decode($file_identity), 'public');*/

        $user=user_made::create(
            [
                "name"=>$request->input("name"),
                "email"=>$request->input("email"),
                "date_naissance"=>$request->input("date_naissance"),
                "avatar"=>'/storage/' . $file_path,
                "photo_identity"=>$request->input("file_identity"),
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
    }

    public function update(int $id,Request $request){
        if($request->upload_image==1){
            $file_name = time().'_'.$request->file->getClientOriginalName();
            $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');
           }
        $user=user_made::find($id);
        if(!$user){
            return response()->json(["message"=>"user not found"],404);
        }else{
            if(user_made::where("email",$request->email)->where("id","<>",$id)->count()>0){
                return response()->json(["message"=>"Email already in use"], 400);
            }
            else{
                 if($request->upload_image==1){
                    $user->update(
                        [
                            "name"=>$request->input('name'),
                            "email"=>$request->input('email'),
                            "date_naissance"=>$request->input('date_naissance'),
                            "avatar"=>'/storage/' . $file_path
                        ],
                    );
                 }else{
                $user->update(
                    [
                        "name"=>$request->input('name'),
                        "email"=>$request->input('email'),
                        "date_naissance"=>$request->input('date_naissance'),
                    ],
                );
                }
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
            $user=user_made::where("name",'like','%'.$request->search.'%')->paginate(2);
        }else{
            $user=user_made::paginate(2);
        }
        return response()->json($user, 200);
    }

}
