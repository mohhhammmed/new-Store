<?php

namespace App\Http\Controllers\Admin\Branch;

use App\Models\Governorate;
use App\Models\Branch;
use App\Models\branch_governorate;
use App\Http\Requests\ValidBranch;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class BranchControll extends Controller
{
    public function create(){

        return view('admin.branches.create');
    }


    public function store(ValidBranch $request){
        try{

            if(isset($request)  && !empty($request)){
                $branch=Branch::create($request->all());
                return get_response(true,'Added Successfully');
            }

        }catch(\Exception $ex){
            return get_response(false,'Error');
        }
    }

    public function form_allocation(){
        $branches=Branch::select('id','branch')->where('translation_lang',locale_lang())->get();
        $governorates=Governorate::select('id','name')->where('translation_lang',locale_lang())->get();

        return view('admin.branches.branch_allocation',compact('governorates','branches'));
    }

    public function allocation(Request $request){
        try{
            if(isset($request) && !empty($request)){
                DB::beginTransaction();
                $request->validate([
                    'governorate_id'=>'numeric|exists:governorates,id',
                    'branch_id'=>"numeric|exists:branches,id",
                    'address'=>"required|string"
                ]);

                  $branch=Branch::find($request->branch_id);
                  $branch->governorates()->attach($request->governorate_id);
                  $br=branch_governorate::where('governorate_id',$request->governorate_id)->first();
                  $br->update($request->except('governorate_id','branch_id'));
                  DB::commit();
                return get_response(true,'Add Successfuly');
            }
        }catch(\Exception $ex){
            DB::rollback();
            return get_response(false,'Error');
        }

    }
}
