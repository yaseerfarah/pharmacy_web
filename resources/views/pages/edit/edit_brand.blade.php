@extends('layouts.master')

@section('title')
    Add New Brand
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}"/>

    <link rel="stylesheet" href="{{asset('/assets//plugins/toastr/toastr.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('/css/image_picker.css')}}"/>
@endsection

@section('title_page1')
    Brands
@endsection

@section('title_page2')
    Add Brand
@endsection


@section('content')
    <!-- Main content -->
    <section class="content">


        <div >
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add New Brand </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="newBrand">
                    <input type="text" name="id" class="invisible" value="{{$brand->id}}">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name_ar">Name Arabic</label>
                            <input type="text" class="form-control" id="name_ar" name="name_ar" placeholder="Name Arabic" value="{{$brand->name_ar}}">
                            <small id="name_ar_error" class="form-text text-danger"></small>
                        </div>

                        <div class="form-group">
                            <label for="name_en">Name English</label>
                            <input type="text" class="form-control" id="name_en" name="name_en" placeholder="Name English" value="{{$brand->name_en}}">
                            <small id="name_en_error" class="form-text text-danger"></small>
                        </div>

                        <div class="form-group col-sm-2">
                            <div class="img-picker"></div>
                            <small id="image_error" class="form-text text-danger"></small>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button id="add_btn" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>

        </div>

    </section>
    <!-- /.content -->
@endsection


@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{URL::asset('/assets/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{URL::asset('/assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <script>



        (function ( $ ) {

            $.fn.imagePicker = function( options ) {

                // Define plugin options
                var settings = $.extend({
                    // Input name attribute
                    name: "",
                    // Classes for styling the input
                    class: "form-control btn btn-default btn-block",
                    // Icon which displays in center of input
                    icon: "glyphicon glyphicon-plus",

                    src:""
                }, options );

                // Create an input inside each matched element
                return this.each(function() {
                    if (settings.src.length>0){
                        $(this).html(create_preview(this,settings.src ,settings,null));
                    }else {
                        $(this).html(create_btn(this, settings));
                    }

                });

            };

            // Private function for creating the input element
            function create_btn(that, settings) {
                // The input icon element
                var picker_btn_icon = $('<i class="'+settings.icon+'"></i>');

                // The actual file input which stays hidden
                var picker_btn_input = $('<input type="file" name="'+settings.name+'" />');

                // The actual element displayed
                var picker_btn = $('<div class="'+settings.class+' img-upload-btn"></div>')
                    .append(picker_btn_icon)
                    .append(picker_btn_input);

                // File load listener
                picker_btn_input.change(function() {
                    if ($(this).prop('files')[0]) {
                        // Use FileReader to get file
                        var reader = new FileReader();

                        // Create a preview once image has loaded
                        reader.onload = function(e) {
                            var preview = create_preview(that, e.target.result, settings,picker_btn_input);
                            $(that).html(preview);
                        }

                        // Load image
                        reader.readAsDataURL(picker_btn_input.prop('files')[0]);
                    }
                });

                return picker_btn
            };

            // Private function for creating a preview element
             function create_preview(that, src, settings,input) {

                // The preview image
                var picker_preview_image = $('<img src="'+src+'" class="img-responsive img-rounded" width="120" height="120" />');

                // The remove image button
                var picker_preview_remove = $('<button class="btn btn-link"><small>Remove</small></button>');

                // The preview element
                var picker_preview = $('<div class="text-center"></div>')
                    .append(input)
                    .append(picker_preview_image)
                    .append(picker_preview_remove);

                // Remove image listener
                picker_preview_remove.click(function() {
                    var btn = create_btn(that, settings);
                    $(that).html(btn);
                });

                return picker_preview;
            };

        }( jQuery ));

        $(document).ready(function() {

            $('.img-picker').imagePicker({name: 'image',src:"{{$brand->image}}"});
        })

        $(document).on('click', '#add_btn', function (e) {
            e.preventDefault();

            var formData = new FormData($('#newBrand')[0]);

            $('#name_ar_error').text('');
            $('#name_en_error').text('');
            $('#image_error').text('');

            $.ajax({
                type: 'post',
                url: "{{route('admin.updateBrand')}}",
                enctype: 'multipart/form-data',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {

                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    if (data.status == true) {
                        Toast.fire({
                            icon: 'success',
                            title: data.msg
                        })
                        setTimeout(function (){
                            window.location.href="{{route('admin.brands')}}";
                        },2000)
                    }else {
                        Toast.fire({
                            icon: 'error',
                            title: data.msg
                        })
                    }






                }, error: function (reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response, function (key, val) {
                        console.log(key);
                        $("#" + key + "_error").text(val[0]);
                    });
                    console.log(reject);
                }
            });
        });

    </script>

@endsection

