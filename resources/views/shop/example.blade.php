@extends('shop.home')

@section('stage')
<div class="col-md-8">
            <div class="card">
                <!--<div class="card-header">{{ __('Dashboard') }}</div>-->

                <div class="card-body">
                {{Session::get('user')->shop}}
                </div>
            </div>
        </div>
@endsection

@section('js')
<script>

</script>
@endsection
