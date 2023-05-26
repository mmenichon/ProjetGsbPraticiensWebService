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
            return json_encode($monErreur);
        } catch (MonException $e){
            $monErreur = $e->getMessage();
            return json_encode($monErreur);
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return json_encode($monErreur);
        }
    }

    /**
     * Authentifie le visiteur
     */
    public function signIn() {
        try {
            $json = file_get_contents('php://input');
            $loginJson = json_decode($json);
            if ($loginJson != null) {
                $login = $loginJson->login_visiteur;
                $pwd = $loginJson->login_pwd;
            } else {
                $login = "";
                $pwd = "";
            }
            $unVisiteur = new ServiceVisiteur();
            $connected = $unVisiteur->login($login, $pwd);
            return json_encode($connected);

        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return json_encode($monErreur);
        }
    }

    /**
     * Déconnecte le visiteur authentifié
     */
    public function signOut() {
        $unVisiteur = new ServiceVisiteur();
        $unVisiteur->logout();
        return json_encode("Déconnexion réussie");
    }

}
