@extends('layouts.web')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-home icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Dashboard
                <div class="page-title-subheading">Aqui podras ver información relevante del sistema
                </div>
            </div>
        </div>
        <div class="page-title-actions">
            <button type="button" data-toggle="tooltip" title="" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark" data-original-title="Dashboard">
                <i class="fa fa-star"></i>
            </button>

        </div>   
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-xl-4">
        <div class="card mb-3 widget-content bg-night-fade">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Total de usuarios</div>
                </div>
                <div class="widget-content-right">
                <div class="widget-numbers text-white"><span>{{$users}}</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-4">
        <div class="card mb-3 widget-content bg-arielle-smile">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Total de clientes</div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span>{{$customers}}</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-4">
        <div class="card mb-3 widget-content bg-premium-dark">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Total de facturas</div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-warning"><span>{{$invoices}}</span></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
