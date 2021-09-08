@extends('shop.home')

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

/* Make adjustments for tablet */
@media screen and (max-width: 650px) {
  .shopping-cart {
    margin: 0;
    padding-top: 20px;
    border-top: 1px solid #eee;
  }

  .column-labels {
    display: none;
  }

  .product-image {
    float: right;
    width: auto;
  }
  .product-image img {
    margin: 0 0 10px 10px;
  }

  .product-details {
    float: none;
    margin-bottom: 10px;
    width: auto;
  }

  .product-price {
    clear: both;
    width: 70px;
  }

  .product-quantity {
    width: 100px;
  }
  .product-quantity input {
    margin-left: 20px;
  }

  .product-quantity:before {
    content: 'x';
  }

  .product-removal {
    width: auto;
  }

  .product-line-price {
    float: right;
    width: 70px;
  }
}
/* Make more adjustments for phone */
@media screen and (max-width: 350px) {
  .product-removal {
    float: right;
  }

  .product-line-price {
    float: right;
    clear: left;
    width: auto;
    margin-top: 10px;
  }

  .product .product-line-price:before {
    content: 'Item Total: $';
  }

  .totals .totals-item label {
    width: 60%;
  }
  .totals .totals-item .totals-value {
    width: 40%;
  }
}
</style>
@endsection

@section('stage')
<div class="card shadow">
<div class="card-body stage_bg">
<div class="form-group">
<label class="font-weight-bold">訂單查詢</label>
</div>
<div class="form-group"><hr></div>
    @php
    $my_order_count=count(json_decode($my_order));
    $my_order=array_reverse(json_decode($my_order));
    $collapse_count=1;
    @endphp
    @if($my_order_count==0)
    您目前尚未訂購，沒有訂單喔！
    @endif
    @foreach($my_order as $order)

    <!--<div class="ProductCard card shadow mb-5 " id="collapseExample_{{$collapse_count}}">-->
    <div class="ProductCard card shadow mb-5">
    <div class="shopping-cart mt-0">


    @php
    $datetime=$order->created_at;
    $newDate = date("Y-m-d", strtotime($datetime));

    @endphp



        @php
        $order_content=$order->order_content;
        $order_content_decode=json_decode($order->order_content);

        @endphp
        {{--{{$order_content}}--}}
        <label class="font-weight-bold  pb-3 mx-auto">日期: {{$newDate}}</label>
        <li class="list-group-item d-flex justify-content-between  align-items-center">
            <span class="mr-3" style="display:inline;">總價格:</span>
            <h4 style="display:inline;" class="totals-value text-danger" id="cart-subtotal">{{$order->order_price}}</h4>
        </li>

        <li class="list-group-item d-flex justify-content-between  align-items-center">
            <span class="mr-3" style="display:inline;">付款狀態:
            </span>
            <span style="display:inline;">

            <!--<button class="btn btn-success mx-3" type="button" name="order_received_btn"><small>我已經付款了</small></button>-->
                @if($order->payed_status==1 || $order->payed_pending==1)
                <span style="display:inline;">
                <span class="mx-3">轉帳後五碼
                {{$order->payed_card}}</span>
                    @if($order->payed_status==1)
                    <span class="text-success font-weight-bold">已付款</span>
                    @endif
                    @if($order->payed_pending==1)
                    <span class="text-info font-weight-bold">等待確認</span>
                    @endif
                </span>
                @else
                <span class="text-danger font-weight-bold">未付款</span>
                @endif

            </span>



        </li>
        @if($order->payed_status!=1 && $order->payed_pending!=1)
        <li id="order_payed_info_{{$order->id}}" class="list-group-item d-flex justify-content-between  align-items-center">
            <span class="mr-3" style="display:inline;">匯款資訊:</span>
            <span style="display:inline;">
            {{$user->shop->bank_name}}
            @if($user->shop->bank_port!=null)
            ({{$user->shop->bank_port}})
            @endif
            {{$user->shop->card_number}}
            </span>
        </li>
        <li class="list-group-item d-flex justify-content-between  align-items-center">
            <span class="mr-3" style="display:inline;">轉帳後五碼:
            </span>
            <span style="display:inline;">
            <div class="form-group">


                <form id="order_payed_form_{{$order->id}}" action="/shop/{{$user->api_token}}/{{$order->id}}/order_update" method="POST" enctype="multipart/form-data" onsubmit="return validate_card(this)">
                  @csrf
                    <input id="order_payed_card_{{$order->id}}" class="form-control my-3" type="number" name="payed_card" placeholder="請輸入轉帳後5碼" value="{{$order->payed_card}}" required="required">
                    <small>待商家查收到您的款項後，將立即安排出貨</small>
                    <button class="btn btn-primary mx-3"  name="order_payed_btn"><small>我已經付款了，送出</small></button>
                </form>
            </div>
            </span>
        </li>
        @endif
        <li class="list-group-item d-flex justify-content-between  align-items-center">
            <span class="mr-3" style="display:inline;">出貨狀態:
            </span>
            <span style="display:inline;">
                @if($order->shipped_status==1)
                <form id="order_completed_form_{{$order->id}}" action="/shop/{{$user->api_token}}/{{$order->id}}/order_update" method="POST" enctype="multipart/form-data" onsubmit="return validate_completed(this)">
                  @csrf
                  <button class="btn btn-success mx-3" type="submit" name="order_received_btn"><small>我已經收到貨了</small></button>
                </form>
                <span class="text-success font-weight-bold">已出貨</span>
                @else
                <span class="text-danger font-weight-bold">未出貨</span>
                @endif
            </span>
        </li>

        <button id="collapse_btn_{{$collapse_count}}" class="row mx-auto my-3" data-toggle="collapse" href="#collapseExample_{{$collapse_count}}" role="button" aria-expanded="false" aria-controls="collapseExample">展開內容</button>

    <div class="collapse" id="collapseExample_{{$collapse_count}}">
        <div class="column-labels">
            {{--<label class="row">日期: {{$newDate}}</label>--}}
            <label class="product-image">Image</label>
            <label class="product-details">Product</label>
            <label class="product-price">價格</label>
            <label class="product-quantity">數量</label>
            <label class="product-line-price">總價</label>
        </div>
        @foreach($order_content_decode as $oc)
        {{--{{$oc->buy_id}}--}}
        <div class="product">
            <div class="product-image">
                @foreach($user->shop->merchandise as $Product)
                    @if($Product->id==$oc->buy_id)

                        <a href="/shop/{{$user->api_token}}/{{$Product->id}}/product">
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
                            {{--{{$Product->Product_Price}}--}}
                            {{$oc->buy_price/$oc->buy_quantity}}
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
                            {{$oc->buy_price}}
                        @endif
                    @endforeach
                </div>

        </div>
        @endforeach
        @if($order->order_shipping!=null)
        <div class="mx-auto mb-3">
          <span class="text-danger">運費</span> $ {{$order->order_shipping}}
        </div>
        @endif



        {{--<li class="list-group-item d-flex justify-content-between  align-items-center ">

            <span class="mr-3" style="display:inline;">訂單完成狀態:</span>

            <span style="display:inline;">

                @if($order->finished_status==1)
                <span class="text-success font-weight-bold">已完成</span>
                @else
                <form id="order_completed_form_{{$order->id}}" action="/shop/{{$user->api_token}}/{{$order->id}}/order_update" method="POST" enctype="multipart/form-data" onsubmit="return validate_completed(this)">
                  @csrf
                  <button class="btn btn-success mx-3" type="submit" name="order_received_btn"><small>我已經收到貨了</small></button>
                </form>
                <span class="text-danger font-weight-bold">未完成</span>
                @endif
            </span>
        </li>--}}

        <ul class="list-group list-group-flush   float-left rounded-lg p-3  mt-3 col-sm-4">
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
                {{--<li class="list-group-item d-flex justify-content-between align-items-center  ">
                    <span class="mr-3"style="">電話:</span>
                    <span style="display:inline;">{{$order->order_phone}}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center  ">
                    <span class="mr-3"style="">Email:</span>
                    <span style="display:inline;">{{$order->order_email}}</span>
                </li>--}}
                @if($order->order_memo!=null)
                <li class="list-group-item d-flex justify-content-between align-items-center  ">
                    <span class="mr-3"style="">附註事項:</span>
                    <span style="display:inline;">{{$order->order_memo}}</span>
                </li>
                @endif
        </ul>
            <ul class="list-group list-group-flush   float-right rounded-lg p-3  mt-3 col-sm-6">


                {{--<li class="list-group-item d-flex justify-content-between align-items-center">
                    <span class="mr-3" style="display:inline;">總價格:</span>
                    <h4 style="display:inline;" class="totals-value text-danger" id="cart-subtotal">{{$order->order_price}}</h4>
                </li>--}}

                @if($user->shop->manager_name!=null)
                <li class="list-group-item d-flex justify-content-between align-items-center ">
                    <span class="mr-3" style="display:inline;">商家聯絡人</span>
                    <span style="display:inline;">
                    {{$user->shop->manager_name}}
                    @if($user->shop->manager_gender!=null)
                        @if($user->shop->manager_gender=='1')
                        先生
                        @endif
                        @if($user->shop->manager_gender=='0')
                        小姐
                        @endif
                    @endif
                    @if($user->shop->manager_phone!=null)
                    <span style="display:inline;"><br>{{$user->shop->manager_phone}}</span>
                    @endif
                    </span>
                </li>
                @endif



                {{--@if($user->shop->manager_phone!=null)
                <li class="list-group-item d-flex justify-content-between align-items-center ">
                    <span class="mr-3" style="display:inline;">商家聯絡電話</span>
                    <span style="display:inline;">{{$user->shop->manager_phone}}</span>
                </li>
                @endif--}}

                {{--@if($user->shop->bank_name!=null)
                <li class="list-group-item d-flex justify-content-between  align-items-center ">
                    <span class="mr-3" style="display:inline;">匯款銀行</span>
                    <div class="d-flex flex-column justify-content-center">

                    <span style="display:inline;">
                    {{$user->shop->bank_name}}
                    @if($user->shop->bank_port!=null)
                    ({{$user->shop->bank_port}})
                    @endif
                    </span>
                    </div>
                </li>
                @endif

                @if($user->shop->card_number!=null)
                <li class="list-group-item d-flex justify-content-between  align-items-center ">
                    <span class="mr-3" style="display:inline;">匯款帳號</span>
                    <div class="d-flex flex-column justify-content-center">

                    <span style="display:inline;">
                    {{$user->shop->card_number}}
                        <!--<span class="text-light bg-dark p-0">{{$user->shop->card_number}}<span>-->
                    </span>
                    </div>
                </li>
                @endif--}}





            </ul>

    </div>
    </div>
    </div>
    @php
    $collapse_count++;
    @endphp
    @endforeach

</div>
</div>
@endsection

@section('js')
<script>
function validate_card(form){
    var payed_id=(form.id).replace("order_payed_form_", "");
    var payed_card=document.getElementById('order_payed_card_'+payed_id).value
    if(payed_card.length==5){
        return true;
    }else{
        alert('後五碼格式錯誤喔！')
        return false;
    }
}
function validate_completed(form){
    var completed_id=(form.id).replace("order_completed_form_", "");
    if(document.getElementById('order_payed_info_'+completed_id)==null){
        /*var r = confirm("是否通知商家我已經收到貨了?");
        if (r == true) {
            return true;
        } else {
            return false;
        }*/
        return true;
    }else{
        alert('您尚未輸入轉帳後五碼喔！');
        return false;
    }
}


$(".collapse").on('show.bs.collapse', function(e) {
    //alert(this.id)
    var collapse_id=(this.id).replace("collapseExample_", "");
    document.getElementById('collapse_btn_'+collapse_id).innerHTML='收合內容';
});
$(".collapse").on('hidden.bs.collapse', function(e) {
    //alert(this.id)
    var collapse_id=(this.id).replace("collapseExample_", "");
    document.getElementById('collapse_btn_'+collapse_id).innerHTML='展開內容';
});

</script>
@endsection
