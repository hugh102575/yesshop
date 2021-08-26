@extends('shop.home')

@section('css')
<style>
/* Global settings */
.ProductCard {
  margin-top: 50px;
  background: #CFD2CD;
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
    {{--@if(session()->has('member')&&session()->get('member')->Shop_id==$user->Shop_id)
        @if(isset(session()->get('member')->cart))
            購物車{{session()->get('member')->cart}}
        @endif
    @endif--}}

<div class="ProductCard">
<div class="shopping-cart">
  <div class="column-labels">
    <label class="product-image">Image</label>
    <label class="product-details">Product</label>
    <label class="product-price">價格</label>
    <label class="product-quantity">數量</label>
    <label class="product-removal">Remove</label>
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
                                    <span class="text-danger">備註:</span>
                                </small>
                                <select id="update_model_{{$chart_index}}_{{$ShopCart->buy_id}}" class="form-select update_model">

                                @foreach($product_model as $mm)
                                    @if($loop->index==$ShopCart->buy_model)
                                    <option  value="{{$loop->index}}" selected="selected">{{$mm->value}}</option>
                                    @else
                                    <option  value="{{$loop->index}}">{{$mm->value}}</option>
                                    @endif

                                    {{--@if($loop->index==$ShopCart->buy_model)
                                    <small class="">
                                        <span class="text-danger">備註:</span>
                                        {{$mm->value}}
                                    </small>
                                    @endif--}}


                                @endforeach
                                </select>
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
                <input id="update_cart_number_{{$chart_index}}_{{$ShopCart->buy_id}}" class="update_cart_number" type="number" value="{{$ShopCart->buy_quantity}}" min="1">
                </div>
                <div class="product-removal">
                <button class="remove-product del_from_cart" id="del_from_cart_{{$chart_index}}_{{$ShopCart->buy_id}}">
                    刪除
                </button>
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

  <div class="totals" id="Amount">
    <div class="totals-item">
      <label style="font-weight: bold;">總金額:</label>
      <h3 style="display:inline;" class="totals-value text-danger" id="cart-subtotal">0</h3>
    </div>
    <button class="checkout">確認訂購</button>
  </div>
</div>
</div>
@endsection

@section('js')
<script>
var user={!! json_encode($user) !!};
$(document).ready(function() {

 /* Set rates + misc */
 var taxRate = 0.05;
 var shippingRate = 15.00;
 var fadeTime = 300;

 recalculateCart();


 /* Assign actions */
 $('.product-quantity input').change( function() {
   updateQuantity(this);
 });

 $('.product-removal button').click( function() {
   //removeItem(this);
 });


 /* Recalculate cart */
 function recalculateCart()
 {
   var subtotal = 0;

   /* Sum up row totals */
   $('.product').each(function () {
     subtotal += parseInt($(this).children('.product-line-price').text());
   });

   /* Calculate totals */
   var tax = subtotal * taxRate;
   var shipping = (subtotal > 0 ? shippingRate : 0);
   var total = subtotal + tax + shipping;

   /* Update totals display */
   $('.totals-value').fadeOut(fadeTime, function() {
     $('#cart-subtotal').html(subtotal);
    /*
     $('#cart-tax').html(tax.toFixed(2));
     $('#cart-shipping').html(shipping.toFixed(2));
     $('#cart-total').html(total.toFixed(2));
    */
     if(total == 0){
       $('.checkout').fadeOut(fadeTime);
     }else{
       $('.checkout').fadeIn(fadeTime);
     }
     $('.totals-value').fadeIn(fadeTime);
   });
 }


 /* Update quantity */
 function updateQuantity(quantityInput)
 {
   /* Calculate line price */
   var productRow = $(quantityInput).parent().parent();
   var price = parseInt(productRow.children('.product-price').text());
   var quantity = $(quantityInput).val();
   var linePrice = price * quantity;

   /* Update line price display and recalc cart totals */
   productRow.children('.product-line-price').each(function () {
     $(this).fadeOut(fadeTime, function() {
       $(this).text(linePrice);
       recalculateCart();
       $(this).fadeIn(fadeTime);
     });
   });
 }


 /* Remove item from cart */
 function removeItem(removeButton)
 {
   /* Remove row from DOM and recalc cart total */
   var productRow = $(removeButton).parent().parent();
   productRow.slideUp(fadeTime, function() {
     productRow.remove();
     recalculateCart();
   });
 }

 });



 var del_from_cart=document.querySelectorAll(".del_from_cart")
 del_from_cart.forEach(function(item,index){
    var del_item=document.getElementById(item.id);
    var del_id=(del_item.id).replace("del_from_cart_", "");
    var where = del_id.indexOf("_");
    var c_index = del_id.substr(0, where);
    var c_id = del_id.substr(where + 1);

    del_item.addEventListener("click", function() {
        $.ajax({
                type:'POST',
                url:'/shop/'+user.api_token+'/'+'del_cart',
                dataType:'json',
                data:{
                    'del_index':c_index,
                    'del_id':c_id,
                    _token: '{{csrf_token()}}'
                },
                success:function(data){
                    console.log(data)
                    if(data=='deleted_cart'){
                        window.location.reload();
                    }
                },
                error:function(e){
                    alert('Error: ' + e);
                }
            });
    });
});

var update_cart_number=document.querySelectorAll(".update_cart_number")
update_cart_number.forEach(function(item,index){
    var update_item=document.getElementById(item.id);
    var update_id=(update_item.id).replace("update_cart_number_", "");
    var where = update_id.indexOf("_");
    var c_index = update_id.substr(0, where);
    var c_id = update_id.substr(where + 1);
    var per_price=document.getElementById('per_price_'+c_index+'_'+c_id).value;
    update_item.addEventListener("change", function() {
        var update_number=document.getElementById(item.id).value;
        $.ajax({
                type:'POST',
                url:'/shop/'+user.api_token+'/'+'update_cart',
                dataType:'json',
                data:{
                    'update_index':c_index,
                    'update_id':c_id,
                    'update_number':update_number,
                    'update_type':'number',
                    'per_price':per_price,
                    _token: '{{csrf_token()}}'
                },
                success:function(data){
                    console.log(data)
                },
                error:function(e){
                    alert('Error: ' + e);
                }
            });
    });
});

var update_model=document.querySelectorAll(".update_model")
update_model.forEach(function(item,index){
    var update_item=document.getElementById(item.id);
    var update_id=(update_item.id).replace("update_model_", "");
    var where = update_id.indexOf("_");
    var c_index = update_id.substr(0, where);
    var c_id = update_id.substr(where + 1);
    update_item.addEventListener("change",(event) => {
        //alert(c_index+"@@"+c_id)
        var update_model_value=event.target.value;
        $.ajax({
                type:'POST',
                url:'/shop/'+user.api_token+'/'+'update_cart',
                dataType:'json',
                data:{
                    'update_index':c_index,
                    'update_id':c_id,
                    'update_model':update_model_value,
                    'update_type':'model',
                    _token: '{{csrf_token()}}'
                },
                success:function(data){
                    console.log(data)
                },
                error:function(e){
                    alert('Error: ' + e);
                }
            });

    });

});
</script>
@endsection
