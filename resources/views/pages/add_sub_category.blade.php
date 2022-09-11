@extends('layouts.master')

@section('title')
    Add New SubCategory
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}"/>

    <link rel="stylesheet" href="{{asset('/assets//plugins/toastr/toastr.min.css')}}"/>
@endsection

@section('title_page1')
    SubCategories
@endsection

@section('title_page2')
    Add SubCategory
@endsection


@section('content')
    <!-- Main content -->
    <section class="content">


        <div >
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add New SubCategory </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="newSubCategory">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name_ar">Name Arabic</label>
                            <input type="text" class="form-control" id="name_ar" name="name_ar" placeholder="Name Arabic">
                            <small id="name_ar_error" class="form-text text-danger"></small>
                        </div>

                        <div class="form-group">
                            <label for="name_en">Name English</label>
                            <input type="text" class="form-control" id="name_en" name="name_en" placeholder="Name Arabic">
                            <small id="name_en_error" class="form-text text-danger"></small>
                        </div>

                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" name="category_id">
                                @forelse($categories as $category)
                                <option value="{{$category->id}}">{{$category->name_en}}</option>
                                @empty
                                @endforelse
                            </select>
                            <small id="category_id_error" class="form-text text-danger"></small>
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

            var formData = new FormData($('#newSubCategory')[0]);

            $('#name_ar_error').text('');
            $('#name_en_error').text('');
            $('#category_id_error').text('');

            $.ajax({
                type: 'post',
                url: "{{route('admin.addNewSubCategory')}}",
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
                            window.location.href="{{route('admin.subCategories')}}";
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

