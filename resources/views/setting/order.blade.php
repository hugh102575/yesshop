
@extends('layouts.home')

@section('css')
<link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<style>
.enlarge_text_btn{
    font-size: x-large !important;
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



    <h5 class="font-weight-bold text-success mr-5">訂單管理</h5>

    <button class="btn btn-link show_btns shadow-none" type="button" id="show_unfinished_btn"><small>顯示未完成</small></button>
    <button class="btn btn-link show_btns shadow-none" type="button" id="show_finished_btn"><small>顯示已完成</small></button>
    <button class="btn btn-link show_btns shadow-none" type="button" id="show_all_btn"><small>顯示全部</small></button>
  </div>
  <div class="card-body">
    <div class="table-responsive">
    {{--{{$shop_config->order}}
    MEMBERRRR{{$shop_config->member}}--}}
      <table class="table table-hover text-center text-middle" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>訂購日期</th>
            <th>會員帳號</th>
            <!--<th>收件人姓名</th>-->
            <!--<th>購買內容</th>-->
            <th>總金額</th>
            <th>付款</th>
            <th>出貨</th>
            <th>收貨</th>
            <th>訂單完成</th>
            <th>管理訂單</th>
          </tr>
        </thead>
        <tbody>
        @php
        $shop_order=array_reverse(json_decode($shop_config->order));
        @endphp
        @foreach($shop_order as $order)
          @php
          $datetime=$order->created_at;
          $newDate = date("Y-m-d", strtotime($datetime));
          foreach($shop_config->member as $member){
            if($order->Member_id == $member->id){
                $order_account =$member->account;
                break;
            }
          }
          @endphp
          <tr>
            <td><span class="small">{{ $newDate }}</span></td>
            <td><span class="small">{{$order_account}}</span></td>
            <!--<td><span class="small">{{ $order->order_name }}</span></td>-->
            <!--<td></td>-->
            <td><pre>${{ $order->order_price }}</pre></td>
            <td>
                @if($order->payed_status=='1' || $order->payed_pending=='1')
                    @if($order->payed_status=='1')
                    <span class="text-success small font-weight-bold">已付款</span>
                    @endif
                    @if($order->payed_pending=='1')
                    <span class="text-info small font-weight-bold">等待確認</span>
                    @endif
                <!--<div class="mb-1">
                <span class="text-success small">已付款</span>
                </div>
                <span class="text-primary small">轉帳後五碼:{{ $order->payed_card }}</span>-->
                @else
                <span class="text-danger small font-weight-bold">未付款</span>
                @endif
            </td>
            <td>
                @if($order->shipped_status=='1')
                <span class="text-success small font-weight-bold">已出貨</span>
                @else
                <span class="text-danger small font-weight-bold">未出貨</span>
                @endif
            </td>
            <td>
                @if($order->received_status=='1')
                <span class="text-success small font-weight-bold">已收到</span>
                @else
                <span class="text-danger small font-weight-bold">未收到</span>
                @endif
            </td>
            <td>
                @if($order->finished_status=='1')
                <span class="text-success small font-weight-bold">已完成</span>
                @else
                <span class="text-danger small font-weight-bold">未完成</span>
                @endif
            </td>
            <td>
            <a href="{{ route('setting.order_edit', $order->id) }}"><img alt="edit" src="{{asset('img/edit.png')}}" ></a>
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
    document.getElementById('nav_title').innerHTML="訂單管理";
});

$(document).ready( function() {
  $('#dataTable').dataTable( {
        pageLength: 10,
        order: [],
        responsive: true,
        oLanguage: {
            "sProcessing": "處理中...",
            "sLengthMenu": "顯示 _MENU_ 項結果",
            "sZeroRecords": "沒有匹配結果",
            "sInfo": "顯示第 _START_ 至 _END_ 項結果，共 _TOTAL_ 項",
            "sInfoEmpty": "顯示第 0 至 0 項結果，共 0 項",
            "sInfoFiltered": "(從 _MAX_ 項結果過濾)",
            "sSearch": "搜尋:",
            "oPaginate": {
                "sFirst": "首頁",
                "sPrevious": "上頁",
                "sNext": "下頁",
                "sLast": "尾頁"
            }
        },
        destroy:true,
        "oSearch": {"sSearch": "未完成"}
    } );

    document.getElementById('show_unfinished_btn').classList.add('enlarge_text_btn');
} )

var show_unfinished_btn=document.getElementById('show_unfinished_btn');
show_unfinished_btn.addEventListener("click", function() {
    $('#dataTable').dataTable( {
        pageLength: 10,
        order: [],
        responsive: true,
        oLanguage: {
            "sProcessing": "處理中...",
            "sLengthMenu": "顯示 _MENU_ 項結果",
            "sZeroRecords": "沒有匹配結果",
            "sInfo": "顯示第 _START_ 至 _END_ 項結果，共 _TOTAL_ 項",
            "sInfoEmpty": "顯示第 0 至 0 項結果，共 0 項",
            "sInfoFiltered": "(從 _MAX_ 項結果過濾)",
            "sSearch": "搜尋:",
            "oPaginate": {
                "sFirst": "首頁",
                "sPrevious": "上頁",
                "sNext": "下頁",
                "sLast": "尾頁"
            }
        },
        destroy:true,
        "oSearch": {"sSearch": "未完成"}
    } );
});
var show_finished_btn=document.getElementById('show_finished_btn');
show_finished_btn.addEventListener("click", function() {
    $('#dataTable').dataTable( {
        pageLength: 10,
        order: [],
        responsive: true,
        oLanguage: {
            "sProcessing": "處理中...",
            "sLengthMenu": "顯示 _MENU_ 項結果",
            "sZeroRecords": "沒有匹配結果",
            "sInfo": "顯示第 _START_ 至 _END_ 項結果，共 _TOTAL_ 項",
            "sInfoEmpty": "顯示第 0 至 0 項結果，共 0 項",
            "sInfoFiltered": "(從 _MAX_ 項結果過濾)",
            "sSearch": "搜尋:",
            "oPaginate": {
                "sFirst": "首頁",
                "sPrevious": "上頁",
                "sNext": "下頁",
                "sLast": "尾頁"
            }
        },
        destroy:true,
        "oSearch": {"sSearch": "已完成"}
    } );
});
var show_all_btn=document.getElementById('show_all_btn');
show_all_btn.addEventListener("click", function() {
    $('#dataTable').dataTable( {
        pageLength: 10,
        order: [],
        responsive: true,
        oLanguage: {
            "sProcessing": "處理中...",
            "sLengthMenu": "顯示 _MENU_ 項結果",
            "sZeroRecords": "沒有匹配結果",
            "sInfo": "顯示第 _START_ 至 _END_ 項結果，共 _TOTAL_ 項",
            "sInfoEmpty": "顯示第 0 至 0 項結果，共 0 項",
            "sInfoFiltered": "(從 _MAX_ 項結果過濾)",
            "sSearch": "搜尋:",
            "oPaginate": {
                "sFirst": "首頁",
                "sPrevious": "上頁",
                "sNext": "下頁",
                "sLast": "尾頁"
            }
        },
        destroy:true,
        "oSearch": {"sSearch": ""}
    } );
});

var show_btns=document.querySelectorAll(".show_btns")
show_btns.forEach(function(item,index){
        var btn=document.getElementById(item.id);
        btn.addEventListener("click", function() {
            show_btns.forEach(function(item,index){
                var btn_other=document.getElementById(item.id);
                btn_other.classList.remove('enlarge_text_btn');
            });
            btn.classList.add('enlarge_text_btn');
        });
    });
</script>
@endsection



