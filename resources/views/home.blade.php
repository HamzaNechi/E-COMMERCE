@extends('layouts.app1')
@section('content')
<div class="row">
   @foreach($produit as $row) 
     @if($row->type == "produit")
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">{{ $row->nom }}</h4>
                    <div class="media"><br>
                    <br><br><br><br>
                     <img src="img/produit/m/{{ $row->image}}" style="border-radius:10%; width:20%;height:35%;"> &nbsp &nbsp &nbsp &nbsp
                      <div class="media-body">
                      <br>
                        <ul class="list-ticked">
                            <li>
                                <b>Stock initiale :</b> {{ $row->stock_init }}
                                    
                                
                            </li>
                            <br>
                            <li>
                                
                                    <b>Stock actuel :</b> {{ $row->total_stock }}
                                
                            </li>
                            <br>
                            <li>
                                
                                    <b>Stock vendu :</b> {{ $row->stock_init-$row->total_stock }}
                            </li>
                            
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
    </div>
              @endif
            @endforeach
</div>
@endsection
