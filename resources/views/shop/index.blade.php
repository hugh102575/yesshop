@extends('shop.home')


@section('css')
<style>
.serv ul {
  display: flex;
  flex-wrap: wrap;
  padding-left: 0;
}

.serv ul li {
  list-style: none;
  flex: 0 0 25%;
}
.center {
text-align: center;
}
</style>
@endsection


@section('stage')

        <div class="card shadow">
                <div class="card-body">
                    <div class="form-group">
                        <label class="font-weight-bold">商品</label>
                    </div>
                    <div class="form-group"><hr></div>
                        <div class="serv">
                            <ul>
                                @if(count($user->shop->merchandise)==0)
                                    <label>類別尚未建立</label>
                                @else
                                    @foreach($user->shop->merchandise as $m)

                                    <li class="my-3">
                                    <button class="btn bnt-link">
                                        <div class="text-primary">{{$m->Product_Name}}</div>
                                        <img src="{{$m->Product_Img}}" class="" style="height: 10rem; width: 10rem;">
                                        <div>{{$m->Product_Price}}元</div>
                                        </button>
                                    </li>

                                    @endforeach
                                @endif
                            </ul>
                        </div>

                </div>
            </div>

@endsection


@section('js')

@endsection
