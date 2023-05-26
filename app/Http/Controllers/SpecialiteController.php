<?php

namespace App\Http\Controllers;

use App\DAO\ServiceSpecialite;
use App\Exceptions\MonException;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class SpecialiteController
{
    //Json OK mais on sait pas pourquoi
    public function getListeSpecialitesParPraticien($idPraticien) {
        try {
            $unServiceSpecialite = new ServiceSpecialite();
            $mesSpecialites = $unServiceSpecialite->specialitesParPraticien($idPraticien);

            // récupération de l'ID du praticien
            Session::put('id_praticien', $idPraticien);

            // appel de la liste de toutes les spécialités
            $lesSpecialites = $unServiceSpecialite->autresSpecialites($idPraticien);

            return json_encode(array($mesSpecialites, $lesSpecialites));
        }
        catch (MonException $e){
            $monErreur = $e->getMessage();
            return json_encode($monErreur);
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return json_encode($monErreur);
        }
    }

    //Json OK
    public function postDeleteSpecialite() {
        try {
            $json = file_get_contents('php://input');
            $deleteJson = json_decode($json);
            if ($deleteJson != null) {
                $idSpecialite = $deleteJson->idSpecialite;
                $idPraticien = $deleteJson->idPraticien;
            }

            $unServiceSpecialite = new ServiceSpecialite();
            $unServiceSpecialite->deleteSpecialite($idSpecialite, $idPraticien);
            $mesSpecialites = $unServiceSpecialite->specialitesParPraticien($idPraticien);

            $lesSpecialites = $unServiceSpecialite->allSpecialites();
            return json_encode(array($mesSpecialites, $lesSpecialites));
        } catch (MonException $e){
            $monErreur = $e->getMessage();
            return json_encode($monErreur);
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return json_encode($monErreur);
        }
    }

    // presque Ok, pb dans liste déroulante
    public function postAddSpecialite() {
        try {
//            $idPraticien = Session::get('id_praticien');
            $json = file_get_contents('php://input');
            $addJson = json_decode($json);
            if ($addJson != null) {
                $idPraticien = $addJson->idPraticien;
                $idSpecialite = $addJson->idSpecialite;
            }

            $unServiceSpecialite = new ServiceSpecialite();
            $unServiceSpecialite->addSpecialite($idPraticien, $idSpecialite);

            $mesSpecialites = $unServiceSpecialite->specialitesParPraticien($idPraticien);
            $lesSpecialites = $unServiceSpecialite->autresSpecialites($idPraticien);
            return json_encode(array($mesSpecialites, $lesSpecialites));
        } catch (MonException $e){
            $monErreur = $e->getMessage();
            return json_encode($monErreur);
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return json_encode($monErreur);
        }
    }

    // presque Ok, pb dans liste déroulante
    public function getUpdateSpecialite($ancienneSpe) {
        try {
            // récupération id ancienne spécialité
            Session::put('id_ancienneSpe', $ancienneSpe);
            $unServiceSpecialite = new ServiceSpecialite();
            $lesSpecialites = $unServiceSpecialite->autresSpecialites($ancienneSpe);
            return json_encode(array($lesSpecialites));
        } catch (MonException $e){
            $monErreur = $e->getMessage();
            return json_encode($monErreur);
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return json_encode($monErreur);
        }
    }

    public function postUpdateSpecialite() {
        try {
//            $idPraticien = Session::get('id_praticien');
            $json = file_get_contents('php://input');
            $updateJson = json_decode($json);
            if ($updateJson != null) {
                $idPraticien = $updateJson->idPraticien;
                $idAncienneSpe = $updateJson->ancienneSpe;
                $idSpecialite = $updateJson->idSpecialite;
            }

            $unServiceSpecialite = new ServiceSpecialite();
            $unServiceSpecialite->updateSpecialite($idPraticien, $idAncienneSpe, $idSpecialite);

            $mesSpecialites = $unServiceSpecialite->specialitesParPraticien($idPraticien);
            $lesSpecialites = $unServiceSpecialite->autresSpecialites(Session::get('id_ancienneSpe'));

            return json_encode(array($mesSpecialites, $lesSpecialites));
        } catch (MonException $e){
            $monErreur = $e->getMessage();
            return json_encode($monErreur);
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return json_encode($monErreur);
        }
    }
}
