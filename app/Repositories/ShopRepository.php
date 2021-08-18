<?php

namespace App\Repositories;

use App\Models\Shop;
use Auth;
use Illuminate\Support\Facades\Storage;

class ShopRepository
{
    public function update(array $data){
        $now = date('Y-m-d H:i:s');
        $data['update_from']=Auth::user()->email;
        $data['updated_at']=$now;
        $data['bg_img']=$this->store_image(request(),'background','bg_img','bg_old_img');
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
