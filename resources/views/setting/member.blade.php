@extends('layouts.home')
@section('css')
<link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<style>

</style>
@endsection
@section('stage')
<div class="container-fluid" >
<!-- Page Heading -->
<!--<h1 class="h3 mb-2 text-light shadow-lg text-center">商品列表</h1>-->
<!--<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>-->

<!-- DataTales Example -->
<div class="card shadow mb-4 ">
  <div class="card-header py-3 d-flex flex-row ">
    <!--<h6 class="m-0 font-weight-bold text-primary">商品列表</h6>-->
    <h5 class="m-0 font-weight-bold text-success">會員一覽</h5>
    <!--<a class="btn btn-link text-secondary">匯入</a>
    <a class="btn btn-link text-secondary">匯出</a>-->
  </div>
  <div class="card-body">
    <div class="table-responsive">

      <table class="table table-hover text-center text-middle" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>帳號</th>
            <th>姓名</th>
            <th>電話</th>
            <th>email</th>
            <th>地址</th>
            <th>註冊時間</th>
            <th>上次登入</th>
          </tr>
        </thead>
        <tbody>
        @foreach($shop_config->member as $member)
        @php
            $create_dt=$member->created_at;
            $create_d = date("Y-m-d", strtotime($create_dt));
            $last_login_dt=$member->last_login;
            $last_login_d = date("Y-m-d", strtotime($last_login_dt));
        @endphp
        <tr>
            <td><span class="small">{{$member->account}}</span></td>
            <td><span class="small">{{$member->name}}</span></td>
            <td><span class="small">{{$member->member_phone}}</span></td>
            <td><span class="small">{{$member->member_email}}</span></td>
            <td><span class="small">{{$member->member_address}}</span></td>
            <td><span class="small">{{$create_d}}</span></td>
            <td><span class="small">{{$last_login_d}}</span></td>
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
<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('js/demo/datatables-demo.js')}}"></script>
<script>
window.addEventListener('load', function () {
    document.getElementById('nav_title').innerHTML="會員一覽";
});

</script>
@endsection
