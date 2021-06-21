<?php

namespace App\Http\Controllers\Admin\Requests;

use App\Http\Controllers\Controller;
use App\Models\CategoryOfSeller;
use App\Models\Notify;
use Illuminate\Http\Request;

class RequestControll extends Controller
{
    public function requests(){

     $requests= CategoryOfSeller::Selection()->paginate(paginate_count);
     if(isset($requests)&& $requests->count() > 0){
         $notify=Notify::find(1);
         if(isset($notify) && $notify->count() >0){
             $notify->update([
                 'counter'=>0,
             ]);
         }
         return view('admin.requests.all_requests',compact('requests'));
     }
    }

    public function delete(Request $request){
        try{
            if(isset($request) && !empty($request)){
                $req=CategoryOfSeller::find($request->id);
                if(isset($req) && $req != null){
                    $req->delete();
                    return response()->json([
                        'statue'=>true,
                        'msg'=>'Deleted Done'
                    ]);
                }
                return response()->json([
                    'statue'=>false,
                    'msg'=>'Not Exists'
                ]);

            }
        }catch(\Exception $ex){
            return $ex;
            return response()->json([
                'statue'=>false,
                'msg'=>'There Is Error '
            ]);
        }

    }
}
