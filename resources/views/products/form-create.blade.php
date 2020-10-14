@push('head')
    <link href="{{ asset('css/libs/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/libs/jquery-confirm.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/libs/products.css') }}" rel="stylesheet">
@endpush

@push('endBody')
    <script src="{{ asset('js/libs/jquery-confirm.min.js')}}"></script>
    <script src="{{ asset('js/libs/jquery.repeater.js')}}"></script>
    <script src="{{ asset('js/libs/select2.min.js')}}"></script>
    @includeJS(["url" => "products/assets/_form.js"])
@endpush

<form action="{{ route('products-form')  }}" method="POST" class="repeater"  onsubmit="handleSubmit()" enctype="multipart/form-data" id="customForm">
    @csrf

    <div class="loading d-none">
        Cargando....
    </div>

    <div class="saving d-none"></div>

    <div class="row">
        <div class="col-12">
            <div class="input-group w-25 float-right">
                <input type="text" class="form-control" placeholder="Cantidad" id="numVeces" aria-label="Cantidad"
                       aria-describedby="button-addon2" style="width: 10%;">
                <div class="input-group-append">
                    <button type="button" id="btn-add-products"
                            class="btn btn-bili-orange btn-sm"
                            data-repeater-create input-quantity="numVeces"><i class="fa fa-plus"></i>
                        Agregar Producto
                    </button>
                </div>
            </div>
            <div class="col 12">
                <div class="input-group w-25 float-right pr-5">
                    <div class="custom-file">
                        <input type="file" data-repeater-create-images name="imageMultiple" class="custom-file-input"
                            id="file-multiple" aria-describedby="inputGroupFileAddon03" multiple> 
                        <label class="custom-file-label" style="white-space: nowrap;overflow: hidden;">Seleccionar</label>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-bili-orange mr-1 waves-effect waves-light">
                    <i class="fa fa-save mr-1"></i>
                    Crear Productos
                </button>
            </div>
        </div>
    </div>


    <hr>
    <div data-repeater-list="producto">

        <div class="row mt-4">

            <div class="form-group col-sm-4">
                <label class="control-label">Catálogo<span class="text-danger">*</span></label>
                <select class="form-control" id="select2-catalogo" name="catalogo_id" required>
                    <option></option>
                    @foreach($catalogos as $key => $catalogo)
                        <option value="{{$catalogo['id']}}"> {{$catalogo['name']}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-sm-4">
                <label class="control-label">Categoría</span></label>
                @php($selected = isset($Products) ?  $Products->category : ' ')
                <select class="form-control select2" name="category" id="select2-category">
                    <option></option>
                    @foreach($categories as $item)
                        <option value="{{$item}}" {{$selected==$item? 'selected':''}}> {{$item}}</option>
                    @endforeach
                </select>
            </div>
            
        </div>

        <div data-repeater-item class="form-row border-bottom pt-3">
            
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
                        value="{{ !empty($Products)? $Products->name : ''}}">
                </div>

            </div>

            <div class="col-md-4">

                <div class="col mb-3">
                    <label for="description">Descripción</span></label>
                    <textarea class="form-control" maxlength="90" name="description" id="description" rows="1" 
                            placeholder="Máximo de 90 caracteres"
                            >{{ !empty($Products)? $Products->description : ''}}</textarea>
                </div>

                <div class="col mb-3">
                    <label for="value">Precio</span></label>
                    <input id="price" name="value" type="text" class="form-control"
                        value="{{ !empty($Products)? $Products->value : ''}}">
                </div>

            </div>

            <div class="col-md-2">
 
                <div class="col mb-3">
                    <label class="control-label">Estado</label>
                    @php($selected = isset($Product) ?  $Product->status : '')
                    <select class="select2 form-control" name="status" required>
                        <option value="1" {{$selected=='1'? 'selected':''}}>Disponible</option>
                        <option value="0" {{$selected=='0'? 'selected':''}}>Agotado</option>
                    </select>
                </div>

                <div class="col mb-3">
                    <label class="control-label">Colores</label>
                    @php($selected = isset($Products) ?  $Products->color : '')
                    <div class="input-group mb-3">
                        <select class="form-control select2-colors" name="color" multiple>
                            <option value="#FFFF00" {{$selected=='#FFFF00'? 'selected':''}}>Amarillo</option>
                            <option value="#0000FF" {{$selected=='#0000FF'? 'selected':''}}>Azul</option>
                            <option value="#FF0000" {{$selected=='#FF0000'? 'selected':''}}>Rojo</option>
                            <option value="#00FF00" {{$selected=='FF0000'? 'selected':''}}>Verde</option>
                            <option value="#FF9C00" {{$selected=='#FF9C00'? 'selected':''}}>Naranja</option>
                            <option value="#800080" {{$selected=='800080'? 'selected':''}}>Morado</option>
                            <option value="#FFFFFF" {{$selected=='FFFFFF'? 'selected':''}}>Blanco</option>
                            <option value="#000000" {{$selected=='000000'? 'selected':''}}>Negro</option>
                        </select>
                    </div>
                </div>

            </div>


            <div class="mb-2">
                <label>Eliminar</label>
                <button type="button"
                        class="btn-danger btn-sm form-control"
                        data-repeater-delete><i class="fa fa-trash"></i>
                </button>
            </div>
            
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-4">
            <button type="submit" class="btn btn-bili-orange mr-1 waves-effect waves-light">
                <i class="fa fa-save mr-1"></i>
                Crear Productos
            </button>
        </div>
    </div>
</form>