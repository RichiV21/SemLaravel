@extends('layouts.app')

@section('content')
    <h2 class="kategoriaNazov"><span>{{$kategoria->nazov}}</span></h2>
    @include("produkt.vypis")
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{$produkty->links()}}
        </div>
    </div>
@endsection
