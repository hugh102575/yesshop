
@extends('layouts.home')

@section('css')
<link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<style>
img {
  opacity: 0.7;
}
</style>
@endsection


@section('stage')
    @if(session()->has('success_msg'))
        <div class="alert alert-success">
            {{ session()->get('success_msg') }}
        </div>
    @endif
    @if(session()->has('error_msg'))
        <div class="alert alert-danger">
            {{ session()->get('error_msg') }}
        </div>
    @endif
<form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
@csrf
<div class="modal fade" id="CategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
      <!--<div class="modal-header">
        <h5 class="modal-title">新增類別</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>-->
        <div class="modal-body">
            <div class="container-fluid">
                <div class="form-group">
                    <label for="Category_Name" class="font-weight-bold text-success">類別名稱</label>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="Category_Name" placeholder="請輸入類別名稱" required="required" value="" maxlength="30">
                </div>
                <div class="form-group">
                <div class="float-right">
                <a href="#" class="btn btn-secondary" id="category_store_cancel">取消</a>
                <button type="submit" class="btn btn-primary">儲存</button>
                </div>
                </div>
            </div>
        </div>
      </div>
  </div>
</div>

</form>



<div class="modal fade" id="CategoryModal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
      <!--<div class="modal-header">
        <h5 class="modal-title">新增類別</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>-->
        <div class="modal-body">
            <div class="container-fluid">
                <div class="form-group">
                    <label for="Category_Name" class="font-weight-bold text-success">類別名稱</label>
                </div>

                <div class="form-group">
                    <input class="form-control" id="Category_Name_edit" type="text" name="Category_Name" placeholder="請輸入類別名稱" required="required" value="" maxlength="30">
                </div>
                <div class="form-group ">
                <button type="button" class="btn btn-danger" id="category_edit_delete">刪除</button>
                <div class="float-right">
                <a href="#" class="btn btn-secondary" id="category_edit_cancel">取消</a>
                <button type="button" class="btn btn-primary" id="category_edit_submit">儲存</button>
                </div>
                </div>
            </div>
        </div>
      </div>
  </div>
</div>


<div class="container-fluid " >
<!-- Page Heading -->
<!--<h1 class="h3 mb-2 text-light shadow-lg text-center">商品列表</h1>-->
<!--<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>-->

<!-- DataTales Example -->
<div class="card shadow mb-4 col-lg-8 container">
  <div class="card-header py-3 d-flex flex-row ">
    <!--<h6 class="m-0 font-weight-bold text-primary">商品列表</h6>-->
    <!--<a href="" type="button" class="btn btn-success btn-icon-split mr-3">
        <i class="fas fa-plus"></i> 新增類別
    </a>-->

    <button type="button" class="btn btn-success btn-icon-split mr-3" data-target="#CategoryModal" data-toggle="modal"><i class="fas fa-plus"></i> 新增類別 </button>
    </a>
  </div>
  <div class="card-body">
  <div class="table-responsive">
      <table class="table  table-hover text-center text-middle" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>類別名稱</th>
            <th>商品數量</th>
            <th>編輯</th>
            <!--<th>刪除</th>-->
            <th class="hidden_object"></th>
          </tr>
        </thead>
        <tbody>

        @foreach($shop_category as $category)
        @php
        $category_amount=count($category->merchandise);
        @endphp
        <tr>
            <td>{{ $category->Category_Name }}</td>
            <td>{{ $category_amount}}</td>
            <td class="category_edit_btn"><a href="#"><img alt="edit" src="{{asset('img/edit.png')}}"  data-target="#CategoryModal_edit" data-toggle="modal"></a></td>
            <!--<td>

                <form action="{{ route('category.delete', $category->id) }}" method="POST" onsubmit="return confirm('是否確定要刪除此類別?');">
                    @csrf
                    <button name="img" class="btn border-0" style="padding: 0px;margin: 0px;"> <img  src="{{asset('img/delete.png')}}"></button>
                </form>

            </td>-->


            <td class="category_edit_id hidden_object">{{ $category->id }}</td>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>
@endsection

@section('js')
<!-- Page level plugins -->
<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('js/demo/datatables-demo.js')}}"></script>

<script>
window.addEventListener('load', function () {
    document.getElementById('nav_title').innerHTML="類別";
    $('#category_store_cancel').click(function() {
        $('#CategoryModal').modal('hide');
    });
    $('#category_edit_cancel').click(function() {
        $('#CategoryModal_edit').modal('hide');
    });
});
var shop_category={!! json_encode($shop_category) !!};
console.log('shop_category',shop_category)
var category_edit_btn=document.querySelectorAll('.category_edit_btn');
var category_edit_id=document.querySelectorAll('.category_edit_id');


category_edit_btn.forEach(function(item,index){
    item.addEventListener('click', function(){

        c_id=category_edit_id[index].innerHTML;
        var where=shop_category.findIndex(x => x.id==c_id);
        if(where!=-1){

        //console.log('this_c_id',shop_category[where].id)
        //console.log('this_c_name',shop_category[where].Category_Name)
        document.getElementById('Category_Name_edit').value=shop_category[where].Category_Name;

            $('#category_edit_submit').click(function(){
                var new_name=document.getElementById('Category_Name_edit').value;
                $.ajax({
                    type:'POST',
                    url:'/merchandise/category/'+c_id+'/update',
                    dataType:'json',
                    data:{
                    'Category_Name':new_name,
                    _token: '{{csrf_token()}}'
                    },
                    success:function(data){
                        var result=data.result;
                        if(result=='success'){
                            window.location.href = "/merchandise/category"+"/?success_msg="+data.msg;
                        }else{
                            window.location.href = "/merchandise/category"+"/?error_msg="+data.msg;
                        }
                       //window.location.href = "/merchandise/category";
                    },
                    error:function(e){
                        alert('Error: ' + e);
                    }
                });
            })

            $('#category_edit_delete').click(function(){
                var r = confirm("是否確定要刪除此類別?");
                if (r == true) {
                    $.ajax({
                        type:'POST',
                        url:'/merchandise/category/'+c_id+'/delete',
                        dataType:'json',
                        data:{
                        _token: '{{csrf_token()}}'
                        },
                        success:function(data){
                            var result=data.result;
                            if(result=='success'){
                                window.location.href = "/merchandise/category"+"/?success_msg="+data.msg;
                            }else{
                                window.location.href = "/merchandise/category"+"/?error_msg="+data.msg;
                            }
                        //window.location.href = "/merchandise/category";
                        },
                        error:function(e){
                            alert('Error: ' + e);
                        }
                    });
                }

            })
        }
    });
});





</script>
@endsection



