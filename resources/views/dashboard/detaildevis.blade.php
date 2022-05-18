<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.harnishdesign.net/html/koice/index-invoice-flights.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Mar 2021 19:56:22 GMT -->
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="{{URL::asset('assets/images/logo-mini.png')}}" style="width: 2px; height: 20px;" rel="icon" />
<title>Devis</title>
<meta name="author" content="harnishdesign.net">

<!-- Web Fonts
======================= -->
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900' type='text/css'>

<!-- Stylesheet
======================= -->
<link rel="stylesheet" type="text/css" href="http://demo.harnishdesign.net/html/koice/vendor/bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="http://demo.harnishdesign.net/html/koice/vendor/font-awesome/css/all.min.css"/>
<link rel="stylesheet" type="text/css" href="http://demo.harnishdesign.net/html/koice/css/stylesheet.css"/>
</head>
<body>
<!-- Container -->
<div class="container-fluid invoice-container"> 
  <!-- Header -->
  <header>
    <div class="row align-items-center">
      <div class="col-sm-7 text-center text-sm-left mb-3 mb-sm-0"> <img id="logo" src="{{URL::asset('assets/images/logo.png')}}" title="VIORE" alt="VIORE" style="width:40%;height:40%;"/> </div>
      <div class="col-sm-5 text-center text-sm-right">
        <h4 class="mb-0">Devis</h4>
        
        <p class="mb-0">Numéro de devis - {{ $devis->id }}</p>
        
      </div>
    </div>
    <hr>
  </header>
  
  <!-- Main Content -->
  <main>
    <div class="row">
      <div class="col-sm-6 text-sm-right order-sm-1">
        
        <strong>Payer pour:</strong>
        <address>
        {{ $devis->client }}<br />
        {{ $devis->adresse, $devis->ville }}<br />
        {{ $devis->tel }}
        </address>
        
      </div>
      <div class="col-sm-6 order-sm-0"> <strong>Facturé à:</strong>
        <address>
        VIORE TUNISIE<br />
        Rue abu dhabi , Hammamet<br />
        8050<br />
        Nabeul
        </address>
      </div>
    </div>
    <div class="row">
      <!--<div class="col-sm-6 mb-3"> <strong>Mode de paiement:</strong><br>
        <span>Paiement à la livraison</span> </div>-->
    <div class="col-sm-6 mb-3"></div>
      <div class="col-sm-6 mb-3 text-sm-right"> <strong>Date :</strong>
        <span> {{ $devis->date }}</span> </div>
    </div>
    <div class="card">
      <div class="card-header px-3"> <span class="font-weight-600 text-4">Commande</span> </div>
      <div class="card-body px-2 py-0">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <td class="col-6 border-top-0"><strong>Désignation</strong></td>
                <td class="col-2 text-center border-top-0"><strong>Quantité</strong></td>
        <td class="col-2 text-center border-top-0"><strong>Prix</strong></td>
                <td class="col-2 text-right border-top-0"><strong>Total</strong></td>
              </tr>
            </thead>
            <tbody>
              @foreach($produits as $key)
              <tr>
        
                <td><span class="text-3">{{ $key->nom_produit }}</span> </td>
                <td class="text-center">{{ $key->qty }}</td>
                <td class="text-center">{{ $key->prix }}</td>
                
                <td class="text-right">{{ $key->total }}</td>
              </tr>
                @foreach($produit as $prod)
                  @if($prod->id == $key->id_produit && $prod->type=="pack")
                    <tr>
                      <td class="col-6 border-top-0" style="padding-left: 30px;"><strong>Ce pack contient</strong></td>
                      <td class="col-2 text-center border-top-0"><strong>Taille</strong></td>
                      <td class="col-2 text-center border-top-0"><strong></strong></td>
                      <td class="col-2 text-right border-top-0"><strong></strong></td>
                    </tr>
                    @foreach($produit_pack as $pp)
                      @if($pp->id_pack==$prod->id)
                        <tr>
                            <td style="border-top-style: none;"><span style="color:#82888c; padding-left: 20px;">{{ $pp->nom_produit }}(x {{ $pp->qty }})</span>
                              
                            </td>
                            <td class="text-center" style="border-top-style: none;color:#82888c;">
                              @if($pp->prod_taille == 0)
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
</svg>
                              @else
                              {{ $pp->prod_taille }}
                              @endif
                            </td>
                          <td class="text-center" style="border-top-style: none;"></td>
                          
                          <td class="text-right" style="border-top-style: none;"></td>
                        </tr>
                      @endif
                    @endforeach
                  @endif
                @endforeach
              @endforeach
              
              @if($devis->fournisseur_id == 0)
              <tr>
                <td colspan="2" class="bg-light-2 text-right"><strong>Sous-total</strong></td>
                <td colspan="2" class="bg-light-2 text-right">{{ $devis->total_ht }} TND</td>
              </tr>
              @if($devis->promo > 0)
              <tr>
                <td colspan="2" class="bg-light-2 text-right"><strong>Code promo:</strong><br>
                  <span class="text-1">{{ $devis->code }}</span></td>
                <td colspan="2" class="bg-light-2 text-right">-{{ $devis->promo }} TND</td>
              </tr>
              @endif
              <tr>
                <td colspan="2" class="bg-light-2 text-right"><strong>Livraison</strong></td>
                <td colspan="2" class="bg-light-2 text-right">7 TND</td>
              </tr>
              <tr>
                <td colspan="2" class="bg-light-2 text-right"><strong>Total</strong></td>
                <td colspan="2" class="bg-light-2 text-right">{{ $devis->total_ttc }} TND</td>
              </tr>
              @else
              <tr>
                <td colspan="2" class="bg-light-2 text-right"><strong>Total_ht</strong></td>
                <td colspan="2" class="bg-light-2 text-right">{{ $devis->total_ht }} TND</td>
              </tr>
              
              
                  @if($devis->tva > 0)
                  <tr>
                    <td colspan="2" class="bg-light-2 text-right"><strong>TVA</strong></td>
                    <td colspan="2" class="bg-light-2 text-right">{{ $devis->tva }} %</td>
                  </tr>

                  <tr>
                    <td colspan="2" class="bg-light-2 text-right"><strong>Timbre</strong></td>
                    <td colspan="2" class="bg-light-2 text-right">{{ $devis->timbre }} TND</td>
                  </tr>
                  @endif

                  <tr>
                    <td colspan="2" class="bg-light-2 text-right"><strong>Total TTC</strong></td>
                    <td colspan="2" class="bg-light-2 text-right">{{ $devis->total_ttc }} TND</td>
                  </tr>

              @endif
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <br>
    
  </main>
  <!-- Footer -->
  <footer class="text-center">
    <p class="text-1"><strong>NOTE :</strong> Il s'agit d'un reçu généré par ordinateur et ne nécessite pas de signature physique.</p>
  </footer>
  
</div>
</body>
</html>