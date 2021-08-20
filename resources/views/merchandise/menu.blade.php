
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
<div class="container-fluid" >
<!-- Page Heading -->
<!--<h1 class="h3 mb-2 text-light shadow-lg text-center">商品列表</h1>-->
<!--<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>-->

<!-- DataTales Example -->
<div class="card shadow mb-4 ">
  <div class="card-header py-3 d-flex flex-row ">
    <!--<h6 class="m-0 font-weight-bold text-primary">商品列表</h6>-->
    <a href="{{ route('menu.create') }}" class="btn btn-success btn-icon-split mr-3">
        <i class="fas fa-plus"></i> 新增商品
    </a>
    <a class="btn btn-link text-secondary">匯入</a>
    <a class="btn btn-link text-secondary">匯出</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover text-center text-middle" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>商品名稱</th>
            <th>類別</th>
            <th>價格</th>
            <!--<th>成本</th>
            <th>利潤率</th>
            <th>有存貨</th>-->
            <th>編輯</th>
          </tr>
        </thead>
        <tbody>
          @foreach($shop_menu as $menu)
          @php
            $Product_Price = ($menu->Product_Price==null)? '-' : $menu->Product_Price;

            if($menu->Product_Category=='none'){
                $Product_Category='無類別';
            }else{
                //$Product_Category=$shop_category[$menu->Product_Category];
                $Product_Category=$menu->category->Category_Name;
            }

         @endphp
          <tr>
            <td>{{ $menu->Product_Name }}</td>
            <td>{{ $Product_Category }}</td>
            <td>{{ $Product_Price }}</td>
            <td>
            <a href="{{ route('menu.edit', $menu->id) }}"><img alt="edit" src="{{asset('img/edit.png')}}" ></a>

            </td>
          </tr>
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
    document.getElementById('nav_title').innerHTML="商品列表";
});

</script>
@endsection



