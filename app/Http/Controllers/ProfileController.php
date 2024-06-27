<?php


namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use Session;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Request;
use App\Models\SoccerPlayer;
use App\Models\Article;



class ProfileController extends BaseController
{
    public function profile()
    {
        if(!Session::has('user_id'))
        {
            return redirect('login');
        }

        $utente = User::find(Session::get('user_id'));
 
        return view('profile')->with('utente', $utente);
    }

    public function ControlPassword($password)
    {
        if(!Session::has('user_id'))
        {
            return redirect('login');
        }

        $utente = User::find(Session::get('user_id'));
        
        if(!empty($password))
        {
            $query_password = User::where('id', $utente->id)->pluck('password')->first();
            
            if($query_password)
            {
                if(password_verify($password, $query_password))
                {
                    return response()->json(['response' => true]);
                }
                else
                {
                    return response()->json(['response' => false, 'message' => 'Le password non coincidono']);
                }
            }
        }
        else
        {
            return response()->json(['response' => false, 'message' => 'Password non inserita']);
        }
    }
    
    public function ChangePassword()
    {
        if(!Session::has('user_id'))
        {
            return redirect('login');
        }

        if(!empty(Request::post('old-password'))&&!empty(Request::post('new-password'))&&!empty('confirm-new-password'))
        {
            $user = User::find(Session::get('user_id'));
            $new_password = Request::post('new-password');
            $confirm_new_password = Request::post('confirm-new-password');
            if($new_password !== $confirm_new_password)
            {
                return response()->json(['update' => false, 'message' => 'le nuove password non coincidono']);
            }

            $new_password_hashed = password_hash($new_password, PASSWORD_BCRYPT);
            $user->password = $new_password_hashed;
            $user->save();
            if($user)
            {
                return redirect('profile')->with(['update' => true, 'message' => 'Password modificata con successo!']);
            }
            else
            {
                return redirect('profile')->with(['update' => false, 'message' => 'password non modificata']);
            }
        }
        else
        {
            return redirect('profile')->with(['update' => false, 'message' => 'campi non compilati']);
        }
    }

    public function MostraArticoliLetti()
    {
        if (!Session::has('user_id'))
        {
            return redirect('login');
        }
        $utente = User::find(Session::get('user_id'));
        $letture = Article::where('utente', $utente->id)->limit(9)->get(['id_articolo', 'contenuto']);
        $articoli = [];
        foreach ($letture as $lettura) 
        {
            $articoli[] = [
                'id' => $lettura->id_articolo,
                'lettura' => json_decode($lettura->contenuto)
            ];
        }
        return response()->json($articoli);
    }

    public function MostraGiocatoriPreferiti()
    {
        if (!Session::has('user_id'))
        {
            return redirect('login');
        }
    
        $utente = User::find(Session::get('user_id'));
    
        $players = SoccerPlayer::where('utente', $utente->id)->limit(9)->get(['giocatore', 'info_giocatore']);
        $giocatori = [];
        foreach ($players as $player)
        {
            $giocatori[] = [
                'id_giocatore' => $player->giocatore,
                'info_giocatore' => json_decode($player->info_giocatore)
            ];
        }
        return response()->json($giocatori);
    }

    public function EliminaGiocatoriPreferiti($id)
    {
        if (!Session::has('user_id'))
        {
            return redirect('login');
        }
        $utente = User::find(Session::get('user_id'));
        if(!empty($id))
        {
            $query_elimina_giocatore = SoccerPlayer::where('utente', $utente->id)->where('giocatore', $id)->delete();
            if($query_elimina_giocatore)
            {
                return response()->json(['response' => true, 'id' => $id, 'message' => 'Eliminazione della riga avvenuta con successo']);
            }
            else
            {
                return response()->json(['response' => false, 'message' => 'Errore durante l\'eliminazione della riga']);
            }
        }
        else
        {
            return response()->json(['response' => false, 'message' => 'Parametro mancante nella richiesta']);
        }
    }

    

    public function EliminaArticoliLetti($id)
    {
        if (!Session::has('user_id'))
        {
            return redirect('login');
        }
        $utente = User::find(Session::get('user_id'));
        if(!empty($id))
        {
            $query_elimina_giocatore = Article::where('utente', $utente->id)->where('id_articolo', $id)->delete();
            if($query_elimina_giocatore)
            {
                return response()->json(['response' => true,'message' => 'Eliminazione della riga avvenuta con successo']);
            }
            else
            {
                return response()->json(['response' => false, 'message' => 'Errore durante l\'eliminazione della riga']);
            }
        }
        else
        {
            return response()->json(['response' => false, 'message' => 'Parametro mancante nella richiesta']);
        }
    }
}
