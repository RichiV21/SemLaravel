@extends('layouts.app')

@section('content')
    <div class="container">
    @forelse($objednavky as $objednavka)
        <a href="/objednavky/{{$objednavka->id}}" class="objednavkaVypis">
            <h4> Objednavka číslo {{$objednavka->id}}</h4>
            <h5> Cena: {{$objednavka->cena}}€</h5>
        </a>
    @empty
        <h2>Žiadne objednavky</h2>
    @endforelse
    </div>
@endsection
