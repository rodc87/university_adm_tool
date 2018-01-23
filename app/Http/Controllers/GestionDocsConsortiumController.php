<?php namespace Emiage\Http\Controllers;
use Auth;

use Emiage\Document;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use DB;
use Input;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class GestionDocsConsortiumController extends Controller {

  /**
	* Page principale Gestion de Docs Consortium
	* @return Response
	*/
  public function getDocsConsortium(){

    $alldocs = Document::paginate(15);
    return view('gestionDocsConsortium/DocsConsortium',['alldocs'=>$alldocs]);
  }

  /**
	* Get Liste de Docs Consortium
	* @return [Array] JSON
	*/
  public function getlistedocsconsortium(){

    $id_doc = Input::get('id_doc');
    $doc = Document::where('id_document',$id_doc)->get();

    return Response::json($doc);
  }

  /**
  * Telecharger Contenu d'un Document Consortium
  * @param [string] $rqfile  nom doc
  * @return document consortium
  */
  public function getDocsConsortiumContenu($rqfile){
    //File is stored under project/public/resources/autres_docs
    $file= public_path()."/resources/autres_docs/". $rqfile ;
    return Response::download($file,$rqfile);
  }

  /**
  * Ajouter Document Consortium
  * @return Response
  */
  public function getDocsConsortiumAjout(){
    return view('gestionDocsConsortium/ajouterDocsConsortium');
  }

  /**
  * Enregistrer Document Consortium
  * @return Response
  */
  public function postDocsConsortiumAjout(){
		$nom_document=Request::input('nom_document');
		$description_document=Request::input('description_document');
    $type_document = Request::input('type_document');
    $file = Request::file('filefield');

    Storage::disk('autres_docs')->put($file->getClientOriginalName(),File::get($file));

    //Create New Document
    $date = new \DateTime;
    $doc = new Document;
    $doc->nom_document = $nom_document;
    $doc->description_document= $description_document;
    $doc->document = $file->getClientOriginalName();
    $doc->type_document = $type_document;
    $doc->utilisateur_creation = Auth::user()->username;
    $doc->date_creation =$date;
    $doc->save();

    return redirect('DocsConsortium');
  }

  /**
  * Modifier Document Consortium
  * @return Response
  */
  public function getDocsConsortiumModification(){
    $doc = Document::all();

    return view('gestionDocsConsortium/modifierDocsConsortium',['doc'=>$doc]);
  }

  /**
  * Enregistrer Modification Document Consortium
  * @return Response
  */
  public function postDocsConsortiumModification(){
    //Get Module Params
    $nom_document=Request::input('nom_document');
		$description_document=Request::input('description_document');
    $type_document = Request::input('type_document');
    $document_a_modifier = Request::input('document_a_modifier');
    $file = Request::file('filefield');

    //Retrieve old Devoir Content
    $doc = Document::where('id_document',$document_a_modifier)->firstOrFail();
    //Delete File on Disk 'activites'
    Storage::disk('autres_docs')->delete($doc->document);
    //Replace content with new one
    Storage::disk('autres_docs')->put($file->getClientOriginalName(),File::get($file));

    //Update Devoir
    $date = new \DateTime;
    $doc->nom_document = $nom_document;
    $doc->description_document= $description_document;
    $doc->document = $file->getClientOriginalName();
    $doc->type_document = $type_document;
    $doc->utilisateur_creation = Auth::user()->username;
    $doc->date_creation =$date;
    $doc->save();

    return redirect('DocsConsortium');
  }

}
