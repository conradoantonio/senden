@extends('layouts.admin')

@section('main-body')
<div class="text-center" style="padding: 20px;">
    <h2>Cargado de foto de productos</h2>
    <div class="alert alert-info alert-dismissible text-left" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
        <strong>Nota: </strong><br>
        - Solo se permiten subir imágenes con formato jpg, png y jpeg y estas deben de pesar menos de 5mb. <br>
        - Sólo se permite subir hasta un máximo de 40 imágenes a la vez, espere a que todas las imágenes aparezcan como cargadas antes de recargar o abandonar la página. <br>
        {{-- - Favor de subir las imágenes de 460x460 px o su equivalente a escala, ya que el sistema redimensionará automáticamente a esas medidas las imagenes subidas. --}}
    </div>
    <form id="myDropzone" action="{{url('admin/subir_imagenes')}}" style="border-style: dashed; border-color: deepskyblue;" enctype="multipart/form-data" class="dropzone" method="POST">
    </form>
</div>

<script src="{{ asset('js/plugins/dropzone-master/dist/dropzone.js') }}" type="text/javascript"></script>
@endsection