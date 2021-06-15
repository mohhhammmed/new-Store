<?php

namespace App\Http\Controllers\store\Admin\Vendors;
use App\Models\Maincategory;
use App\Models\Vendor;
use App\Http\Controllers\Controller;
use App\Notifications\VendorNotify;
use Illuminate\Http\Request;
use App\Traits\Helper;
use Str;
use App\Http\Requests\ValidVendors;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
class VendorControll extends Controller
{
        use Helper;
        public function create(){
             $maincategory= Maincategory::where('translation_lang','ar')->Active();

            return view('admin.vendors.create',compact('maincategory',$maincategory));
        }

        public function store(ValidVendors $request){
              // return Str::after($request->logo,'jpg');   //except('_token')
           try{
              DB::beginTransaction();
                if(!isset($request->action)){
                        $request->request->add(['action'=>0]);
                  }
                   $logo=$this->setPhoto($request->logo,$request->name,'store/images/vendors');

                   $arr=$request->except('logo');
                   $arr['logo']=$logo;
                 $customer= Vendor::create($arr);
                  Notification::send($customer,new VendorNotify());
               DB::commit();
                  return redirect(route('store.vendors'))->with('success','Created Done');

                 } catch(\Exception $ex){
                    // return $ex;
               DB::rollBack();
                      return redirect(route('store.vendors'))->with('error','Created Fails');
                 }
        }

        public function Vendors(){

                $vendors=Vendor::with('mainCategory')->selection();
                //  foreach($vendors as $v){
                //          echo $v->mainCategory->category;
                //  }
                //  return 'dsh' ;

             return view('admin.vendors.all_vendors',compact('vendors',$vendors));
        }

        public function delete(Vendor $vendor_id){
        //   $path=__DIR__;
           //return base_path($vendor_id->logo);
           $path= asset($vendor_id->logo);
           $p= Str::before($path,$vendor_id->logo);
        //  return $im= $p.'app/public/store/store/images/vendors/'.$vendor_id->logo;
              try{
               if(isset($vendor_id)){
                    unlink(Vendor::Image().$vendor_id->logo);

                    $vendor_id->delete();
                    return redirect(route('store.vendors'))->with('success','Deleted Done');

                  }
              }catch(\Exception $ex){
               // return $ex;
               return redirect(route('store.vendors'))->with('error','Deleted Fails');
              }

        }

        public function edit(vendor $vendor_id){
            $data_vendor=$vendor_id;
            $maincategory=Maincategory::where('translation_lang','ar')->Active();;
          return view('admin.vendors.create',compact('data_vendor','maincategory'));
        }

    public function update(Vendor $vendor_id,ValidVendors $request){
           // return $vendor_id;
        //return $request;
        $data_vendor=$vendor_id;
        if(isset($data_vendor)){
              try{
                $vendor=$request->except('logo','_token');
                            if($request->hasFile('logo')){
                                 $logo= $this->setPhoto($request->logo,$request->name,'store\images\vendors');
                                 $vendor['logo']=$logo;
                             }
                            if(!$request->has('action')){
                              $vendor['action']=0;
                             }

                         $data_vendor->update($vendor);
                         return redirect(route('store.vendors'))->with('success','Updated Done');
              }catch(\Exception $ex){
                   //return $ex;
                return redirect(route('store.vendors'))->with('error','Updated Fails');
              }

       }
    }

          public function change_statue($vendor_id){

            $vendor_data= Vendor::find($vendor_id) ;
             try{
                   if(isset($vendor_data) && $vendor_data->count() > 0 ){
                       $statue= $vendor_data->action==0 ? 1 : 0;
                       $vendor_data->action=$statue;
                       $vendor_data->save();
                       return redirect(route('store.vendors'))->with('success','The '.$vendor_data->name.' '.$vendor_data->getAction());
                   }
                }catch(\Exception $ex){
                 return $ex;
                 return redirect(route('store.vendors'))->with('error','There is problem');
                    }
          }


}
