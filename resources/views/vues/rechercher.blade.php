@extends('layouts.master')
@section('content')

    <h1>Les Praticiens</h1>
    <table class="table table-bordered table-striped table-responsive">
        <thead>
        <tr>
            <th style="widht:60%">Nom</th>
            <th style="widht:60%">Prénom</th>
            <th style="widht:60%">Spécialités</th>
        </tr>
        </thead>
        @foreach($searchPraticien as $unPraticien)
            <tr>
                <td> {{$unPraticien->nom_praticien}} </td>
                <td> {{$unPraticien->prenom_praticien}} </td>
                <td style="text-align: center;">
                    <a href="{{url('/specialitesPraticien')}}/{{$unPraticien->id_praticien}}">
                        <span class="glyphicon glyphicon-list" data-toggle="tooltip" data-placement="top" title="Modifier"></span></a>
                </td>
            </tr>
        @endforeach
    </table>

    <h1>Les Spécialités</h1>
    <table class="table table-bordered table-striped table-responsive">
        <thead>
        <tr>
            <th style="width: 60%">Libelle</th>
        </tr>
        </thead>
        @foreach($searchSpecialite as $uneSpecialite)
            <tr>
                <td> {{ $uneSpecialite->lib_specialite }} </td>
            </tr>
        @endforeach
    </table>

@stop
