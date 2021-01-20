
    <div class="container vypis" >
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    @forelse($produkty as $produkt)
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card h-100 produkt  @if($produkt->vymazane) Vymazane @endif">
                                <a href="/produkt/{{$produkt->id}}"><img class="card-img-top" src="/storage/{{$produkt->obrazok}}" alt=""></a>
                                <div class="card-body p-0" >
                                    <h4 class="card-title">
                                        <a href="/produkt/{{$produkt->id}}" class="vypisNazov">{{$produkt->nazov}}</a>
                                    </h4>
                                    <h5 class="vypisCena">{{$produkt->cena}}€</h5>
                                    <form action="/kosik" method="POST" class="addtocart">
                                        @csrf
                                        <input type="hidden" name="produktid" value="{{$produkt->id}}">
                                        <button type="submit" class="pridat">Pridať do Košika</button>
                                    </form>
                                    @guest
                                    @else
                                        @if(Auth::user()->isAdmin() && $zobraz)

                                            <a href="/produkt/{{$produkt->id}}/edit">Edit</a>
                                            <form action="/produkt/{{$produkt->id}}" method="POST">
                                                @csrf
                                                {{method_field("DELETE")}}
                                                <button type="submit">Vymazať</button>
                                            </form>
                                        @endif
                                    @endguest
                                </div>
                            </div>
                        </div>
                    @empty
                        <h2>Žiadne produkty</h2>
                    @endforelse
                </div>
            </div>
        </div>
    </div>


