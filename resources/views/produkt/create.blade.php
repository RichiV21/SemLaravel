@extends('layouts.app')

@section('content')
    <form action="/produkt" method="POST" enctype="multipart/form-data">
        @include("produkt.form")
        <div>
            <h3>Obrázok</h3>
            <input type="file" name="obrazok" accept="image/*" >
            @error('obrazok')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="py-2">
            <h3>Kategória</h3>
           <select name="kategoria">
               <option value="" selected disabled hidden>Vyber kategóriu</option>
               @forelse($kategorie as $kategoria)
                   <option value="{{$kategoria->id}}">{{$kategoria->nazov}}</option>
               @empty
                   <option value=""></option>
               @endforelse
           </select>
        </div>
        <button role="submit">Odoslat</button>
    </form>

@endsection


