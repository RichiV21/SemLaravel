@extends('layouts.app')

@section('content')
    <h2>{{$kategoria->nazov}}</h2>
    @include("produkt.vypis")
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{$produkty->links()}}
        </div>
    </div>
@endsection
