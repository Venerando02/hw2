<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Request;
use Session;
use App\Models\User;


class LoginController extends BaseController
{
    public function register_form() 
    {
        if(Session::has('user_id'))
        {
            return redirect('login');
        }

        return view('register'); 
    }

    public function do_register()
    {
        if(Session::has('user_id'))
        {
            return redirect('login');
        }

        $errori = array();

        if(!empty(Request::post('nome')) && !empty(Request::post('cognome')) && !empty(Request::post('email'))
        && !empty(Request::post('username')) && !empty(Request::post('password')) && !empty(Request::post('conferma_password')))
        {
            $nome = Request::post('nome');
            $cognome = Request::post('cognome');
            $email = Request::post('email');
            $username = Request::post('username');
            $password = Request::post('password');
            $conferma_password = Request::post('conferma_password');

            if(!preg_match("/^[a-zA-Z0-9_]+$/", $username))
            {
                $errori['username'] = 'Username non valido'; 
            }
            else
            {
                if(User::where('username', $username)->first())
                {
                    $errori['username'] = 'Username già utilizzato';
                }
            }
            
            if(strlen($password) < 8)
            {
                $errori['password'] = 'La password deve contenere almeno 8 caratteri';
            }

            if($password != $conferma_password)
            {
                $errori['conferma_password'] = 'Le password non coincidono';               
            }

            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $errori['email'] = 'Email non valida';
            }
            else
            {
                if(User::where('email', $email)->first())
                {
                    $errori['email'] = 'Email già esistente';
                }
            }

            if(count($errori) == 0)
            {
                $password_hashed = password_hash($password, PASSWORD_BCRYPT);
                $utente = new User;
                $utente->nome = $nome;
                $utente->cognome = $cognome;
                $utente->email = $email;
                $utente->username = $username;
                $utente->password = $password_hashed;
                $utente->save();
                Session::put('user_id', $utente->id);
                return redirect('home')->with('utente', $utente);
            }
        }
        else
        {
            $errori[] = "Non hai compilato tutti i campi";
        }
        return redirect('register')->withInput()->withErrors($errori);
    }

    public function login_form()
    {
        if(Session::has('user_id'))
        {
            return redirect('home');
        }
    
        return view('login'); 
    }

    public function do_login()
    {
        if(Session::has('user_id'))
        {
            return redirect('home');
        }
        
        $errori = array();

        if(!empty(Request::post('username')) && !empty(Request::post('password')))
        {
            $username = Request::post('username');
            $password = Request::post('password');

            $user = User::where('username', $username)->first();
            if(!$user)
            {
                $errori['username'] = 'Username non esistente';
            }
            else
            {
                if(!password_verify($password, $user->password))
                {
                    $errori['password'] = 'Password non trovata';
                }
            }
        }
        else
        {
            $errori['username'] = 'Inserisci username e password';
        }
        if(count($errori) == 0)
        {
            Session::put('user_id', $user->id);
            return redirect('home');
        }
        else
        {
            return redirect('login')->withInput()->withErrors($errori);
        }
    }

    public function checkEmail($email)
    {
        if(!empty($email))
        {
            $email_check = User::where('email', $email)->first();
            if($email_check)
            {
                return response()->json(['exists' => true]);
            }
            else
            {
                return response()->json(['exists' => false]);
            }
        }
        else
        {
            return response()->json(['exists' => false, 'message' => 'Non dovresti essere qui']);
        }
    }

    public function Logout()
    {
        Session::flush();
        return redirect('index');
    }

    public function checkUsername($username)
    {
        if(!empty($username))
        {
            $username_check = User::where('username', $username)->first();
            if($username_check)
            {
                return response()->json(['exists' => true]);
            }
            else
            {
                return response()->json(['exists' => false]);
            }
        }
        else
        {
            return response()->json(['exists' => false, 'message' => 'Non dovresti essere qui']);
        }
    }
}
