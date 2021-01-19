@csrf
<div>
    <input type="text" name="nazov" placeholder="Nazov" value="{{ old('nazov') ?? $produkt->nazov }}" autocomplete="off">
    @error('nazov')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<div>
    <input type="text" name="cena" placeholder="Cena" value="{{ old('cena') ?? $produkt->cena }}" autocomplete="off">
    @error('cena')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<div>
    <input type="text" name="popis" placeholder="Popis" value="{{ old('popis') ?? $produkt->popis }}" autocomplete="off">
    @error('popis')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

