<?php

namespace App\Repositories;

use App\Models\merchandise;
use Auth;
use Illuminate\Support\Facades\Storage;

class MerchandiseRepository
{
    public function find($id){
        return merchandise::find($id);
    }
    public function create(array $data){
        $shop=Auth::user()->Shop_id;
        $now = date('Y-m-d H:i:s');
        $data['Shop_id']=$shop;
        $data['create_from']=Auth::user()->email;
        $data['created_at']=$now;
        $data['Product_Img']=$this->store_image(request(),'merchandise','Product_Img','Product_Old_Img');
        if(isset($data['highlight'])){
            $data['highlight']="1";
        }else{
            $data['highlight']="0";
        }
        return  merchandise::create($data);
    }

    public function update(array $data, $id){
        $now = date('Y-m-d H:i:s');
        $data['update_from']=Auth::user()->email;
        $data['updated_at']=$now;
        $data['Product_Img']=$this->store_image(request(),'merchandise','Product_Img','Product_Old_Img');
        if(isset($data['highlight'])){
            $data['highlight']="1";
        }else{
            $data['highlight']="0";
        }
        $merchan_id = merchandise::find($id);
        return  $merchan_id ? $merchan_id->update($data) : false;
    }

    public function delete($id){
        $merchan=merchandise::find($id);
        $this->delete_old_img($merchan->Product_Img);
        $d_result= merchandise::destroy($id);
        return $d_result;
    }
    public function store_image($request,$dir,$new_img,$old_img){

        if ($request->hasFile($new_img)){

            $file = $request->file($new_img);
            if ($file->isValid()){
                $extension = $file->getClientOriginalExtension();
                $path = 'Shop_Img/' . Auth::user()->Shop_id. '/' . $dir.'/' . uniqid('', true) . '.' . $extension;
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
