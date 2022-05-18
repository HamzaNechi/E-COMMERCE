<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/Boutique',function(){
    return view('vitrine.boutique');
});



Route::get('/DProduit',function(){
    return view('vitrine.popup_produit');
});

Route::get('/Panier',function(){
    return view('vitrine.cart');
});

Route::get('/Commande',function(){
    return view('vitrine.checkout');
});

Route::get('/Merci',function(){
    return view('vitrine.commande_envoyer');
});

Route::get('/Wishlist',function(){
    return view('vitrine.wishlist');
});

Route::get('/Pack',function(){
    return view('vitrine.packclient');
});

Auth::routes();

Route::get('/Liste_Fournisseur', function () {
    return view('dashboard.Liste_Fournisseur');
});

Route::get('/Ajout_Fournisseur', function () {
    return view('dashboard.Ajout_Fournisseur');
});

Route::get('/profile', function () {
    return view('dashboard.profile');
});

Route::get('/Categorie', function () {
    return view('dashboard.categorie');
});

Route::get('/Ajout_categorie',function(){
	return view('dashboard.ajout_categorie');
});

Route::get('/View_cat',function(){
	return view('dashboard.souscategorie');
});

Route::get('/Ajout_Produit',function(){
	return view('dashboard.ajout_produit');
});

Route::get('/Produit',function(){
	return view('dashboard.produit');
});

Route::get('/VoirFacture',function(){
    return view('dashboard.tous_facture');
});



Route::get('/Ajout_code_promo',function(){
    return view('dashboard.Ajout_Coupon');
});

Route::get('/Code_promo',function(){
    return view('dashboard.codepromo');
});

Route::get('/Modifier_code_promo',function(){
    return view('dashboard.updateCoupon');
});

/*Route::get('/Facture',function(){
    return view('dashboard.facture');
});*/



Route::get('/AjoutCommande',function(){
    return view('dashboard.AjouterCommandeManuel');
});

Route::get('/Commande_Admin',function(){
    return view('dashboard.commande');
});

Route::get('/Detail_commande',function(){
    return view('dashboard.detail_commande');
});





Route::get('/Compte',function(){
    return view('dashboard.compte');
});

Route::get('/ModifierFacture',function(){
    return view('dashboard.ModifierFacture');
});

Route::get('/Ajouter_commande',function(){
    return view('dashboard.fournisseur.Ajouter_commande');
});

Route::get('/VoirCommande',function(){
    return view('dashboard.fournisseur.voircommande');
});

Route::get('/DevisFournisseur',function(){
    return view('dashboard.fournisseur.devisfournisseur');
});

Route::get('/DemmandeDevis',function(){
    return view('dashboard.fournisseur.demandeDevis');
});

Route::get('/AjouterEmployer',function(){
    return view('dashboard.employeur.addemployeur');
});

//Route dashboard
Route::get('/home', 'HomeController@index');
Route::get('/Compte', 'HomeController@compte');
Route::get('/Liste_Fournisseur', 'FournisseurController@Fournisseur');
Route::post('/Ajout-F', 'FournisseurController@add_supplier');
Route::get('Fournisseur/supprimer','FournisseurController@destroy');
Route::get('/search_F', 'FournisseurController@search');
Route::get('/search_C', 'HomeController@search');
Route::post('/modifier_Compte/{id}', 'HomeController@update');
Route::get('/Changer_mot_de_passe','HomeController@updatepassword');
Route::get('/profile','HomeController@modifierprofile');



//route catégories
Route::resource('/categorie','CategorieController');
Route::get('/Ajout_categorie','CategorieController@Level');
Route::get('/Categorie','CategorieController@index');
Route::get('/Supprimer','CategorieController@destroy');
Route::get('/Detail/{id}','CategorieController@detailcat');
Route::get('/search_Cat', 'CategorieController@search');
Route::match(['get','post'],'/Modifier/{id}','CategorieController@update');






//route produit
Route::get('/Ajout_Produit','ProduitController@categorie_id');
Route::post('/AddProduct','ProduitController@addproduct');
Route::get('/ViewProduit','ProduitController@viewProduct');
Route::get('/Admin/DetailProduit/{id}','ProduitController@viewProductDetail');
Route::get('/Supprimer_produit','ProduitController@destroy');
Route::get('/Supprimer_attribut','ProduitController@destroyAtt');
Route::get('/Supprimer_image/{id}','ProduitController@destroy_image');
Route::get('/search_Prod', 'ProduitController@search');
Route::match(['get','post'],'/edit-product/{id}','ProduitController@editProduct');
Route::match(['get','post'],'/add-attribute/{id}','ProduitController@AddAttribute');
Route::match(['get','post'],'/add-image/{id}','ProduitController@AddImage');
Route::match(['get','post'],'/Modifier_attribut/{id}','ProduitController@editAttribut');







//route vitrine(page welcome)
Route::get('/','IndexController@get_products');
Route::get('/Boutique','IndexController@get_shop_products');
Route::get('/Boutique_filtrer/{id}','IndexController@getCategorieProduct');
Route::get('/packpageboutique','IndexController@getPacksShop');
/************Trier par */
Route::get('/TrierPar/{tag}','IndexController@SortByInShop');
/************fin section trier par */
/****Route annuler commande du vitrine**/
Route::get('/Client/Commande','IndexController@MyCommandClient');
Route::get('/AnnulerCommande/{id}','CommandeController@AnnulerCommande');
//Route for detail produit vitrine
Route::get('/Produit/{id}','IndexController@product');
Route::get('/DetailProduit/{id}','IndexController@productPopUp');
//Route for add to cart
Route::match(['get','post'],'/add_cart','IndexController@addtocart');
//Panier page
Route::match(['get','post'],'/Panier','IndexController@cart');
//****Delete product from cart page****//
Route::get('/Panier/Effacer-Produit/{id}','IndexController@deleteCartProduct');
//****update quantity from cart page****//
Route::match(['get','post'],'/Panier/Modifier-Quantite/{id}/{qty}','IndexController@UpdateeCartQuantity');
Route::get('/Panier/Increment_Quantite/{id}/{qty}','IndexController@UpdateeCartQuantityIncrement');
/**get attribute price**/
Route::get('/Prix_produit','IndexController@getProductprice');









//Code promo
Route::post('/AjoutCoupon','CouponController@addCoupon');
Route::get('/AfficheCoupon','CouponController@affiche_coupon');
Route::get('Codepromo/efface','CouponController@destroy');
Route::match(['get','post'],'/Modifier_code/{id}','CouponController@updatecode');
Route::post('/Appliquer_code','IndexController@applyCoupon');
Route::get('/search_code', 'CouponController@search');




//Route Checkout (commande) page
Route::match(['get','post'],'/Commande','IndexController@checkout');
Route::post('/Ajouter_Commande','CommandeController@Ajouter_commande');
Route::get('/Commande_Client','CommandeController@voir_commande');
Route::get('/Commande_Fourni','CommandeController@voir_commande_f');
Route::get('/Detail_commande/{id}','CommandeController@detail_commande');
Route::get('/Rechercher_commande','CommandeController@Search_command');
Route::get('/Rechercher_commande_date','CommandeController@Search_command_par_date');
Route::get('/Supprimer_commande','CommandeController@Delete');
Route::get('/Modifier_Etat','CommandeController@Edit_Etat');
Route::match(['get','post'],'/Commande/Modification/{id}','CommandeController@UpdateCommand');
Route::post('/Commande/AjouterProduit','CommandeController@AddproductUpdate');
Route::get('/Commande/Supprimer/Produit/{id}','CommandeController@DeleteProductFromCommand');
Route::get('/Modifier/Commande/Supprimer/Produit/{id}','CommandeController@DeleteProductFromUpdateCommand');
Route::post('/Effacer/Tous','CommandeController@DeleteAllSelected');
Route::get('/Exporter/Commandes','CommandeController@Export20CommandePdf');

//commande
Route::post('/Ajouter_au_panier','CommandeController@AjouterAupanier');
Route::get('/Afficher/Produit/{id}','CommandeController@get_product_json');
//commandefournisseur
Route::get('/VoirCommande/{id}','CommandeController@voir_commande_fournisseur');
Route::get('/Ajouter_commande','CommandeController@add_command_supplier');
Route::post('/Ajouter_produit_commande','CommandeController@AjouterProduitCommander');
Route::get('/PasserCommande','CommandeController@PasserCommande');
Route::get('/produitsducatégorie/{id}','CommandeController@TrierProduitCategorie');
//commande manuel
Route::post('/AjoutCommande','CommandeController@AjoutCommandManuel');
Route::get('/AjoutCommande','CommandeController@getAllProductForCommandManuel');


//route facture
Route::get('/Facture/{id}','FactureController@Add_invoice');
Route::get('/VoirFacture','FactureController@index');
Route::get('/LesFactureDuFournisseur','FactureController@index2');
Route::get('/Supprimer_facture','FactureController@destroy');
Route::get('/Rechercher_facture','FactureController@Search');
Route::get('/facture_en_pdf/{id}','FactureController@ImprimerFacturePdf');
Route::post('/AjouterProduitFacture','FactureController@AjouterProduitFacture');
Route::get('/EffacerProduitDeFacture/{id}','FactureController@DeleteProduct');
Route::get('/Taille/{id}','FactureController@get_size');
//Route::match(['get','post'],'/ModifierFacture/{id}','FactureController@ModifierFacture')->name('produitF');
Route::get('/ModifierFacture/{id}','FactureController@get_element_update_invoice');
Route::post('/ModifierFacture/{id}','FactureController@ModifierFacture');
Route::post('/Modifier/AjouterProduit/{id}','FactureController@AjouterProduitFactureModification');
Route::get('/MesFactures','FactureController@FactureF');
Route::get('/RechercherParDate','FactureController@SearchDate');
Route::get('/Sélection/Supprimmer','FactureController@DeleteAllSelected');
Route::get('/Exporter/Facture','FactureController@Export20FacturePdf');

//Route facture personnalisé
Route::get('/Personnaliser/Facture','FactureController@FacturePersonnel');
Route::post('/Personnaliser/Facture','FactureController@AddFacturePersonnel');
Route::get('/FacturePersonnaliser','FactureController@get_facture_personal');
Route::get('/Rechercher_facture_personnel','FactureController@SearchInvoicePersonnal');
Route::get('/Paiement','FactureController@Pay_a_slice');
Route::get('/Facture/Personnel/{id}','FactureController@PapperInvoice');
Route::match(['get','post'],'/Personnaliser/ModifierFacture/{id}','FactureController@UpdateInvoicePersonal');
Route::get('/Supprimer/Produit/Facture/{id}','FactureController@DeleteProductInvoicePersonal');
Route::post('/A-P-F-P-M/{id}','FactureController@APFPM');


//Route wishlist
Route::get('/Wishlist','WishlistController@get_element_for_page');
Route::get('/Ajouter_à_la_liste_de_souhaits/{id}','WishlistController@add_to_wishlist');
Route::get('/Wishlist/Effacer-Produit/{id}','WishlistController@Delete_product_to_wishlist');




//Route devis
Route::get('/DemmandeDevis','DevisController@Get_Element_Devis');
Route::post('/Ajouter_produit_devis','DevisController@AjouterProduitDevis');
Route::get('/Devis','DevisController@Add_devis');
Route::get('/DevisFournisseur','DevisController@index');
Route::get('/Admin/devis','DevisController@index2');
Route::get('/Devis/Recherche','DevisController@search');
Route::get('/Devis/Supprimer','DevisController@destroy');
Route::get('/Devis/DemanderDevis/SupprimerProduit/{id}','DevisController@DeleteProduct');
Route::get('/Devis/Detail/{id}','DevisController@detailDevis');
Route::get('/devis_en_pdf/{id}','DevisController@ImprimerDevisPdf');

Route::post('/ModifierDevis/AjouterProduit/{id}','DevisController@AddproductInUpdateDevis');

//route devis personnalisé
Route::get('/DevisManuel','DevisController@DevisPersonnel');
Route::post('/DevisManuel','DevisController@AddDevisPersonnel');
Route::get('/DevisManuel/Devis','DevisController@get_devis_personal');
Route::get('/Devis/Personnel/{id}','DevisController@PapperDevis');
Route::match(['get','post'],'/Personnaliser/ModifierDevis/{id}','DevisController@UpdateDevisPersonnel');
Route::get('/Supprimer/TousSéléctionner','DevisController@DeleteAllSelected');
Route::get('/Exporter/Devis','DevisController@Export20DevisPdf');



//Route gestion RH
/**gestion employeur**/
Route::get('/Employeur','EmployeurController@index');
Route::post('/AjouterEmployer','EmployeurController@AddEmployer');
Route::get('/Employeur/Supprimer','EmployeurController@Destroy');
Route::match(['get','post'],'/Employeur/Modifier/{id}','EmployeurController@UpdateEmployer');
Route::get('/Employeur/Recherche','EmployeurController@SearchEmployer');
/***gestion présence**/
Route::get('/employeur/Presence','EmployeurController@presence');
Route::post('/employeur/Presence','EmployeurController@Addpresence');
Route::post('/Presence/Modifier','EmployeurController@UpdatePresence');
Route::get('/Presence/Supprimer','EmployeurController@destroyPresence');
Route::get('/Presence/Recherche','EmployeurController@Searchpresent');
Route::get('/Presence/Recherche/Date','EmployeurController@SearchPresentWithDate');
/***gestion congés**/
Route::get('/Congés','EmployeurController@Vacance');
Route::post('/Congés/AjouterVacance','EmployeurController@AddVacance');
Route::get('/Vacance/Supprimer','EmployeurController@destroyVacance');
Route::get('/Vacance/Recherche','EmployeurController@SearchVacanceWithName');
Route::get('/Vancance/Recherche/Mois','EmployeurController@SearchVacanceWithMonth');
Route::post('/Vacance/Modifier','EmployeurController@UpdateVacance');



//Gestion des packs
/*****Pack personnalisé****/
Route::get('/Pack','PackStandardController@Get_Catégorie');
Route::get('/pack-products/{id}', 'ProduitController@packProducts');
Route::post('/ajouteraupanierproduitdupack','PackStandardController@Ajouter_Pack_Au_Panier');
/*****Pack standard********/
Route::post('/Pack/Ajouter_produit','PackStandardController@AddProductInPAck');
Route::get('/Pack/Voir_Packs','PackStandardController@VoirPackStandard');
Route::get('/Pack/Detail_Pack/{id}','PackStandardController@VoirDetailPackStandard');
Route::get('/Pack/SupprimerProduit','PackStandardController@SupprimerProduit');
Route::get('/Pack/SupprimerProduit/{id}','PackStandardController@DeleteProduct');
Route::post('/Pack/Modifier/Ajouter_produit','PackStandardController@AddproductInEditPack');



//Route avis
Route::post('/ajoutervotreavis','AvisController@Add_Avis');
Route::get('/avis','AvisController@Get_Avis');
Route::get('/supprimerunavis','AvisController@destroy');
Route::get('/avisduproduit','AvisController@Sort_Avis_With_Product');
Route::get('/suppressionavismultiples','AvisController@Delete_All_Selected');
Route::get('/modifierstatusavis/{val}/{id}','AvisController@Modifier_Statut');

//Notification
//Admin Notification Mark As Read
Route::get('/markAsRead', 'HomeController@markAsReadNotifications');




//Route Article
Route::match(['get', 'post'],'/ajouter-article', 'ArticlesController@ajouterArticle');
Route::match(['get', 'post'],'/modifier-article/{id}', 'ArticlesController@modifierArticle');
Route::get('/voir-articles','ArticlesController@voirArticles');
Route::get('/articles','ArticlesController@viewArticles');
Route::get('/single-article/{id}','ArticlesController@viewSingleArticle');
Route::get('/Supprimer_article', 'ArticlesController@Delete');




//Statistique
Route::get('/home','StatController@statistique');