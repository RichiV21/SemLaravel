@extends('layouts.app')

@section('content')
        <div class="container">
            @if(isset($produkty) && count($produkty) > 0)
            <div class="row nadpis">
                <h4 class="col-2"></h4>
                <h4 class="col-4">Názov</h4>
                <h4 class="col-2">Množstvo</h4>
                <h4 class="col-2">Cena za kus</h4>
                <h4 class="col-2"></h4>
            </div>
            @endif
        @forelse($produkty as $produkt)
                <div class="row  riadok">
                <a class="col-2" href="/produkt/{{$produkt->id}}"><img class="card-img kosikImg " src="/storage/{{$produkt->obrazok}}" alt=""></a>
                    <h4 class="card-title borderKosik col-4" >
                        <a href="/produkt/{{$produkt->id}}">{{$produkt->nazov}}</a>
                    </h4>

                    <input type="text" class="borderKosik col-2" name="mnozstvo" placeholder="Mnozstvo" value="{{$kosik[$produkt->id]["mnozstvo"]}}" autocomplete="off">
                    @error('cena')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <h5 class="borderKosik col-2">{{$produkt->cena}}€</h5>
                    <form action="/kosik" method="POST" class="update col-1 border-right">
                        @csrf
                        {{method_field("PUT")}}
                        <input type="hidden" name="produktid" value="{{$produkt->id}}">
                        <button type="submit" class="tlacitko">Update</button>
                    </form>
                    <form action="/kosik" method="POST" class="removeFromCart col-1">
                        @csrf
                        {{method_field("DELETE")}}
                        <input type="hidden" name="produktid" value="{{$produkt->id}}">
                        <button type="submit" class="tlacitko">Vymazať</button>
                    </form>
            </div>
        @empty
            <h2>Prázdny košík</h2>
        @endforelse
                @if(isset($produkty) && count($produkty) > 0)
                    @if(isset($kosik["total"]))
                    <p><br>Suma celkom {{$kosik["total"]}}€</p>
                    @else
                        <p><br>Suma celkom 0€</p>
                        @endif

            <form action="/objednavky" method="POST">
                @csrf
                <button type="submit">Vytvorit objednavku</button>
            </form>
                @endif
        </div>
@endsection

