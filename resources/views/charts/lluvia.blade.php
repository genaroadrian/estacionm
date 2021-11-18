@extends('layouts.layout')

@section('content')
<div class="row mt--2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Grafica de Lluvia</div>
                        <div class="card-tools">
                            <button style="display: none;" id="boton-actualizar" class="btn btn-icon btn-link btn-primary btn-xs"><span class="fa fa-sync-alt"></span></button>
                        </div>
                    </div>
                </div>
                
                <div class="card-category">
                    <form class="row">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rango de fechas</span>
                                </div>
                                <input id="fecha" type="text" name="fechas" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <button id="buscar" class="btn btn-primary mb-3" type="button">Aplicar</button>
                        </div>
                    </form>
                </div>
                    <div class="chart-container" id="direccion-chart-container">
                        <canvas id="direccionChart"></canvas>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection