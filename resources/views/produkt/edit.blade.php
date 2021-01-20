@extends('layouts.app')

@section('content')

    <form action="/produkt/{{$produkt->id}}" method="POST" enctype="multipart/form-data">
        {{ method_field('PUT') }}
        <div class="container">
        @include("produkt.form")

   <div class="form-obrazok">
       <h3>Obrázok</h3>
       <img src="/storage/{{$produkt->obrazok}}" alt="">

   </div>
    <div class="mt-2">
        <input type="file" name="obrazok" accept="image/*">
        @error('obrazok')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
        <div class="py-2">
            <h3>Kategória</h3>
            <select name="kategoria">
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
<div>
    <h3>Viditelnosť pre zákazníka</h3>
    <select name="vymazane">
        <option value="0" @if(!$produkt->vymazane) selected @endif>Nevymazane</option>
        <option value="1" @if($produkt->vymazane) selected @endif>Vymazane</option>
    </select>

</div>

<div class="mt-2">
    <button type="submit">Uložiť zmeny</button>
</div>
        </div>
    </form>
@endsection



