@extends('dashboard.layouts.app')

@section('css')
@endsection()



@section('content')

    <div class="container">
        <div data-bs-theme="dark" class="mt-5">
            <a class="btn btn-primary" href="{{ route('dashboard') }}">Dashboard</a>
        </div>
        <div class="list-group mt-5">
            <a href="{{ route('category.index') }}" class="list-group-item list-group-item-action list-group-item-dark">Kategoriler</a>
            <a href="#" class="list-group-item list-group-item-action list-group-item-secondary">Ürünler</a>
            <a href="#" class="list-group-item list-group-item-action list-group-item-primary">Siparişler</a>
        </div>
    </div>

@endsection


@section('js')
@endsection
