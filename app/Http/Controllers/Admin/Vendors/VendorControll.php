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
             $maincategory= Maincategory::where('translation_lang',app()->getLocale())->Active();
            $admin=Auth::guard('admin')->user();
            return view('admin.vendors.create',compact('maincategory',$maincategory,'admin'));
        }

        public function store(ValidVendors $request){

           try{
              DB::beginTransaction();
              if( isset($request) && !empty($request)) {
                  if (!isset($request->statue)) {
                      $request->request->add(['statue' => 0]);
                  }
                  $logo = $this->setPhoto($request->logo, $request->name, 'admin/images/vendors');

                  $arr = $request->except('logo');
                  $arr['logo'] = $logo;
                $customer= Vendor::create($arr);
                   Notification::send($customer,new VendorNotify());
                  DB::commit();
                  return response()->json([
                      'statue'=>true,
                      'msg'=>'Created Done'
                  ]);

              }
                 } catch(\Exception $ex){
                    return $ex;
               DB::rollBack();
               return response()->json([
                   'statue'=>false,
                   'msg'=>'Created false'
               ]);

           }
        }

        public function Vendors(){
            $admin=Auth::guard('admin')->user();
             $vendors=Vendor::with(['maincategory'=>function($q){
                  $q->select('id','category','translation_lang');
              }])->selection()->paginate(paginate_count);
             return view('admin.vendors.all_vendors',compact('vendors','admin'));
        }

        public function delete(Request $request){

            $vendor=Vendor::find($request->id);

              try{
               if(isset($vendor)&& $vendor!=null){
                   if(file_exists(Vendor::PathImage().$vendor->logo) && $vendor->logo !=null) {
                       unlink(Vendor::PathImage() . $vendor->logo);
                   }
                    $vendor->delete();
                   return response()->json([
                       'statue'=>true,
                       'msg'=>'Deleted Done Reload Page '
                   ]);
                  }
                  return response()->json([
                      'statue'=>false,
                      'msg'=>'Not  Exists'
                  ]);
              }catch(\Exception $ex){
             //return $ex;
                  return response()->json([
                      'statue'=>false,
                      'msg'=>'There Is Error'
                  ]);
              }

        }

        public function form_edit($vendor_id){
           try{
               $vendor=vendor::find($vendor_id);
               if(isset($vendor) && !empty($vendor)) {
                   $lang = $vendor->maincategory->translation_lang;
                   $admin = Auth::guard('admin')->user();
                   $maincategory = Maincategory::Active()->where('translation_lang', $lang);;
                   return view('admin.vendors.create', compact('admin', 'vendor', 'maincategory'));
               }
               return redirect(route('all_vendors'))->with('error','Not Exists');
           }catch(\exception $ex){
               return $ex;
               return redirect(route('all_vendors'))->with('error','There Is Error');
           }

        }

    public function edit(ValidVendors $request){
              try{
                  $vendor=Vendor::find($request->id);

                  if(isset($vendor)&& isset($request)&& !empty($request) && $vendor !=null){
                   $up_vendor=$request->except('logo','_token');
                            if($request->hasFile('logo')){
                                if(file_exists(Vendor::PathImage().$vendor->logo) && $vendor->logo!=null ){
                                    unlink(Vendor::PathImage().$vendor->logo);
                                }
                                 $logo= $this->setPhoto($request->logo,$request->name,'admin\images\vendors');
                                $up_vendor['logo']=$logo;
                             }
                            if(!$request->has('statue')){
                                $up_vendor['statue']=0;
                             }

                         $vendor->update($up_vendor);
                         return response()->json([
                             'statue'=>true,
                             'msg'=>'updated Done'
                         ]);
              }
              }catch(\Exception $ex){

                  return response()->json([
                      'statue'=>false,
                      'msg'=>'There Is error'
                  ]);
              }


    }

          public function change_statue(Request $request){

         // return $request;
             try{
                 if(isset($request) && !empty($request) )
                {
                    $vendor = Vendor::find($request->id);

                    if (isset($vendor) && $vendor != null) {
                        $statue = $vendor->statue == 0 ? 1 : 0;
                        $vendor->statue = $statue;
                        $vendor->save();

                        return response()->json([
                            'statue' => true,
                            'msg' => $vendor->name . ' is ' . $vendor->getStatue() . ' reload page',
                        ]);
                    }
                    return response()->json([
                        'statue' => false,
                        'msg' => 'Not Exists',
                    ]);
                }

                }catch(\Exception $ex){
                 return $ex;
                 return response()->json([
                     'statue'=>false,
                     'msg'=>'There Is Error',
                 ]);
                    }
          }


}
