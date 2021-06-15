<?php

namespace App\Http\Controllers\Admin\Vendors;
use App\Models\Maincategory;
use App\Models\Vendor;
use App\Http\Controllers\Controller;
use App\Notifications\VendorNotify;
use Illuminate\Http\Request;
use App\Traits\Helper;
use Illuminate\Support\Facades\Auth;
use Str;
use App\Http\Requests\ValidVendors;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
class VendorControll extends Controller
{
        use Helper;
        public function create(){
             $maincategory= Maincategory::where('translation_lang','ar')->Active();
            $admin=Auth::guard('admin')->user();
            return view('admin.vendors.create',compact('maincategory',$maincategory,'admin'));
        }

        public function store(ValidVendors $request){

           try{
              DB::beginTransaction();
                if(!isset($request->action)){
                        $request->request->add(['action'=>0]);
                  }
                   $logo=$this->setPhoto($request->logo,$request->name,'admin/images/vendors');

                   $arr=$request->except('logo');
                   $arr['logo']=$logo;
                  Vendor::create($arr);
                 // Notification::send($customer,new VendorNotify());
               DB::commit();
                  return redirect(route('admin_vendors'))->with('success','Created Done');

                 } catch(\Exception $ex){
                   //  return $ex;
               DB::rollBack();
                      return redirect(route('admin_vendors'))->with('error','Created Fails');
                 }
        }

        public function Vendors(){
            $admin=Auth::guard('admin')->user();
                $vendors=Vendor::with('mainCategory')->selection()->paginate(paginate_count);
                //  foreach($vendors as $v){
                //          echo $v->mainCategory->category;
                //  }
                //  return 'dsh' ;

             return view('admin.vendors.all_vendors',compact('vendors','admin'));
        }

        public function delete($vendor_id){
            $vendor=Vendor::find($vendor_id);

              try{
               if(isset($vendor)&& $vendor!=null){
                   if(file_exists(Vendor::Image().$vendor->logo) && $vendor->logo !=null) {
                       unlink(Vendor::Image() . $vendor->logo);
                   }
                    $vendor->delete();
                    return redirect(route('admin_vendors'))->with('success','Deleted Done');

                  }
              }catch(\Exception $ex){
                return $ex;
               return redirect(route('admin_vendors'))->with('error','Deleted Fails');
              }

        }

        public function edit(vendor $vendor_id){
            $data_vendor=$vendor_id;
            $admin=Auth::guard('admin')->user();
            $maincategory=Maincategory::where('translation_lang','ar')->Active();;
          return view('admin.vendors.create',compact('admin','data_vendor','maincategory'));
        }

    public function update($vendor_id,ValidVendors $request){
         $vendor=Vendor::find($vendor_id);
        $data_vendor=$vendor;
        if(isset($data_vendor)&& isset($request) && $data_vendor !=null){
              try{
                $vendor=$request->except('logo','_token');
                            if($request->hasFile('logo')){
                                 $logo= $this->setPhoto($request->logo,$request->name,'admin\images\vendors');
                                 $vendor['logo']=$logo;
                             }
                            if(!$request->has('action')){
                              $vendor['action']=0;
                             }

                         $data_vendor->update($vendor);
                         return redirect(route('admin_vendors'))->with('success','Updated Done');
              }catch(\Exception $ex){
                   return $ex;
                return redirect(route('admin_vendors'))->with('error','Updated Fails');
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
                       return redirect(route('admin_vendors'))->with('success','The '.$vendor_data->name.' '.$vendor_data->getAction());
                   }
                }catch(\Exception $ex){
              //   return $ex;
                 return redirect(route('admin_vendors'))->with('error','There is problem');
                    }
          }


}
