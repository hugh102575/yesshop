
@extends('layouts.home')

@section('css')
<style>
  .ProductCard {
  //margin-top: 50px;
  //background: #CFD2CD;
  padding: 3em;
  line-height: 1.5em;
  border-radius:10px; }

.product-image {
  float: left;
  width: 20%;
}

.product-details {
  float: left;
  width: 37%;
}

.product-price {
  float: left;
  width: 12%;
}

.product-quantity {
  float: left;
  width: 10%;
}

.product-removal {
  float: left;
  width: 9%;
}

.product-line-price {
  float: left;
  width: 12%;
  text-align: right;
}

/* This is used as the traditional .clearfix class */
.group:before, .shopping-cart:before, .column-labels:before, .product:before, .totals-item:before,
.group:after,
.shopping-cart:after,
.column-labels:after,
.product:after,
.totals-item:after {
  content: '';
  display: table;
}

.group:after, .shopping-cart:after, .column-labels:after, .product:after, .totals-item:after {
  clear: both;
}

.group, .shopping-cart, .column-labels, .product, .totals-item {
  zoom: 1;
}

/* Apply clearfix in a few places */
/* Apply dollar signs */
.product .product-price:before, .product .product-line-price:before, .totals-value:before {
  content: '$';
}

/* Body/Header stuff */
body {
  //padding: 0px 30px 30px 20px;
  font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-weight: 100;
}

h1 {
  font-weight: 100;
}

label {
  color: #3b4c6c;
}

.shopping-cart {
  margin-top: -45px;
}

/* Column headers */
.column-labels label {
  padding-bottom: 15px;
  margin-bottom: 15px;
  border-bottom: 1px solid #eee;
  color: #3b4c6c;
  font-weight:bold;
  position: relative;
  top: 2px;
}
.column-labels .product-image, .column-labels .product-details, .column-labels .product-removal {
  text-indent: -9999px;
}

/* Product entries */
.product {
  margin-bottom: 20px;
  padding-bottom: 10px;
  border-bottom: 1px solid #eee;
}
.product .product-image {
  text-align: center;
}
.product .product-image img {
  width: 100px;
}
.product .product-details .product-title {
  margin-right: 20px;
  font-weight: bolder ;
  text-align: left;
}
.product .product-details .product-description {
  margin: 5px 20px 5px 0;
  line-height: 1.4em;
  font-weight: bolder ;
  text-align: left;
}
.product .product-quantity input {
  width: 40px;
}
.product .remove-product {
  border: 0;
  padding: 4px 8px;
  background-color: #c66;
  color: #fff;
  font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
  font-size: 12px;
  border-radius: 3px;
}
.product .remove-product:hover {
  background-color: #a44;
}

/* Totals section */
.totals .totals-item {
  float: right;
  clear: both;
  width: 100%;
  margin-bottom: 10px;
}
.totals .totals-item label {
  float: left;
  clear: both;
  width: 79%;
  text-align: right;
}
.totals .totals-item .totals-value {
  float: right;
  width: 21%;
  text-align: right;
}
.totals .totals-item-total {
  font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
}

.checkout {
  float: right;
  border: 0;
  margin-top: 20px;
  padding: 6px 25px;
  background-color: #6b6;
  color: #fff;
  font-size: 25px;
  border-radius: 3px;
}

.checkout:hover {
  background-color: #494;
}
</style>
@endsection


@section('stage')

@csrf
<div class="ProductCard card shadow mb-5 container col-sm-8">
<form action="{{ route('setting.order_update',$order->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('更新此訂單的狀態嗎?');">
@csrf
    <div class="shopping-cart mt-0">

    <div class="column-labels">

    @php
    $datetime=$order->created_at;
    $newDate = date("Y-m-d", strtotime($datetime));
    @endphp
    <label class="row">日期: {{$newDate}}</label>
        <label class="product-image">Image</label>
        <label class="product-details">Product</label>
        <label class="product-price">價格</label>
        <label class="product-quantity">數量</label>
        <label class="product-line-price">總價</label>
    </div>
        @php
        $order_content=$order->order_content;
        $order_content_decode=json_decode($order->order_content);

        @endphp
        {{--{{$order_content}}--}}
        @foreach($order_content_decode as $oc)
        {{--{{$oc->buy_id}}--}}
        <div class="product">
            <div class="product-image">
                @foreach($user->shop->merchandise as $Product)
                    @if($Product->id==$oc->buy_id)

                        <a href="#">
                        <img src="{{$Product->Product_Img}}">
                        </a>
                    @endif
                @endforeach

            </div>

            <div class="product-details">
                <div class="product-title"><!--商品的名稱-->
                    @foreach($user->shop->merchandise as $Product)
                        @if($Product->id==$oc->buy_id)
                            <span class="">{{$Product->Product_Name}}</span>
                        @endif
                    @endforeach
                </div>
                <p class="product-description"><!--商品的描述-->
                    @foreach($user->shop->merchandise as $Product)
                        @if($Product->id==$oc->buy_id)
                            @if(isset($Product->Product_Model))
                                @php
                                $product_model=json_decode($Product->Product_Model);
                                @endphp
                                <small class="">
                                @foreach($product_model as $mm)
                                    @if($loop->index==$oc->buy_model)
                                    <span class="text-danger">型號:{{$mm->value}}</span>
                                    @endif
                                @endforeach
                                </small>
                            @endif
                        @endif
                    @endforeach
                </p>
                </div>

                <div class="product-price"><!--商品的價格-->
                    @foreach($user->shop->merchandise as $Product)
                        @if($Product->id==$oc->buy_id)
                            {{$Product->Product_Price}}
                        @endif
                    @endforeach
                </div>
                <div class="product-quantity">
                <!--value==目前要購買的商品數量-->
                    <label  class="update_cart_number">
                        {{$oc->buy_quantity}}
                    </label>
                </div>
                <div class="product-line-price">
                <!--商品總價(單價*數量)(會隨著按鈕自動調整)-->
                    @foreach($user->shop->merchandise as $Product)
                        @if($Product->id==$oc->buy_id)
                            {{$Product->Product_Price*$oc->buy_quantity}}
                        @endif
                    @endforeach
                </div>

        </div>
        @endforeach
        <li class="list-group-item d-flex justify-content-between  align-items-center">
            <span class="mr-3" style="display:inline;">總價格:</span>
            <h4 style="display:inline;" class="totals-value text-danger" id="cart-subtotal">{{$order->order_price}}</h4>
        </li>

        <li class="list-group-item d-flex justify-content-between  align-items-center">
            <span class="mr-3" style="display:inline;">付款狀態:
            </span>
            <span style="display:inline;">

            <!--<button class="btn btn-success mx-3" type="button" name="order_received_btn"><small>我已經付款了</small></button>-->
               {{-- @if($order->payed_status==1)
                <span style="display:inline;">
                <span class="mx-3">轉帳後五碼
                {{$order->payed_card}}</span>
                <span class="text-success font-weight-bold">已付款</span>
                </span>
                @else
                <span class="text-danger font-weight-bold">未付款</span>
                @endif
                --}}

                    @if($order->payed_status=='1' || $order->payed_pending=='1')

                    @if($order->payed_status=='1')
                    <select class="form-select form-control" name="select_payed_status" aria-label="Default select example">
                        <option  value="1" selected="selected">已付款</option>
                        <option  value="0">未付款</option>
                    </select>
                    @endif
                    @if($order->payed_pending=='1')
                    <span style="display:inline;">
                    <span class="mx-3 text-danger">請點收款項，轉帳後五碼
                    {{$order->payed_card}}</span>
                    <select class="form-select form-control" name="select_payed_status" aria-label="Default select example">
                        <option  value="1">已付款</option>
                        <option  value="0" selected="selected">未付款</option>
                    </select>
                    </span>
                    @endif

                    @else
                    <select class="form-select form-control" name="select_payed_status" aria-label="Default select example">
                        <option  value="1">已付款</option>
                        <option  value="0" selected="selected">未付款</option>
                    </select>
                    @endif


            </span>



        </li>
        {{--@if($order->payed_status!=1)--}}
        <li  class="list-group-item d-flex justify-content-between  align-items-center">
            <span class="mr-3" style="display:inline;">匯款資訊:</span>
            <span style="display:inline;">
            {{$user->shop->bank_name}}
            @if($user->shop->bank_port!=null)
            ({{$user->shop->bank_port}})
            @endif
            {{$user->shop->card_number}}
            </span>
        </li>

       {{-- @endif --}}
        <li class="list-group-item d-flex justify-content-between  align-items-center">
            <span class="mr-3" style="display:inline;">出貨狀態:
            </span>
            <span style="display:inline;">
                {{--@if($order->shipped_status==1)
                <span class="text-success font-weight-bold">已出貨</span>
                @else
                <span class="text-danger font-weight-bold">未出貨</span>
                @endif--}}

                <select class="form-select form-control" name="select_shipped_status" aria-label="Default select example">
                    @if($order->shipped_status=='1')
                        <option  value="1" selected="selected">已出貨</option>
                        <option  value="0">未出貨</option>
                    @else
                        <option  value="1">已出貨</option>
                        <option  value="0" selected="selected">未出貨</option>
                    @endif
                </select>
            </span>
        </li>
        <li class="list-group-item d-flex justify-content-between  align-items-center">
            <span class="mr-3" style="display:inline;">收貨狀態:
            </span>
            <span style="display:inline;">
                @if($order->received_status==1)
                <span class="text-success font-weight-bold">已收到</span>
                @else
                <span class="text-danger font-weight-bold">未收到</span>
                @endif


            </span>
        </li>

        <li class="list-group-item d-flex justify-content-between  align-items-center ">

            <span class="mr-3" style="display:inline;">訂單完成狀態:</span>

            <span style="display:inline;">

                <select class="form-select form-control" name="select_finished_status" aria-label="Default select example">
                    @if($order->finished_status=='1')
                        <option  value="1" selected="selected">已完成</option>
                        <option  value="0">未完成</option>
                    @else
                        <option  value="1">已完成</option>
                        <option  value="0" selected="selected">未完成</option>
                    @endif
                </select>
            </span>
        </li>

        <button class="btn btn-primary form-control">更新訂單</button>

        <ul class="list-group list-group-flush   container-fluid  mt-3 p-5">

                <li class="list-group-item d-flex justify-content-between align-items-center  ">
                    <span class="mr-3"style="">訂單建立時間:</span>
                    <span style="display:inline;">{{$order->created_at}}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center  ">
                    <span class="mr-3"style="">收件人:</span>
                    <span style="display:inline;">{{$order->order_name}}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center  ">
                    <span class="mr-3"style="">收件地址:</span>
                    <span style="display:inline;">{{$order->order_address}}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center  ">
                    <span class="mr-3"style="">電話:</span>
                    <span style="display:inline;">{{$order->order_phone}}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center  ">
                    <span class="mr-3"style="">Email:</span>
                    <span style="display:inline;">{{$order->order_email}}</span>
                </li>
                @if($order->order_memo!=null)
                <li class="list-group-item d-flex justify-content-between align-items-center  ">
                    <span class="mr-3"style="">附註事項:</span>
                    <span style="display:inline;">{{$order->order_memo}}</span>
                </li>
                @endif
        </ul>



    </div>
    </form>
    </div>

    @endsection

@section('js')

<script>
window.addEventListener('load', function () {
    document.getElementById('nav_title').innerHTML="訂單管理";
});

</script>
@endsection



