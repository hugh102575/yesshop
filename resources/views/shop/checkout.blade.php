@extends('shop.home')

@section('stage')
@if(session()->has('member')&&session()->get('member')->Shop_id==$user->Shop_id)
        @if(isset(session()->get('member')->cart))
            購物車{{session()->get('member')->cart}}


            @php
            $my_cart=json_decode(session()->get('member')->cart);
            @endphp

            //////////迴圈範例
            @foreach($my_cart as $ShopCart)
                {{$ShopCart->buy_id}}
            @endforeach
        @endif
@endif

///////////////全部商品如下 (已註解)
{{--  {{$user->shop->merchandise}}   --}}
<div class="card shadow">
    <div class="card-body">
        <div class="form-group">
        <label class="font-weight-bold">結帳</label>
        </div>
        <div class="form-group"><hr></div>
    </div>
</div>
@endsection

@section('js')
<script>

</script>
@endsection
