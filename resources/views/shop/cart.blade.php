@extends('shop.home')

@section('stage')
    @if(session()->has('member')&&session()->get('member')->Shop_id==$user->Shop_id)
        @if(isset(session()->get('member')->cart))

            購物車{{session()->get('member')->cart}}
            @php
            $my_cart=json_decode(session()->get('member')->cart);
            @endphp


            @foreach($my_cart as $c)
            id={{$c->buy_id}}

            @endforeach

            ////////////////////////////////////////////////
            商品{{$user->shop->merchandise}}
        @endif
    @endif
@endsection

@section('js')
<script>

</script>
@endsection
