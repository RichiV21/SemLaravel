@extends('layouts.app')

@section('content')
    @include("produkt.vypis")
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{$produkty->links()}}
        </div>
    </div>
@endsection
