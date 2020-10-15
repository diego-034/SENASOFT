@extends('layouts.web')

@push('head')
    <link href="{{ asset('css/libs/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/libs/jquery-confirm.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/libs/products.css') }}" rel="stylesheet">
@endpush

@push('endBody')
    <script src="{{ asset('js/libs/jquery-confirm.min.js')}}"></script>
    <script src="{{ asset('js/libs/jquery.repeater.js')}}"></script>
    <script src="{{ asset('js/libs/select2.min.js')}}"></script>
    @includeJS(["url" => "products/assets/_form-create.js"])
@endpush

@section('content')

    {{-- ENCABEZAOD --}}
    <x-title-header title="Actualizar Producto"
                    :urls="[['Productos', route('products-list')],['Producto # '. $response['OK']->id]]">
    </x-title-header>

<div class="card">
    <div class="card-body">
        <form action="{{ route('products-update',['id'=>$response['OK']->id]) }}" method="POST" class="repeater"  onsubmit="handleSubmit()" enctype="multipart/form-data" id="customForm">
            @csrf

            <div class="loading d-none">
                Cargando....
            </div>

            <div class="saving d-none"></div>

            <div class="row">
                <div class="col-12">
                    <div class="input-group w-25 float-right">
                        {{-- <input type="text" class="form-control" placeholder="Cantidad" id="numVeces" aria-label="Cantidad"
                            aria-describedby="button-addon2" style="width: 10%;">
                        <div class="input-group-append">
                            <button type="button" id="btn-add-products"
                                    class="btn btn-dark btn-sm"
                                    data-repeater-create input-quantity="numVeces"><i class="fa fa-plus"></i>
                                Agregar Producto
                            </button>
                        </div> --}}
                    </div>
                    <div class="col 12">
                        {{-- <div class="input-group w-25 float-right pr-5">
                            <div class="custom-file">
                                <input type="file" data-repeater-create-images name="imageMultiple" class="custom-file-input"
                                    id="file-multiple" aria-describedby="inputGroupFileAddon03" multiple> 
                                <label class="custom-file-label" style="white-space: nowrap;overflow: hidden;">Seleccionar</label>
                            </div>
                        </div> --}}
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">
                            <i class="fa fa-save mr-1"></i>
                            Actualizar Producto
                        </button>
                    </div>
                </div>
            </div>


            <hr>
            <div data-repeater-list="producto">

                <div data-repeater-item class="form-row border-bottom pt-3 pl-5">
                    
                    <div class="conent-img" style="width: 75px;height: 75px;overflow: hidden;border-radius: 3px; border: 1px solid #c2c2c2;">
                        <img name="imagePreview" style="width: 100%"/>
                    </div>

                    <div class="col-md-4">

                        <div class="col mb-3">
                            <label for="image">Seleccionar imágen <span class="text-danger">*</span></label>
                            <div class="custom-file">
                                <input type="file" name="image" onChange="onChangeFile(this, event)" class="custom-file-input"
                                    aria-describedby="inputGroupFileAddon03" required>
                                <label class="custom-file-label" style="white-space: nowrap;overflow: hidden;">Seleccionar</label>
                            </div>
                        </div>

                        <div class="col mb-3">
                            <label for="name">Nombre</span></label>
                            <input id="name" name="name" type="text" class="form-control" rows="2"
                                value="{{ !empty($response['OK']->name)?$response['OK']->name : ''}}">
                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="col mb-3">
                            <label for="description">Descripción</span></label>
                            <textarea class="form-control" maxlength="90" name="description" id="description" rows="1" 
                                    placeholder="Máximo de 90 caracteres"
                                    >{{ !empty($response['OK']->description)? $response['OK']->description : ''}}</textarea>
                        </div>

                        <div class="col mb-3">
                            <label for="value">Precio</span></label>
                            <input id="price" name="value" type="text" class="form-control"
                                value="{{ !empty($response['OK']->price)? $response['OK']->price : ''}}">
                        </div>

                    </div>

                    <div class="col-md-2">
        
                        <div class="col mb-3">
                            <label class="control-label">Estado</label>
                            <select class="select2 form-control" name="status" required>
                                <option value="1">Disponible</option>
                                <option value="0">Agotado</option>
                            </select>
                        </div>

                        <div class="col mb-3">
                            <label class="control-label">Colores</label>
                            <div class="input-group mb-3">
                                <select class="form-control select2-colors" name="color" multiple>
                                    <option value="#FFFF00">Amarillo</option>
                                    <option value="#0000FF">Azul</option>
                                    <option value="#FF0000">Rojo</option>
                                    <option value="#00FF00">Verde</option>
                                    <option value="#FF9C00">Naranja</option>
                                    <option value="#800080">Morado</option>
                                    <option value="#FFFFFF">Blanco</option>
                                    <option value="#000000">Negro</option>
                                </select>
                            </div>
                        </div>

                    </div>


                    {{-- <div class="mb-2">
                        <label>Eliminar</label>
                        <button type="button"
                                class="btn-danger btn-sm form-control"
                                data-repeater-delete><i class="fa fa-trash"></i>
                        </button>
                    </div> --}}
                    
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">
                        <i class="fa fa-save mr-1"></i>
                        Actualizar Producto
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection