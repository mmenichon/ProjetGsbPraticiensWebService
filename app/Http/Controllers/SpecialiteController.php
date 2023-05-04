<?php

namespace App\Http\Controllers;

use App\DAO\ServiceSpecialite;
use App\Exceptions\MonException;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class SpecialiteController
{
    public function getListeSpecialitesParPraticien($idPraticien) {
        try {
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $unServiceSpecialite = new ServiceSpecialite();
            $mesSpecialites = $unServiceSpecialite->specialitesParPraticien($idPraticien);
            // appel de la liste de toutes les spécialités
            $lesSpecialites = $unServiceSpecialite->autresSpecialites($idPraticien);

            // récupération de l'ID du praticien
            Session::put('id_praticien', $idPraticien);

            return view('vues/listeSpecialites', compact('mesSpecialites', 'lesSpecialites', 'monErreur'));
        }
        catch (MonException $e){
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        }
    }

    public function getDeleteSpecialite($idSpe) {
        try {
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $unServiceSpecialite = new ServiceSpecialite();
            $unServiceSpecialite->deleteSpecialite($idSpe);
            $mesSpecialites = $unServiceSpecialite->specialitesParPraticien(Session::get('id_praticien'));

            $lesSpecialites = $unServiceSpecialite->allSpecialites();
            return view('vues/listeSpecialites', compact('mesSpecialites', 'lesSpecialites', 'monErreur'));
        } catch (MonException $e){
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        }
    }

    public function postAddSpecialite() {
        try {
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $idPraticien = Session::get('id_praticien');
            $idSpecialite = Request::input('idSpecialite');
            $unServiceSpecialite = new ServiceSpecialite();
            $unServiceSpecialite->addSpecialite($idPraticien, $idSpecialite);

            $mesSpecialites = $unServiceSpecialite->specialitesParPraticien($idPraticien);
            $lesSpecialites = $unServiceSpecialite->autresSpecialites(Session::get('id_ancienneSpe'));
            return view('vues/listeSpecialites', compact('mesSpecialites', 'lesSpecialites', 'monErreur'));
        } catch (MonException $e){
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        }
    }

    public function getUpdateSpecialite($ancienneSpe) {
        try {
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $unServiceSpecialite = new ServiceSpecialite();
            $lesSpecialites = $unServiceSpecialite->autresSpecialites($ancienneSpe);

            // récupération id ancienne spécialité
            Session::put('id_ancienneSpe', $ancienneSpe);

            return view('vues/modifierSpecialite', compact('lesSpecialites', 'monErreur'));
        } catch (MonException $e){
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        }
    }

    public function postUpdateSpecialite() {
        try {
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $idPraticien = Session::get('id_praticien');
            $idSpecialite = Request::input('idSpecialite');
            $unServiceSpecialite = new ServiceSpecialite();
            $unServiceSpecialite->updateSpecialite($idPraticien, $idSpecialite);

            $mesSpecialites = $unServiceSpecialite->specialitesParPraticien($idPraticien);
            $lesSpecialites = $unServiceSpecialite->autresSpecialites(Session::get('id_ancienneSpe'));
            return view('vues/listeSpecialites', compact('mesSpecialites', 'lesSpecialites', 'monErreur'));
        } catch (MonException $e){
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        }
    }
}
