@extends('layouts.app')

@section('content')

@if($objednavka)

<div class="container">
    <div class="row">
        <h2>Objednávka číslo {{$objednavka->id}}</h2>
        <div class="col-lg-12">
            <div class="row">
    @forelse($objednavka->produkty as $produkt)
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100">
                <a href="/produkt/{{$produkt->id}}"><img class="card-img-top" src="/storage/{{$produkt->obrazok}}" alt=""></a>
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="/produkt/{{$produkt->id}}">{{$produkt->nazov}}</a>
                    </h4>
                    <h5>{{$produkt->cena}}€  {{$produkt->pivot->mnozstvo}}ks</h5>
                    <p class="card-text">{{$produkt->popis}}</p>

                </div>
            </div>
        </div>
    @empty
        <p>Ziadne produkty v objednavke</p>
    @endforelse
            </div>
        </div>
    </div>
</div>
@else
    <p>Objednavka sa nenašla</p>
@endif

@endsection
