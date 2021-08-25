@extends('shop.home')

@section('stage')
    @if(session()->has('member')&&session()->get('member')->Shop_id==$user->Shop_id)
    購物車{{ json_encode(session()->get('member')->cart) }}
    @endif
    ///////////////////////////商品資料{{ $user->shop->merchandise }}
@endsection

@section('js')
<script>

</script>
@endsection
