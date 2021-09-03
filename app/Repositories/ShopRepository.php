<?php

namespace App\Repositories;

use App\Models\Shop;
use Auth;
use Illuminate\Support\Facades\Storage;

class ShopRepository
{
    public function update($request,array $data){
        $now = date('Y-m-d H:i:s');
        if($request->has('bg_old_img')){
            if($request->has('del_bg_btn')){
                $this->delete_old_img($data['bg_old_img']);
                $data['bg_img']=null;
            }else{
                $data['bg_img']=$this->store_image(request(),'background','bg_img','bg_old_img');
            }
        }
        $data['update_from']=Auth::user()->email;
        $data['updated_at']=$now;
        $result = Shop::find(Auth::user()->Shop_id);
        return  $result ? $result->update($data) : false;
    }
    public function store_image($request,$dir,$new_img,$old_img){

        if ($request->hasFile($new_img)){

            $file = $request->file($new_img);
            if ($file->isValid()){
                $extension = $file->getClientOriginalExtension();
                $path = 'Shop_Img/' . Auth::user()->Shop_id. '/' . $dir .'/'. uniqid('', true) . '.' . $extension;
                Storage::disk('public')->put($path, $request->file($new_img)->get());
                if (Storage::disk('public')->exists($path)){
                    $image_path = '/storage'.'/'.$path;
                    if ($request->has($new_img)) {
                        $this->delete_old_img($request->input($old_img));
                    }
                }
            }
        }else{
            if ($request->has($old_img)) {
                $image_path=$request->input($old_img);
            }else{
                $image_path=null;
            }
        }
        return $image_path;
    }
    public function delete_old_img($old_path){
        $oldurl = str_replace("/storage"."/", "", $old_path);
        if (Storage::disk('public')->exists($oldurl)) {
            Storage::disk('public')->delete($oldurl);
        }
    }
}
