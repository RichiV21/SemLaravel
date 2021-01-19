@extends('layouts.app')

@section('content')

    <form action="/produkt/{{$produkt->id}}" method="POST" enctype="multipart/form-data">
        {{ method_field('PUT') }}
        @include("produkt.form")

        <input type="file" name="obrazok" accept="image/*">
        <img src="/storage/{{$produkt->obrazok}}">
        @error('obrazok')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="py-2">
            <select name="kategoria">
                <option value="" selected disabled hidden>Vyber kategóriu</option>
                @forelse($kategorie as $kategoria)

                    @if($produkt->kategorie()->count() != 0 && $kategoria->id == $produkt->kategorie[0]->id)
                        <option value="{{$kategoria->id}}" selected>{{$kategoria->nazov}}</option>
                    @else
                        <option value="{{$kategoria->id}}">{{$kategoria->nazov}}</option>
                    @endif
                @empty
                    <option value=""></option>
                @endforelse
            </select>
        </div>
        <button role="submit">Odoslat</button>
    </form>
@endsection



