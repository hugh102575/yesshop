@extends('shop.home')

@section('stage')
            <div class="card">
                <!--<div class="card-header">{{ __('Dashboard') }}</div>-->

                <div class="card-body">
                {{$user->shop}}
                </div>
            </div>
@endsection

@section('js')
<script>

</script>
@endsection
