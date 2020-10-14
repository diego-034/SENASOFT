@extends('layouts.web')

@push('head')
    <link href="{{ asset('css/libs/select2.min.css') }}" rel="stylesheet">
@endpush

@push('endBody')
    <script src="{{ asset('js/libs/select2.min.js')}}"></script>
    @includeJS(["url" => "users/assets/_form-create.js"])
@endpush

@section('content')

    {{-- ENCABEZAOD --}}
    @if(!empty($User->id))
        <x-title-header title="Actualizar Usuario"
                        :urls="[['Usuarios', route('users-list')],['Usuario # '. $User->id]]">
        </x-title-header>
    @else
        <x-title-header title="Crear Usuario"
                        :urls="[['Usuarios', route('users-list')],['Crear Usuario']]">
        </x-title-header>
    @endif

    <div class="card p-0">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-xl-9">
                    <form method="POST">
                        @csrf
                        <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
                            <div class="col-xl-12 col-xxl-10">
                                <!--begin::Wizard Form-->
                                <form class="form fv-plugins-bootstrap fv-plugins-framework" id="kt_form">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-9">
                                            <!--begin::Wizard Step 1-->
                                            <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
                                                <h5 class="text-dark font-weight-bold mb-10">Datos del usuario:</h5>
                                                <!--begin::Group-->
                                                <div class="form-group row fv-plugins-icon-container">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Correo electrónico</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="input-group input-group-solid input-group-lg">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="pe-7s-user"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" class="form-control form-control-solid form-control-lg" name="email" value="">
                                                        </div>
                                                    <div class="fv-plugins-message-container"></div></div>
                                                </div>
                                                <!--end::Group-->
                                                <!--begin::Group-->
                                                <div class="form-group row fv-plugins-icon-container">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Correo electrónico</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="input-group input-group-solid input-group-lg">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="pe-7s-mail"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" class="form-control form-control-solid form-control-lg" name="email" value="">
                                                        </div>
                                                    <div class="fv-plugins-message-container"></div></div>
                                                </div>
                                                <!--end::Group-->
                                                <!--begin::Group-->
                                                <div class="form-group row fv-plugins-icon-container">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Rol<span class="text-danger">*</span></label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="input-group input-group-solid input-group-lg">
                                                            <select class="form-control select2" id="select2-rol" name="rol" required>
                                                                <option></option>
                                                                @foreach ($Roles as $rol)
                                                                    <option class="text-capitalize"
                                                                            value="{{$rol['type']}}"> {{$rol['type']}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::Group-->
                                                <!--begin::Group-->
                                                <div class="form-group row fv-plugins-icon-container">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Contraseña</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="input-group input-group-solid input-group-lg">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="pe-7s-lock"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" class="form-control form-control-solid form-control-lg" name="email" value="">
                                                        </div>
                                                    <div class="fv-plugins-message-container"></div></div>
                                                </div>
                                                <!--end::Group-->
                                                <!--begin::Group-->
                                                <div class="form-group row fv-plugins-icon-container">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Confirmar contraseña</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="input-group input-group-solid input-group-lg">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="pe-7s-lock"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" class="form-control form-control-solid form-control-lg" name="email" value="">
                                                        </div>
                                                    <div class="fv-plugins-message-container"></div></div>
                                                </div>
                                                <!--end::Group-->
                                            <!--begin::Wizard Actions-->
                                            <div class="d-flex justify-content-between border-top pt-10 mt-15">
                                                <div class="mr-2">
                                                </div>
                                                <div class="pt-2">
                                                    <button type="button" class="btn btn-success font-weight-bolder px-5 py-2" data-wizard-type="action-submit">Crear</button>
                                                </div>
                                            </div>
                                            <!--end::Wizard Actions-->
                                        </div>
                                    </div>
                                <div></div><div></div><div></div></form>
                                <!--end::Wizard Form-->
                            </div>
                        </div>
                    </form>
                </div>
            </div>            
        </div>
    </div>

@endsection
