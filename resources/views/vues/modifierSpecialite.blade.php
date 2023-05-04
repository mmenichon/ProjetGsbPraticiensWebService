@extends('layouts.master')
@section('content')
    {!! Form::open(['url' => 'updateSpecialite']) !!}
    <div class="container">
        <div class="col-md-5">
            <div class="blanc">
                <h1>Modifier une spécialité</h1>
            </div>

            <div class="col-md-10">
                <select class="form-control" name="idSpecialite" required>
                    <option value="0">Modifier une spécialité</option>
                    @foreach ($lesSpecialites as $laSpecialite)
                        <option value="{{ $laSpecialite->id_specialite }}">{{ $laSpecialite->lib_specialite }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                    <button type="submit" class="btn btn-default btn-primary">
                        <span class="glyphicon glyphicon-ok"></span> Valider</button>
                </div>
            </div>

        </div>
    </div>
    {!! Form::close() !!}
@stop
