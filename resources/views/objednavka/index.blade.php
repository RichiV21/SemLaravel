@extends('layouts.app')

@section('content')

@forelse($objednavky as $objednavka)
    <a href="/objednavky/{{$objednavka->id}}">
        <h4> Objednavka číslo {{$objednavka->id}} Cena: {{$objednavka->cena}}€</h4>
    </a>
@empty
    <p>Ziadne objednavky</p>
@endforelse

@endsection
