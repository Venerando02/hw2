<?php


namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Session;
use App\Models\User;
use App\Models\Article;
use Request;



class HomeController extends BaseController
{
    public function home()
    {
        if(!Session::get('user_id'))
        {
            return redirect('login');
        }
        $utente = User::find(Session::get('user_id'));
        return view('home')->with('utente', $utente);
    }

    public function searchGnews($query)
    {
        if(!Session::get('user_id'))
        {
            return redirect('login');
        }

        if(!empty($query))
        {
            $q = urlencode($query);
            $apikey = env('GNEWS_API_KEY');
            $url = "https://gnews.io/api/v4/search?q=$q&lang=it&country=it&category=sports&max=10&apikey=$apikey";

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($curl);
            curl_close($curl);
            return $data;
        }
        else
        {
            return response()->json(['error' => 'No query parameter provided']);
        }
    }

    public function lettura_articolo()
    {
        if (!Session::has('user_id')) 
        {
            return redirect('login');
        }
    
        $utente = User::find(Session::get('user_id'));
    
        $url_articolo = Request::post('url_articolo');
        $titolo = Request::post('titolo_articolo');
        $descrizione = Request::post('descrizione_articolo');
        $immagine = Request::post('immagine_articolo');
    
        if (!$url_articolo || !$titolo || !$descrizione || !$immagine) {
            return response()->json(['success' => false, 'message' => 'I dati dell\'articolo sono incompleti']);
        }
    
        $content_json = json_encode([
            'url' => $url_articolo,
            'title' => $titolo,
            'desc' => $descrizione,
            'img' => $immagine
        ]);
    
        $query_esistenza = Article::where('utente', $utente->id)->where('contenuto', $content_json)->exists();
        if ($query_esistenza) 
        {
            return response()->json(['success' => false, 'message' => 'Articolo già memorizzato']);
        } else {
            $articolo = new Article;
            $articolo->utente = $utente->id;
            $articolo->contenuto = $content_json;
            $articolo->save();
            return response()->json(['success' => true, 'message' => 'Articolo memorizzato con successo']);
        }
    }
}