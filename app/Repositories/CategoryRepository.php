<?php

namespace App\Repositories;

use App\Models\category;
use App\Models\merchandise;
use Auth;

class CategoryRepository
{
    public function find($id){
        return  category::find($id);
    }
    public function store(array $data){
        $now = date('Y-m-d H:i:s');
        $data['Shop_id']=Auth::user()->Shop_id;
        $data['create_from']=Auth::user()->email;
        $data['created_at']=$now;
        return  category::create($data);
    }
    public function update(array $data,$id){
        $category = category::find($id);
        return  $category ? $category->update($data) : false;
    }
    public function delete($id){
        //return category::destroy($id);
        $d_result= category::destroy($id);
        if($d_result){
            $this->remove_cate_refrence($id);
        }
        return $d_result;
    }
    public function remove_cate_refrence($id){
        $data=array(
            'Product_Category'=> 'none',
        );
        merchandise::where('Shop_id', Auth::user()->Shop_id)->where('Product_Category', $id)->update($data);
    }

}
