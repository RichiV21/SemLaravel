
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
                                    <h5>{{$produkt->cena}}€</h5>
                                    <p class="card-text">{{$produkt->popis}}</p>
                                    <a href="/produkt/{{$produkt->id}}/edit">Edit</a>
                                </div>
                            </div>

                        </div>
                        <form action="/produkt/{{$produkt->id}}" method="POST">
                            @csrf
                            {{method_field("DELETE")}}
                            <button role="submit">Vymazať</button>
                        </form>

                    @empty
                        <p>Žiadne produkty</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>


