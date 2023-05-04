<?php

namespace App\Http\Controllers;

use Exception;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use App\DAO\ServiceVisiteur;
use App\Metier\Visiteur;


class VisiteurController extends Controller
{
    /**
     * Initialise le formulaire d'authentification
     */
    public function getLogin() {
        try {
            $monErreur = "";
            return view('vues/formLogin', compact('monErreur'));
        } catch (MonException $e){
            $monErreur = $e->getMessage();
            return view('vues\formLogin', compact('monErreur'));
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues\formLogin', compact('monErreur'));
        }
    }

    /**
     * Authentifie le visiteur
     */
    public function signIn() {
        try {
            $login = Request::input('login');
            $pwd = Request::input('pwd');
            $unVisiteur = new ServiceVisiteur();
            $connected = $unVisiteur->login($login, $pwd);

            if ($connected) {
                if (Session::get('type') === 'P') {
                    return view('vues/homePraticien');
                } else {
                    return view('home');
                }
            } else {
                $monErreur = "Login ou mot de passe inconnu";
                return view('vues/formLogin', compact('monErreur'));
            }
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues/formLogin', compact('monErreur'));
        }
    }

    /**
     * Déconnecte le visiteur authentifié
     */
    public function signOut() {
        $unVisiteur = new ServiceVisiteur();
        $unVisiteur->logout();
        return view('home');
    }

}
