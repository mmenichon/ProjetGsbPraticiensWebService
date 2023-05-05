<?php

namespace App\Http\Controllers;

use App\DAO\ServicePraticien;
use App\DAO\ServiceSpecialite;
use App\Exceptions\MonException;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class PraticienController
{
    // Json OK
    public function getListePraticiens() {
        try {
            $unServicePraticien = new ServicePraticien();
            $mesPraticiens = $unServicePraticien->getPraticiens();
            if ($mesPraticiens != null) {
                return json_encode($mesPraticiens);
            } else {
                return json_encode("Aucun praticiens trouvé");
            }
        } catch (MonException $e){
            $monErreur = $e->getMessage();
            return json_encode($monErreur);
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return json_encode($monErreur);
        }
    }

    // Json OK
    public function postSearch() {
        try {
            $json = file_get_contents('php://input');
            $searchJson = json_decode($json);
            if ($searchJson != null) {
                $recherche = $searchJson->recherche;
            } else {
                $recherche = "";
            }

            $unServiceSpecialite = new ServiceSpecialite();
            $searchSpecialite = $unServiceSpecialite->searchSpecialite($recherche);
            $unServicePraticien = new ServicePraticien();
            $searchPraticien = $unServicePraticien->searchPraticien($recherche);

            return json_encode(array($searchSpecialite, $searchPraticien));
        } catch (MonException $e){
            $monErreur = $e->getMessage();
            return json_encode($monErreur);
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return json_encode($monErreur);
        }
    }

}
