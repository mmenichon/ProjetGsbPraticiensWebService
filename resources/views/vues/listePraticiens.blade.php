@extends('layouts.master')
@section('content')
<div class="container">
    <div class="col-md-5">
        <div class="blanc">
            <h1>Liste des praticiens</h1>
        </div>

        <table class="table table-bordered table-striped table-responsive">
            <thead>
                <tr>
                    <th style="width:60%">Nom</th>
                    <th style="width:60%">Prénom</th>
                    <th style="width:60%">Spécialités</th>
                </tr>
            </thead>

            @foreach($mesPraticiens as $unPraticien)
            <tr>
                <td> {{ $unPraticien->nom_praticien }} </td>
                <td> {{ $unPraticien->prenom_praticien }} </td>
                <td style="text-align:center">
                    <a href="{{ url('/specialitesPraticien') }}/{{ $unPraticien->id_praticien }}">
                        <span class="glyphicon glyphicon-list" data-toggle="tooltip" data-placement="top" title="Spécialités"></span>
                    </a>
                </td>
            </tr>
            @endforeach
        </table>

    </div>
</div>
@stop
