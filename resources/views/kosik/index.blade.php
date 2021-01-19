@extends('layouts.app')

@section('content')
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
        @forelse($produkty as $produkt)
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <a href="/produkt/{{$produkt->id}}"><img class="card-img-top" src="/storage/{{$produkt->obrazok}}" alt=""></a>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="/produkt/{{$produkt->id}}">{{$produkt->nazov}}</a>
                                    </h4>
                                    <h5>{{$produkt->cena}}€  {{$kosik[$produkt->id]["mnozstvo"]}}ks</h5>
                                    <p class="card-text">{{$produkt->popis}}</p>
                                </div>

                            </div>
                        </div>
            <form action="/kosik" method="POST">
                @csrf
                {{method_field("DELETE")}}
                <input type="hidden" name="produktid" value="{{$produkt->id}}">
                <button role="submit">Vymazať</button>
            </form>
        @empty
            <p>Prazdny kosik</p>
        @endforelse
                    </div>
                    @if(isset($kosik["total"]))
                    <p><br>Suma celkom {{$kosik["total"]}}€</p>
                    @else
                        <p><br>Suma celkom 0€</p>
                        @endif
                </div>
            </div>
            <form action="/objednavky" method="POST">
                @csrf
                <button role="submit">Vytvorit objednavku</button>
            </form>
        </div>

@endsection

