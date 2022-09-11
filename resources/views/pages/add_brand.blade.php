@extends('layouts.master')

@section('title')
    Add New Brand
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}"/>

    <link rel="stylesheet" href="{{asset('/assets//plugins/toastr/toastr.min.css')}}"/>
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
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name_ar">Name Arabic</label>
                            <input type="text" class="form-control" id="name_ar" name="name_ar" placeholder="Name Arabic">
                            <small id="name_ar_error" class="form-text text-danger"></small>
                        </div>

                        <div class="form-group">
                            <label for="name_en">Name English</label>
                            <input type="text" class="form-control" id="name_en" name="name_en" placeholder="Name English">
                            <small id="name_en_error" class="form-text text-danger"></small>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Image File</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="image" accept="image/*">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                            <small id="image_error" class="form-text text-danger"></small>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button id="add_btn" class="btn btn-primary">Submit</button>
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

        $(document).on('click', '#add_btn', function (e) {
            e.preventDefault();

            var formData = new FormData($('#newBrand')[0]);

            $('#name_ar_error').text('');
            $('#name_en_error').text('');
            $('#image_error').text('');

            $.ajax({
                type: 'post',
                url: "{{route('admin.addNewBrand')}}",
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

