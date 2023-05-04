<?php

namespace App\DAO;

use App\Exceptions\MonException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ServiceSpecialite
{
    // affiche la liste des spécialités par praticien
    public function specialitesParPraticien($idPraticien) {
        try {
            $lesSpecialitesPraticiens = DB::table('posseder')
                -> select('posseder.id_specialite', 'lib_specialite')
                -> join('specialite', 'specialite.id_specialite', '=', 'posseder.id_specialite')
                -> join('praticien', 'praticien.id_praticien', '=', 'posseder.id_praticien')
                -> where('posseder.id_praticien', '=', $idPraticien)
                -> get();
            return $lesSpecialitesPraticiens;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    // Autres specialites
    public function autresSpecialites($idSpecialite) {
        try {
            $idPraticien = Session::get('id_praticien');
            $lesSpecialites = DB::table('specialite')
                -> whereNotExists(function ($query) use ($idPraticien) {
                    $query
                        -> select(DB::raw(1))
                        -> from('posseder')
                        -> whereRaw('specialite.id_specialite = posseder.id_specialite')
                        -> where('posseder.id_praticien', '=', $idPraticien);
                })
                -> get();

            // récupération de l'ID de la spécialité
            Session::put('id_specialite', $idSpecialite);

            return $lesSpecialites;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    // liste de toutes les spécialités
    public function allSpecialites() {
        try {
            $allSpecialites = DB::table('specialite')
                -> select()
                -> get();
            return $allSpecialites;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function deleteSpecialite($idSpecialite) {
        try {
            DB::table('posseder')
                -> where('id_specialite', '=', $idSpecialite)
                -> where('id_praticien', Session::get('id_praticien'))
                -> delete();
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function addSpecialite($idPraticien, $idSpecialite) {
        try {
            DB::table('posseder')
                -> insert(['id_praticien' => $idPraticien,
                    'id_specialite' => $idSpecialite,
                    'diplome' => 'test',
                    'coef_prescription' => 8.7]);
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function updateSpecialite($idPraticien, $idSpecialite) {
        try {
            $formerSpecialite = Session::get('id_specialite');
            DB::table('posseder')
                -> where('id_praticien', '=', $idPraticien)
                -> where('id_specialite', '=', $formerSpecialite)
                -> update([
                    'id_specialite' => $idSpecialite
                ]);
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function searchSpecialite($libelle) {
        try {
            $result = DB::table('specialite')
                -> where('lib_specialite', 'LIKE', $libelle.'%')
                -> get();
                return $result;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

}
