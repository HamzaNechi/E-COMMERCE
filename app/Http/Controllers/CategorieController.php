<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\categorie;
use App\produit;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorie=categorie::where('parent_id','=',0)->paginate(20);
        return view('dashboard.categorie')->with(array(
                'categorie' => $categorie,
            )
        );
    }

    

    public function search(Request $request){
        $name=$request->get('recherche');
        $categorie=categorie::where('nom','like','%'.$name.'%')->get();
        if ($categorie != NULL) {
            return view('dashboard.categorie')->with(
            array(
                'categorie' => $categorie,
            )
         );
        }
        else{
            return back();
        }
        
    }

    public function detailcat($id){
        $cat=categorie::where('parent_id','=',$id)->get();
        if(sizeof($cat) > 0){
            return view('dashboard.souscategorie')->with(
                array(
                    'cat'=>$cat,
                )
            );
        }else{
            return back()->with('flash_message_error',"La catégorie n'a pas des sous catégories");
        }
        
    }

    
    public function store(Request $request)
    {
       
            $data=$request->all();
            $categorie=new categorie;
            $categorie->nom=$data['nom'];
            $categorie->parent_id=$data['parent_id'];
            $categorie->description=$data['description'];
            $categorie->url=$data['url'];
            if($data['parent_id']==0){
                $categorie->status=0;
            }
            else{
                $categorie->status=1;
            }
            $categorie->save();
           // return view('dashboard.categorie')->with('flash_message_success','Catégorie ajouté avec succée');
            return redirect('/Categorie')->with('flash_message_success','Catégorie ajouter avec succés');
    }

    /****Retourner les catégories principales */
    public function Level(){
        $level=categorie::where('parent_id','=',0)->get();
        return view('dashboard.ajout_categorie')->with(array(
            'level' => $level,
        ));
    }

   
    public function update(Request $request, $id)
    {   $level=categorie::where('parent_id','=',0)->get();
        $categorie=categorie::find($id);
        if ($request->isMethod('post')) {
            $data=$request->all();
            $categorie->nom=$data['nom'];
            $categorie->parent_id=$data['parent_id'];
            $categorie->description=$data['description'];
            $categorie->url=$data['url'];
            if($data['parent_id']==0){
                $categorie->status=0;
            }
            else{
                $categorie->status=1;
            }
            $categorie->update();
            return redirect('/Categorie')->with('flash_message_success','La catégorie est modifier');
        }else{
            return view('dashboard.update_categorie')->with(array(
                'categorie' => $categorie,
                'level' => $level,
            ));
        }
    }

    
    public function destroy(Request $request)
    {
        $id=$request->get('categorie');
        $cat=categorie::find($id);
        if ($cat->parent_id != 0) {
            $cat->delete();
        }else{
            $souscategorie=categorie::where("parent_id","=",$cat->id);
            $souscategorie->delete();
            $cat->delete();
        }
        
        return back();
        
    }
}
