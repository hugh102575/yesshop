@extends('layouts.home')
@section('css')
<style>

</style>
@endsection
@section('stage')



    <div class="col-sm-8">
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
    <form action="{{ route('setting.admin_update') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="card shadow mb-4 ">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h5 class="m-0 font-weight-bold text-success">商家資訊</h5>
        </div>
        <div class="card-body">
            <div class="alert alert-success">
                客戶訂購商品後會顯示此頁付款資訊，請務必填寫
            </div>

            <div class="card py-4 px-5 mb-3">
            <div class="form-group row">
            <label for="Shop_Name" class="col-sm-4 col-form-label">商家店名<font color="#FF0000">*</font></label>
                <div class="col-sm-8" >
                <input class="form-control" type="text" name="Shop_Name" placeholder="請輸入商家店名" required="required" value="{{$shop_config->Shop_Name}}" >
                </div>
            </div>
            </div>


            <div class="card py-4 px-5 mb-3">
            <div class="form-group row">
                <label for="manager_name" class="col-sm-4 col-form-label">商家聯絡人<font color="#FF0000">*</font></label>
                <div class="col-sm-8" >



                    <div class="input-group mb-3">
                        <input class="form-control" type="text" name="manager_name" placeholder="請輸入商家聯絡人姓名" required="required" value="{{$shop_config->manager_name}}" >
                        <div class="input-group-append">
                                <select class="form-select" name="manager_gender" aria-label="Default select example">
                                @if($shop_config->manager_gender!=null)
                                    @if($shop_config->manager_gender=='1')
                                    <option  value="1" selected="selected">先生</option>
                                    <option  value="0">小姐</option>
                                    @else
                                    <option  value="1">先生</option>
                                    <option  value="0" selected="selected">小姐</option>
                                    @endif
                                @else
                                <option  value="1">先生</option>
                                <option  value="0">小姐</option>
                                @endif

                            </select>
                        </div>
                    </div>

                </div>
            </div>

            <div class="form-group row">
            <label for="manager_phone" class="col-sm-4 col-form-label">商家聯絡人電話<font color="#FF0000">*</font></label>
                <div class="col-sm-8" >
                    <input class="form-control" type="tel" name="manager_phone" placeholder="請輸入商家聯絡人電話" required="required" value="{{$shop_config->manager_phone}}" >
                </div>
            </div>
            </div>

            <div class="card  py-4 px-5 mb-3">
            <div class="form-group row">
            <label for="bank_name" class="col-sm-4 col-form-label">匯款銀行<font color="#FF0000">*</font></label>
                <div class="col-sm-8" >
                    <input class="form-control" type="text" name="bank_name" placeholder="請輸入匯款銀行名稱" required="required" value="{{$shop_config->bank_name}}" >
                </div>
            </div>

            <div class="form-group row">
            <label for="bank_port" class="col-sm-4 col-form-label">匯款銀行代碼</label>
                <div class="col-sm-8" >
                    <input class="form-control" type="number" name="bank_port"  placeholder="請輸入匯款銀行代碼"   onkeydown="limit(this,3);" onkeyup="limit(this,3);" value="{{$shop_config->bank_port}}">
                </div>
            </div>

            <div class="form-group row">
                <label for="card_number" class="col-sm-4 col-form-label">匯款帳號<font color="#FF0000">*</font></label>
                <div class="col-sm-8" >
                    <input class="form-control creditCardText" type="tel" name="card_number" placeholder="請輸入匯款帳號" required="required" value="{{$shop_config->card_number}}">
                </div>
            </div>
            </div>

            <!--<div class="card py-4 px-5 mb-3">
            <div class="form-group row">
            <label for="ship_tax" class="col-sm-4 col-form-label">商品運費 (元)</label>
                <div class="col-sm-8" >
                    <input class="form-control" type="number" name="ship_tax" placeholder="請輸入商品運費 (預設為0元)"  value="{{$shop_config->ship_tax}}">
                    <small class="col-sm-4 text-secondary">客戶的訂單會加上此運費</small>
                </div>
            </div>
            </div>-->
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
window.addEventListener('load', function () {
    document.getElementById('nav_title').innerHTML="商家資訊";
});
/*$('.creditCardText').keyup(function() {
  var foo = $(this).val().split("-").join(""); // remove hyphens
  if (foo.length > 0) {
    foo = foo.match(new RegExp('.{1,4}', 'g')).join("-");
  }
  $(this).val(foo);
});*/
function limit(element,max)
{
    var max_chars = max;

    if(element.value.length > max_chars) {
        element.value = element.value.substr(0, max_chars);
    }
}
</script>
@endsection
