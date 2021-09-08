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
    <form action="{{ route('setting.page_update') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="card shadow mb-4 ">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h5 class="m-0 font-weight-bold text-success">布景設定</h5>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label for="display_rows" class="col-sm-4 col-form-label">首頁每列顯示商品數</label>
                <select class="form-select" name="display_rows" aria-label="Default select example">
                        @if($shop_config->display_rows=='1')
                                    <option  value="1" selected="selected">1</option>
                                    <option  value="2">2</option>
                                    <option  value="3">3</option>
                                    <option  value="4">4</option>
                                    <option  value="5">5</option>
                                    <option  value="6">6</option>
                        @endif
                        @if($shop_config->display_rows=='2')
                                    <option  value="1">1</option>
                                    <option  value="2" selected="selected">2</option>
                                    <option  value="3">3</option>
                                    <option  value="4">4</option>
                                    <option  value="5">5</option>
                                    <option  value="6">6</option>
                        @endif
                        @if($shop_config->display_rows=='3')
                                    <option  value="1">1</option>
                                    <option  value="2">2</option>
                                    <option  value="3" selected="selected">3</option>
                                    <option  value="4">4</option>
                                    <option  value="5">5</option>
                                    <option  value="6">6</option>
                        @endif
                        @if($shop_config->display_rows=='4')
                                    <option  value="1" >1</option>
                                    <option  value="2">2</option>
                                    <option  value="3">3</option>
                                    <option  value="4" selected="selected">4</option>
                                    <option  value="5">5</option>
                                    <option  value="6">6</option>
                        @endif
                        @if($shop_config->display_rows=='5')
                                    <option  value="1">1</option>
                                    <option  value="2">2</option>
                                    <option  value="3">3</option>
                                    <option  value="4">4</option>
                                    <option  value="5" selected="selected">5</option>
                                    <option  value="6">6</option>
                        @endif
                        @if($shop_config->display_rows=='6')
                                    <option  value="1">1</option>
                                    <option  value="2">2</option>
                                    <option  value="3">3</option>
                                    <option  value="4">4</option>
                                    <option  value="5">5</option>
                                    <option  value="6" selected="selected">6</option>
                        @endif

                </select>
            </div>
            <div class="form-group row">
                        <label for="bg_img" class="col-sm-4 col-form-label">商店背景圖片</label>
                        <div class="col-sm-8">
                        <input type="file" name="bg_img">

                        <input class="hidden_object" name="bg_old_img" value="{{$shop_config->bg_img}}">
                        @if($shop_config->bg_img!=null)
                            <button name="del_bg_btn" type="submit"class="btn btn-link text-danger">刪除背景</button>
                        @endif
                        <img src="{{$shop_config->bg_img}}"  style="max-height: 20rem; max-width: 20rem;">



                        <small>{{$shop_config->bg_img}}</small>

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
window.addEventListener('load', function () {
    document.getElementById('nav_title').innerHTML="布景設定";
});

</script>
@endsection
