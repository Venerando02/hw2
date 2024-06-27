<?php


namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use Session;
use App\Models\User;
use Request;
use App\Models\SoccerPlayer;
use App\Models\Album;
use App\Models\Like;

class FanpageController extends BaseController
{
    public function fanpage()
    {
        if(!Session::get('user_id'))
        {
            return redirect('login');
        }

        return view('fanpage');
    }

    public function transfermarket1($calciatore)
    {
        if(!Session::get('user_id'))
        {
            return redirect('login');
        }

        if(!empty($calciatore))
        {
            $value_codified =  urlencode($calciatore);
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => "https://transfermarket.p.rapidapi.com/search?query=" . $value_codified . "&domain=it",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => [
                    "X-RapidAPI-Host: transfermarket.p.rapidapi.com",
                    "X-RapidAPI-Key: " . env('RAPIDAPI_KEY') 
                ],
            ]);
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if($err)
            {
                return(['Curl Error #:' . $err]);
            }
            else
            {
                return $response;
            }
        }
    }

    public function transfermarket2($id)
    {
        if(!Session::get('user_id'))
        {
            return redirect('login');
        }

        if(!empty($id))
        {
            $value_id_codified = urlencode($id);
            $curl = curl_init();
            curl_setopt_array($curl, 
            [
                CURLOPT_URL => "https://transfermarket.p.rapidapi.com/players/get-profile?id=" . $value_id_codified . "&domain=it",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => [
                    "X-RapidAPI-Host: transfermarket.p.rapidapi.com",
                    "X-RapidAPI-Key: " . env('RAPIDAPI_KEY')
                ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);
            if ($err)
            {
                return ["Curl Error #:" . $err];
            } else {
                return $response;
            }
        }
    }

    public function inserisci_giocatore()
    {
        if (!Session::get('user_id')) {
            return redirect('login');
        }
    
        $utente = User::find(Session::get('user_id'));
        $id_giocatore = Request::post('id');
        $nome_giocatore = Request::post('nome_g');
        $immagine_giocatore = Request::post('img_p');
        $immagine_club = Request::post('img_c');
        $nome_club = Request::post('club');
        $luogo_nascita = Request::post('p_birth');
        $birthday = Request::post('birthday');
        $eta = Request::post('age');
        $numero = Request::post('number');
        $goals = Request::post('goal');
        $valore_mercato = Request::post('value');
        $posizione = Request::post('pos');
    
        $content_json = json_encode([
            "name" => $nome_giocatore,
            "immagine_giocatore" => $immagine_giocatore,
            "immagine_club" => $immagine_club,
            "nome_club" => $nome_club,
            "luogo_nascita" => $luogo_nascita, 
            "compleanno" => $birthday,
            "eta'" => $eta,
            "numero_maglia" => $numero,
            "goals" => $goals,
            "valore" => $valore_mercato,
            "posizione" => $posizione
        ]);
    
        $query_esistenza = SoccerPlayer::where('utente', $utente->id)->where('giocatore', $id_giocatore)->exists();
        if ($query_esistenza) {
            return response()->json(['response' => false, 'message' => "Giocatore già esistente"]);
        } else {
            $football_player = new SoccerPlayer;
            $football_player->utente = $utente->id;
            $football_player->giocatore = $id_giocatore;
            $football_player->info_giocatore = $content_json;
            $football_player->save();
            return response()->json(['response' => true, 'message' => 'Inserimento avvenuto con successo']);
        }
    }

    public function Spotify()
    {
        if(!Session::has('user_id'))
        {
            return redirct('login');
        }

        $client_id = env('CLIENT_ID_SPOTIFY');
        $client_secret = env('CLIENT_SECRET_SPOTIFY');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials'); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Basic '.base64_encode($client_id.':'.$client_secret))); 

        $response = curl_exec($ch);
        if(curl_errno($ch)) 
        {
            echo json_encode(array('error' => curl_error($ch)));
            curl_close($ch);
            exit;
        }
        $token = json_decode($response, true);
        curl_close($ch);    

        if(!isset($token['access_token'])) 
        {
            return response()->json(['error' => 'Failed to obtain access token']);
            exit;
        }
        $url = 'https://api.spotify.com/v1/search?type=album&q=Fantacalcio';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token['access_token'])); 

        $res = curl_exec($ch);
        if(curl_errno($ch)) {
            return response()->json(['error' => curl_error($ch)]);
            curl_close($ch);
            exit;
        }

        curl_close($ch);
        return $res;
    }

    public function InsertAlbum()
    {
        if(!Session::get('user_id'))
        {
            return view('login');
        }

        $id_album = Request::post('id');
        $nome = Request::post('nome');
        $artista = Request::post('artista');
        $immagine = Request::post('immagine');
        $data_rilascio = Request::post('data');
        $url = Request::post('url');

        if(!$id_album || !$nome || !$artista || !$immagine || !$data_rilascio || !$url)
        {
            return response()->json(['response' => false, 'message' => 'Dati mancanti']);
        }

        if(Album::where('id', $id_album)->exists())
        {
            return response()->json(['response'=>false, 'message'=>'Album già presente nel database']);
        }
        else
        {
            $album = new Album;
            $album->id = $id_album;
            $album->nome = $nome;
            $album->artista = $artista;
            $album->immagine = $immagine;
            $album->data_rilascio = $data_rilascio;
            $album->url = $url;
            $album->save();
            if($album)
            {
                return response()->json(['response' => true, 'message' => 'Inserimento avvenuto con successo!']);
            }
            else
            {
                return response()->json(['response' => false]);
            }
        }
    }

    public function MostraAlbum()
    {
        if(!Session::get('user_id'))
        {
            return view('login');
        }

        $albums = Album::limit(6)->get();
        if($albums)
        {
            foreach($albums as $album)
            {
                $response[] = ([
                    'id' => $album->id,
                    'nome' => $album->nome, 
                    'artista' => $album->artista,
                    'immagine' => $album->immagine,
                    'data' => $album->data_rilascio,
                    'url' => $album->url
                ]);
            }
            return response()->json(['response' => true, 'albums' => $response]);
        }
        else
        {
            return response()->json(['response' => false, 'albums' => 'Errore nella query']);
        }
    }

    public function InserisciLike($album)
    {
        if(!Session::has('user_id')) 
        {
            return view('login');
        }

        $utente = User::find(Session::get('user_id'));

        if(!empty($album))
        {
            $query_verifica_album = Like::where('album', $album)->where('utente', $utente->id)->exists();
            if($query_verifica_album)
            {
                $numlike = Like::where('album', $album)->count();
                return response()->json(['response' => false, 'numero_like' => $numlike, 'message' => 'Like già presente']);
            }
            else
            {
                $like = New Like;
                $like->utente = $utente->id;
                $like->album = $album;
                $like->save();
                if($like)
                {
                    $contatore_like = Like::where('album', $album)->count();
                    return response()->json(['response' => true, 'numero_like' => $contatore_like, 'message' => 'Like Inserito']);
                }
                else
                {
                    return response()->json(['response' => false]);
                }
            }
        }
    }
    
    public function RimuoviLike($album)
    {
        if(!Session::get('user_id'))
        {
            return view('login');
        }

        $utente = User::find(Session::get('user_id'));
        if(!empty($album))
        {
            $rimuovi_like = Like::where('album', $album)->where('utente', $utente->id)->delete();
            if($rimuovi_like)
            {
                $new_n_like = Like::where('album', $album)->count();
                return response()->json(['response' => true, 'numero_like' => $new_n_like, 'message' => 'Like Rimosso']);
            }
            else
            {
                return response()->json(['response' => false,'message' => 'Errore durante l\'eliminazione']);
            }
        }
    }
}
    
