@extends('shop.home')

@section('css')
<style>
/* Global settings */


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

.md-form{
    font-weight: bold;
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
    <div class="card-body">
        <div class="form-group">
        <label class="font-weight-bold">結帳</label>
        </div>
        <div class="form-group"><hr>
        <div class="card shadow">
<div class="card-body">
</div>


<div class="ProductCard">
<div class="shopping-cart mt-0">
  <div class="column-labels">
    <label class="product-image">Image</label>
    <label class="product-details">Product</label>
    <label class="product-price">價格</label>
    <label class="product-quantity">數量</label>
    <label class="product-line-price">總價</label>
  </div>

  @if(session()->has('member')&&session()->get('member')->Shop_id==$user->Shop_id)
        @if(isset(session()->get('member')->cart))
            @php
            $my_cart=json_decode(session()->get('member')->cart);
            @endphp


            @foreach($my_cart as $ShopCart)
            @php
            $chart_index=$loop->index;
            @endphp
            <div class="product">

                <div class="product-image">
                     @foreach($user->shop->merchandise as $Product)
                        @if($Product->id==$ShopCart->buy_id)

                            <a href="/shop/{{$user->api_token}}/{{$Product->id}}/product">
                            <img src="{{$Product->Product_Img}}">
                            </a>
                        @endif
                    @endforeach

                </div>
                <div class="product-details">
                <div class="product-title"><!--商品的名稱-->
                    @foreach($user->shop->merchandise as $Product)
                        @if($Product->id==$ShopCart->buy_id)
                            <span class="">{{$Product->Product_Name}}</span>
                        @endif
                    @endforeach
                </div>
                <p class="product-description"><!--商品的描述-->
                    @foreach($user->shop->merchandise as $Product)
                        @if($Product->id==$ShopCart->buy_id)
                            @if(isset($Product->Product_Model))
                                @php
                                $product_model=json_decode($Product->Product_Model);
                                @endphp
                                <small class="">
                                @foreach($product_model as $mm)
                                    @if($loop->index==$ShopCart->buy_model)
                                    <span class="text-danger">型號:{{$mm->value}}</span>
                                    @endif

                                    {{--@if($loop->index==$ShopCart->buy_model)
                                    <small class="">
                                        <span class="text-danger">備註:</span>
                                        {{$mm->value}}
                                    </small>
                                    @endif--}}
                                @endforeach
                                </small>
                            @endif

                            <!--商品的型號-->
                        @endif
                    @endforeach
                </p>
                </div>

                @foreach($user->shop->merchandise as $Product)
                        @if($Product->id==$ShopCart->buy_id)
                        <input class="hidden_object" id="per_price_{{$chart_index}}_{{$ShopCart->buy_id}}" value="{{$Product->Product_Price}}" >
                        @endif
                @endforeach

                <div class="product-price"><!--商品的價格-->
                    @foreach($user->shop->merchandise as $Product)
                        @if($Product->id==$ShopCart->buy_id)
                            {{$Product->Product_Price}}
                        @endif
                    @endforeach
                </div>
                <div class="product-quantity">
                <!--value==目前要購買的商品數量-->
                    <label id="update_cart_number_{{$chart_index}}_{{$ShopCart->buy_id}}" class="update_cart_number">
                        {{$ShopCart->buy_quantity}}
                    </label>
                </div>
                <div class="product-line-price">
                <!--商品總價(單價*數量)(會隨著按鈕自動調整)-->
                    @foreach($user->shop->merchandise as $Product)
                        @if($Product->id==$ShopCart->buy_id)
                            {{$Product->Product_Price*$ShopCart->buy_quantity}}
                        @endif
                    @endforeach
                </div>
            </div>
            @endforeach
        @endif
    @endif


</div>
</div>
    </div>
    </div>
    <!--Section: Block Content-->
<section>

<form action="/shop/{{$user->api_token}}/order" method="POST" enctype="multipart/form-data">
@csrf
<!--Grid row-->
<div class="row">

  <!--Grid column-->
  <div class="col-lg-8 mb-4">

    <!-- Card -->
    <div class="card wish-list pb-1">
      <div class="card-body">

        <h5 class="mb-2">購買資訊</h5>

        <!-- Grid row -->
        <div class="row">

          <!-- Grid column -->
          <div class="col-lg-6">

            <!-- First name -->
            <div class="md-form md-outline mb-0 mb-lg-4 text-left">
                <label for="Name" >收件人</label><span class="text-danger">*</span>
              <input type="text" id="Name" name="order_name"  placeholder="請輸入收件人姓名" class="form-control mb-0 mb-lg-2" required>

            </div>

          </div>
          <!-- Grid column -->


        </div>
        <!-- Grid row -->


        <!-- Address -->
        <div class="md-form md-outline mt-0 text-left mb-lg-4">
            <label for="address">地址</label><span class="text-danger">*</span>
            <input type="text" id="address" name="order_address" placeholder="請輸入地址" class="form-control" required>
        </div>

        <!-- Phone -->
        <div class="md-form md-outline text-left mb-lg-4">
            <label for="phone">連絡電話</label><span class="text-danger">*</span>
            <input type="number" id="phone" name="order_phone" placeholder="請輸入聯絡電話" class="form-control" required>

        </div>

        <!-- Email address -->
        <div class="md-form md-outline text-left mb-lg-4">
            <label for="Email_address">電子郵件</label>
            <input type="email" id="form19" name="order_email" placeholder="請輸入電子郵件" class="form-control">
        </div>

        <!-- Additional information -->
        <div class="md-form md-outline text-left mb-lg-4">
            <label for="information">備註事項</label>
            <textarea id="information" name="order_memo" class="md-textarea form-control" placeholder="請輸入備註事項，例如給賣家的話" rows="4"></textarea>
        </div>



      </div>
    </div>
    <!-- Card -->

  </div>
  <!--Grid column-->

  <!--Grid column-->
  <div class="col-lg-4">

    <!-- Card -->
    <div class="card mb-4">
      <div class="card-body">



        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
            <h3 style="display:inline;">總價格:</h3>
            <h3 style="display:inline;" class="totals-value text-danger" id="cart-subtotal">0</h3>
            <input class="hidden_object" id="order_price" name="order_price" value="0">
        </li>
        </ul>

        <button type="submit"  class="btn btn-primary btn-block waves-effect waves-light">確認</button>

      </div>
    </div>
    <!-- Card -->



  </div>
  <!--Grid column-->

</div>
</form >
<!--Grid row-->

</section>
<!--Section: Block Content-->
</div>

@endsection

@section('js')
<script>
$(document).ready(function() {
var fadeTime = 10;

/*計算總價格 */
recalculateCart();

/* Recalculate cart */
function recalculateCart()
{
  var subtotal = 0;
  /* 算出總價 */
  $('.product').each(function () {
    subtotal += parseInt($(this).children('.product-line-price').text());
  });

  /* 顯示總價格 */
  $('.totals-value').fadeOut(fadeTime, function() {
    $('#cart-subtotal').html(subtotal);
    $('.totals-value').fadeIn(fadeTime);
    document.getElementById('order_price').value=subtotal;
  });
 }
})
</script>
@endsection
