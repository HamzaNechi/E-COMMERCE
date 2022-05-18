<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            @if(Auth::user()->photo == "")
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="{{URL::asset('assets/images/faces/face1.jpg')}}" alt="profile">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">Admin</span>
                  <span class="text-secondary text-small">Project Manager</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            @else
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <?php $photo=Auth::user()->photo ; ?>
                  <img src='{{ URL::asset("img/$photo")}}' alt="profile">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">{{ Auth::user()->name}}</span>
                  <span class="text-secondary text-small">
                    @if(Auth::user()->role == 1)
                      Admin
                    @endif

                    @if(Auth::user()->role == 3)
                      Employeur
                    @endif

                    @if(Auth::user()->role == 2)
                      Fournisseur
                    @endif
                  </span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            @endif
            
            <li class="nav-item">
              <a class="nav-link" href="{{url('/home')}}">
                <span class="menu-title">Tableau de bord</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>

            @if(Auth::user()->role != 2)

            @if(Auth::user()->role == 1)
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/Compte')}}">
                <span class="menu-title">Compte &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</span>
                <i class="mdi mdi-account-key menu-icon"></i>
              </a>
            </li>
            @endif


            <li class="nav-item">
              <a class="nav-link" href="{{ url('/Liste_Fournisseur')}}">
                <span class="menu-title">Fournisseur &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </span>
                <i class="mdi mdi-account-multiple menu-icon"></i>
              </a>
            </li>

          

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#cat" aria-expanded="false" aria-controls="cat">
                <span class="menu-title">Catégories</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              </a>
              <div class="collapse" id="cat">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{ url('/Categorie')}}"> Voir Catégories </a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ url('/Ajout_categorie')}}"> Ajouter Catégorie </a></li>
                </ul>
              </div>
            </li>

            


            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#produit" aria-expanded="false" aria-controls="produit">
                <span class="menu-title">Produits</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-package-variant menu-icon"></i>
              </a>
              <div class="collapse" id="produit">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{ url('/ViewProduit')}}">Voir Produits</a></li>

                  <li class="nav-item"> <a class="nav-link" href="{{ url('/Pack/Voir_Packs')}}">Voir les packs</a></li>

                  <li class="nav-item"> <a class="nav-link" href="{{ url('/Ajout_Produit')}}">Ajouter Produit</a></li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#promo" aria-expanded="false" aria-controls="promo">
                <span class="menu-title">Code promo</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-gift menu-icon"></i>
              </a>
              <div class="collapse" id="promo">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{url('/AfficheCoupon')}}">Voir code promo</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{url('/Ajout_code_promo')}}">Ajouter code promo</a></li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#commande" aria-expanded="false" aria-controls="commande">
                <span class="menu-title">Commande</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-cart menu-icon"></i>
              </a>
              <div class="collapse" id="commande">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{ url('/Commande_Client')}}">Commande client</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ url('/Commande_Fourni')}}">Commande fournisseur</a></li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#devis" aria-expanded="false" aria-controls="devis">
                <span class="menu-title">Devis</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-file-import menu-icon"></i>
              </a>
              <div class="collapse" id="devis">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{ url('/Admin/devis')}}">Devis fournisseur</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ url('/DevisManuel/Devis')}}">Devis personnalisé</a></li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#fact" aria-expanded="false" aria-controls="fact">
                <span class="menu-title">Factures</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-note menu-icon"></i>
              </a>
              <div class="collapse" id="fact">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{ url('/VoirFacture')}}">Facture client</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ url('/LesFactureDuFournisseur')}}">Facture fournisseur</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ url('/FacturePersonnaliser')}}">Facture personnalisé</a></li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#rh" aria-expanded="false" aria-controls="rh">
                <span class="menu-title">GRH</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-account-card-details menu-icon"></i>
              </a>
              <div class="collapse" id="rh">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{ url('/Employeur')}}">Employeur</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{url('/employeur/Presence')}}">Présence</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ url('/Congés')}}">Congé</a></li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ url('/avis')}}">
                <span class="menu-title">Avis client&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</span>
                <i class="mdi mdi-comment-text menu-icon"></i>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#article" aria-expanded="false" aria-controls="article">
                <span class="menu-title">Articles</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-note menu-icon"></i>
              </a>
              <div class="collapse" id="article">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{ url('/ajouter-article')}}">Ajouter article</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{url('/voir-articles')}}">Voir articles</a></li>
                </ul>
              </div>
            </li>
            
            @else
            <?php $id=Auth::user()->id ; ?>

            


            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#promo" aria-expanded="false" aria-controls="promo">
                <span class="menu-title">Commandes</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-cart menu-icon"></i>
              </a>
              <div class="collapse" id="promo">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{ url('/VoirCommande',$id )}}">Voir commandes</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{url('/Ajouter_commande')}}">Ajouter commande</a></li>
                </ul>
              </div>
            </li>



            <!--Demander un devis-->
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#devis" aria-expanded="false" aria-controls="devis">
                <span class="menu-title">Devis</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-file-import menu-icon"></i>
              </a>
              <div class="collapse" id="devis">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{ url('/DevisFournisseur')}}">Voir devis</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ url('/DemmandeDevis')}}">Demander devis</a></li>
                </ul>
              </div>
            </li>

            <!--Voir facture-->
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/MesFactures')}}">
                <span class="menu-title">Mes Factures</span>
                <i class="mdi mdi-note menu-icon"></i>
              </a>
            </li>
            @endif

            
          </ul>
        </nav>