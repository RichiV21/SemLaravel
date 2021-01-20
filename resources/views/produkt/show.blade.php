@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-9">
            <div class="card mt-4">
                <img class="card-img-top img-fluid" id="gnprod" src="/storage/{{$produkt->obrazok}}" alt="">
                <div class="card-body">
                    <h3 class="card-title">{{$produkt->nazov}}</h3>
                    <h4>{{$produkt->cena}}€</h4>
                    <p class="card-text">{{$produkt->popis}}</p>
                    <form action="/kosik" method="POST" class="addtocart">
                        @csrf
                        <input type="hidden" name="produktid" value="{{$produkt->id}}">
                        <button type="submit">Pridať do Košika</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

