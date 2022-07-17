@extends('page.show')

@section('pagebody')

    <div class="centralise">

        <h1>{{ $model->title }}</h1>

        {{-- <A href="{{ route('product.basket.add', ['sku'=>trim(json_encode([$model->sku, $model->sku]))]) }}">Test</a> --}}
        
        <A href="{{ route('product.basket.add', ['sku'=>$model->sku]) }}">Test</a>

        <A href="{{ route('product.basket.add.qty', ['sku'=>$model->sku, 'qty'=>5]) }}">Test Buy 5</a>

            

    </div>

@endsection