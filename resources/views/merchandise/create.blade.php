@extends('layouts.home')

@section('css')


<link href="{{asset('vendor/Lightweight-jQuery-Color-Picker-Plugin-For-Bootstrap-Colorselector/dist/bootstrap-colorselector.min.css')}}" rel="stylesheet">
<link href="{{asset('vendor/tagify-master/dist/tagify.css')}}" rel="stylesheet">
@endsection


@section('stage')
<div class="col-sm-8">
<form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<!-- Page Heading -->
<!--<h1 class="h3 mb-2 text-primaryback">商標圖樣資料一覽</h1>-->
<!--<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>-->

<!-- DataTales Example -->
<div class="card shadow mb-4 ">
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    <h5 class="m-0 font-weight-bold text-success">商品資訊</h5>
  </div>
  <div class="card-body">


    <div class="form-group row">
      <label for="Product_Name" class="col-sm-4 col-form-label">商品名稱<font color="#FF0000">*</font></label>
      <div class="col-sm-8">
        <input class="form-control" type="text" name="Product_Name" placeholder="請輸入商品名稱" required="required" value="" maxlength="30">
      </div>
    </div>

    <div class="form-check  my-5">
        <div class="col-sm-4"><input class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" name="highlight" checked>
        <label class="form-check-label text-primary" for="flexCheckChecked">
            加入熱門商品
        </label>
        </div>
        <small class="col-sm-4 text-secondary">熱門商品會在首頁重點顯示</small>
    </div>



    <div class="form-group row">
        <label  class="col-sm-4 col-form-label">類別</label>
        <div class="col-sm-8">
            <select class="form-select form-control" name="Product_Category" aria-label="Default select example">

                <option  value="none">無類別</option>
                @foreach($shop_category as $category)
                <option  value="{{$category->id}}">{{$category->Category_Name}}</option>
                @endforeach


            </select>
        </div>
    </div>


    <div class="form-group row">
      <label for="Product_Price" class="col-sm-4 col-form-label">售價</label>
      <div class="col-sm-8">
        <input class="form-control" type="number" name="Product_Price" placeholder=""  >
        <small class="text-secondary">將欄位留空留空以便稍後決定銷售價格</small>
      </div>

    </div>

    <div class="form-group row">
      <label for="Product_Model" class="col-sm-4 col-form-label">商品型號 (選填)</label>
      <div class="col-sm-8">
        <input class="" id="Product_Model" name="Product_Model"  placeholder="" value="">
        <small class="text-secondary">商品型號請以Enter分隔</small>
      </div>

    </div>

    <div class="form-group row">
      <label for="Product_Describe" class="col-sm-4 col-form-label">商品介紹</label>
      <div class="col-sm-8">
        <textarea class="form-control"  name="Product_Describe" rows="6" placeholder="請輸入商品介紹">
        </textarea>
      </div>
    </div>



    <div class="form-group row">
      <label for="Product_Img" class="col-sm-4 col-form-label">商品圖片</label>
      <div class="col-sm-8">
      <input type="file" name="Product_Img">
      </div>
    </div>








  </div>
</div>





<div class="form-group">
      <div class="float-right">
      <a href="{{ route('menu') }}" class="btn btn-secondary">取消</a>
        <button type="submit" class="btn btn-primary">儲存</button>
      </div>
</div>



</form>





</div>
@endsection

@section('js')
<!-- JavaScript Bundle with Popper -->

<script src="{{asset('vendor/Lightweight-jQuery-Color-Picker-Plugin-For-Bootstrap-Colorselector/dist/bootstrap-colorselector.min.js')}}"></script>
<script src="{{asset('vendor/tagify-master/dist/jQuery.tagify.min.js')}}"></script>
<script>
window.addEventListener('load', function () {
    document.getElementById('nav_title').innerHTML="創建商品";
});
var tagify_ = $('[id=Product_Model]').tagify();
var tagify = tagify_.data('tagify');
</script>
@endsection



