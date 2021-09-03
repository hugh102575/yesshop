@extends('shop.home')

@section('css')

@endsection

@section('stage')
<div class="container-fluid col-sm-8">

    <form action="/shop/{{$user->api_token}}/my_update" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="card shadow mb-4 ">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h5 class="m-0 text-primary">個人資料</h5>
        </div>
        <div class="card-body">
            <div class="alert alert-success">
                此頁資訊可用於填寫訂單，建議可以填寫
            </div>
            <div class="card py-4 px-5 mb-3">
                <div class="form-group row">
                    <label for="member_name" class="col-sm-4 col-form-label">姓名</label>
                    <div class="col-sm-8" >
                        <input class="form-control" type="text" name="member_name" placeholder="請輸入姓名" value="{{session()->get('member')->name}}" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="member_address" class="col-sm-4 col-form-label">地址</label>
                    <div class="col-sm-8" >
                        <input class="form-control" type="text" name="member_address" placeholder="請輸入地址" value="{{session()->get('member')->member_address}}" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="member_phone" class="col-sm-4 col-form-label">聯絡電話</label>
                    <div class="col-sm-8" >
                        <input class="form-control" type="tel" name="member_phone" placeholder="請輸入聯絡電話" value="{{session()->get('member')->member_phone}}" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="member_email" class="col-sm-4 col-form-label">電子郵件</label>
                    <div class="col-sm-8" >
                        <input class="form-control" type="email" name="member_email" placeholder="請輸入電子郵件" value="{{session()->get('member')->member_email}}" >
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="form-group">
            <div class="float-right">
                <button type="submit" class="btn btn-primary">儲存</button>
            </div>
        </div>
    </form>
    </div>

@endsection

@section('js')
<script>

</script>
@endsection
