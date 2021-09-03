@extends('layouts.home')

@section('css')


<link href="{{asset('vendor/Lightweight-jQuery-Color-Picker-Plugin-For-Bootstrap-Colorselector/dist/bootstrap-colorselector.min.css')}}" rel="stylesheet">
<link href="{{asset('vendor/tagify-master/dist/tagify.css')}}" rel="stylesheet">
@endsection


@section('stage')

<div class="col-sm-8">
<form  action="{{ route('menu.update', $merchan->id) }}" method="POST" enctype="multipart/form-data">
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
        <input class="form-control" type="text" name="Product_Name" placeholder="請輸入商品名稱" required="required" value="{{$merchan->Product_Name}}" maxlength="30">
      </div>
    </div>

    <div class="form-check  my-5">
        <div class="col-sm-4">
        @if($merchan->highlight)
        <input class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" name="highlight" checked>
        @else
        <input class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" name="highlight">
        @endif
        <label class="form-check-label text-primary" for="flexCheckChecked">
            加入熱門商品
        </label>
        </div>
        <small class="text-secondary ml-3">熱門商品會在首頁重點顯示</small>
    </div>

    <div class="form-group row">
        <label  class="col-sm-4 col-form-label">類別</label>
        <div class="col-sm-8">
            <select class="form-select form-control" name="Product_Category" aria-label="Default select example">

                @if($merchan->Product_Category=='none')
                <option  value="none" selected="selected">無類別</option>
                @else
                <option  value="none">無類別</option>
                @endif

                @foreach($shop_category as $category)
                    @if($merchan->Product_Category==$category->id && $merchan->Product_Category!='none')
                    <option  value="{{$category->id}}" selected="selected">{{$category->Category_Name}}</option>
                    @else
                    <option  value="{{$category->id}}">{{$category->Category_Name}}</option>
                    @endif
                @endforeach



            </select>
        </div>
    </div>



    <div class="form-group row">
      <label for="Product_Price" class="col-sm-4 col-form-label">售價</label>
      <div class="col-sm-8">
        <input class="form-control" type="number" name="Product_Price" placeholder="" value="{{$merchan->Product_Price}}" >
        <small class="text-secondary">將欄位留空留空以便稍後決定銷售價格</small>
      </div>

    </div>

    <div class="form-group row">
      <label for="Product_Model" class="col-sm-4 col-form-label">商品型號 (選填)</label>
      <div class="col-sm-8">
        <input class="" id="Product_Model" name="Product_Model"  placeholder="">
        <small class="text-secondary">商品型號請以Enter分隔</small>
      </div>

    </div>


    <div class="form-group row">
      <label for="Product_Describe" class="col-sm-4 col-form-label">商品介紹</label>
      <div class="col-sm-8">
        <textarea class="form-control"  name="Product_Describe" rows="6" placeholder="請輸入商品介紹">{{$merchan->Product_Describe}}</textarea>
      </div>
    </div>

    <div class="form-group row">
      <label for="Product_Img" class="col-sm-4 col-form-label">商品封面</label>
      <div class="col-sm-8">
      <input type="file" name="Product_Img">
      <input class="hidden_object" name="Product_Old_Img" value="{{$merchan->Product_Img}}">
      <img src="{{$merchan->Product_Img}}"  style="max-height: 20rem; max-width: 20rem;">
      <small>{{$merchan->Product_Img}}</small>
      </div>
    </div>

    <div class="form-group row">
      <label for="Product_Img" class="col-sm-4 col-form-label">更多圖片(1)</label>
      <div class="col-sm-8">
      <input type="file" name="Product_Img_others_1">
      <input class="hidden_object" name="Product_Old_Img_others_1" value="{{$merchan->Product_Img_others_1}}">
      <img src="{{$merchan->Product_Img_others_1}}"  style="max-height: 10rem; max-width: 10rem;">
      <small>{{$merchan->Product_Img_others_1}}</small>
      </div>
    </div>

    <div class="form-group row">
      <label for="Product_Img" class="col-sm-4 col-form-label">更多圖片(2)</label>
      <div class="col-sm-8">
      <input type="file" name="Product_Img_others_2">
      <input class="hidden_object" name="Product_Old_Img_others_2" value="{{$merchan->Product_Img_others_2}}">
      <img src="{{$merchan->Product_Img_others_2}}"  style="max-height: 10rem; max-width: 10rem;">
      <small>{{$merchan->Product_Img_others_2}}</small>
      </div>
    </div>

    <div class="form-group row">
      <label for="Product_Img" class="col-sm-4 col-form-label">更多圖片(3)</label>
      <div class="col-sm-8">
      <input type="file" name="Product_Img_others_3">
      <input class="hidden_object" name="Product_Old_Img_others_3" value="{{$merchan->Product_Img_others_3}}">
      <img src="{{$merchan->Product_Img_others_3}}"  style="max-height: 10rem; max-width: 10rem;">
      <small>{{$merchan->Product_Img_others_3}}</small>
      </div>
    </div>

    <div class="form-group row">
      <label for="Product_Img" class="col-sm-4 col-form-label">更多圖片(4)</label>
      <div class="col-sm-8">
      <input type="file" name="Product_Img_others_4">
      <input class="hidden_object" name="Product_Old_Img_others_4" value="{{$merchan->Product_Img_others_4}}">
      <img src="{{$merchan->Product_Img_others_4}}"  style="max-height: 10rem; max-width: 10rem;">
      <small>{{$merchan->Product_Img_others_4}}</small>
      </div>
    </div>








  </div>
</div>








<div class="form-group">

    {{--<form  action="{{ route('menu.delete', $merchan->id) }}" method="POST" enctype="multipart/form-data" class="" onsubmit="return confirm('確定要刪除此商品嗎？');">
    @csrf
        <!--<div class="col-sm-12 text-center mt-5">-->
        <button type="submit" name="delete_btn" class="btn btn-danger" >刪除</button>
        <!-- </div>-->
    </form>
    --}}
      <button type="button" id="menu_edit_delete" class="btn btn-danger" >刪除</button>
      <div class="float-right">
      <a href="{{ route('menu') }}" class="btn btn-secondary">取消</a>
        <button type="submit" class="btn btn-primary" >儲存</button>
      </div>






</div>
</form>




<!--<div class="alert alert-danger  alert-dismissible fade show" role="alert">
  <h4>提示!</h4> <strong>*</strong> 表示為必填的欄位 <br>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  </div>-->



</div>
@endsection

@section('js')
<!-- JavaScript Bundle with Popper -->

<script src="{{asset('vendor/Lightweight-jQuery-Color-Picker-Plugin-For-Bootstrap-Colorselector/dist/bootstrap-colorselector.min.js')}}"></script>
<script src="{{asset('vendor/tagify-master/dist/jQuery.tagify.min.js')}}"></script>
<script>
window.addEventListener('load', function () {
    document.getElementById('nav_title').innerHTML="編輯商品";

});
var merchan={!! json_encode($merchan) !!};
var tagify_ = $('[id=Product_Model]').tagify();
var tagify = tagify_.data('tagify');
var model=JSON.parse(merchan.Product_Model);
console.log('model',model);
if(model!=null){
    if(model.length!=0){
        model.forEach(function(item, index){
                    tagify.addTags(item.value);
        });
    }
}
$('#menu_edit_delete').click(function(){
                var r = confirm("確定要刪除此商品嗎？");
                if (r == true) {
                    $.ajax({
                        type:'POST',
                        url:'/merchandise/'+merchan.id+'/delete',
                        dataType:'json',
                        data:{
                        _token: '{{csrf_token()}}'
                        },
                        success:function(data){
                            var result=data.result;
                            if(result=='success'){
                                window.location.href = "/merchandise/menu"+"/?success_msg="+data.msg;
                            }else{
                                window.location.href = "/merchandise/menu"+"/?error_msg="+data.msg;
                            }
                        },
                        error:function(e){
                            alert('Error: ' + e);
                        }
                    });
                }

            })
</script>
@endsection



