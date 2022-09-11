@extends('layouts.master')

@section('title')
    Dashboard
@stop

@section('css')

    <link rel="stylesheet" href="{{asset('/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}"/>

    <link rel="stylesheet" href="{{asset('/assets//plugins/toastr/toastr.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('/css/image_picker.css')}}"/>

@endsection

@section('title_page1')
    Dashboard
@endsection

@section('title_page2')
    Dashboard
@endsection


@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$orderCounts??0}}</h3>

                            <p>Orders</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>

                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$productCounts??0}}</h3>

                            <p>Products</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>

                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$userCounts??0}}</h3>

                            <p>Users</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>

                    </div>
                </div>
                <!-- ./col -->

            </div>
            <!-- /.row -->

        </div><!-- /.container-fluid -->


        <br>
        <hr/>


        <div class="align-self-center">

            <h1  class="m-0">Mobile Contents</h1>
        </div>

        <br>

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Splash Screen </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="form_splash">

                <div class="card-body">
                    <div class="form-group col-sm-2">
                        <div class="img-picker" id="splash_image"></div>
                        <small id="image_error" class="form-text text-danger"></small>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button id="splash_btn" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
        <br>



        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">View Pager Images </h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                    <tr>
                        <th>  </th>
                        <th>ID</th>
                        <th>Active / Not Active</th>
                        <th>Actions</th>

                    </tr>
                    </thead>
                    <tbody id="table_pager">
                    @forelse($viewPagers as $viewPager)
                        <tr class="record_pager_{{$viewPager['id']}}" id="record_pager_{{$viewPager['id']}}">
                            <td><img src="{{asset($viewPager['image'])}}" class="rounded" width="150" height="150"></td>
                            <td>{{$viewPager['id']}}</td>

                            <td> <div  class="icheck-primary d-inline ml-2">
                                    <input type="checkbox" value="" name="todo{{$viewPager['id']}}" id="todoCheck{{$viewPager['id']}}">
                                    <label ></label>
                                </div></td>


                            <td><div class="row">
                                    <div class="col">
                                        <button type="button" class="btn btn-block bg-gradient-danger  delete_pager"   value="{{$viewPager['id']}}">Delete</button>
                                    </div>
                                </div></td>
                        </tr>
                    @empty

                    @endforelse

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <button type="button" class="btn btn-primary float-right" id="pager_add"><i class="fas fa-plus" ></i> Add item</button>
{{--                <button id="splash_btn" class="btn btn-primary float-left">Save Changes</button>--}}
            </div>


        </div>

<br>

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Home Contents </h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Content Name</th>
                        <th>Active / Not Active</th>
                        <th>Actions</th>

                    </tr>
                    </thead>
                    <tbody id="table_content">
                    @forelse($homeContents as $homeContent)
                        <tr class="record_content_{{$homeContent['id']}}" id="record_content_{{$homeContent['id']}}">
                            <td>{{$homeContent['id']}}</td>
                            <td>{{$homeContent['name_en']}}</td>
                            <td> <div  class="icheck-primary d-inline ml-2">
                                    <input type="checkbox" value="" name="todo{{$homeContent['id']}}" id="todoCheck{{$homeContent['id']}}">
                                    <label for="todoCheck"></label>
                                </div></td>


                            <td><div class="row">
                                    <div class="col">
                                        <button type="button" class="btn btn-block bg-gradient-danger  delete_content"   value="{{$homeContent['id']}}">Delete</button>
                                    </div>
                                </div></td>
                        </tr>
                    @empty

                    @endforelse

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <button type="button" class="btn btn-primary float-right" id="content_add"><i class="fas fa-plus" ></i> Add item</button>
{{--                <button id="splash_btn" class="btn btn-primary float-left">Save Changes</button>--}}
            </div>


        </div>



       <!-- ///////////////////////////////////////////////////////// Modals /////////////////////////// -->

        <div class="modal  " id="modal-pager" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal_pager_title">Add new Image Pager</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       <form id="form_pager">

                           <div class="form-group col-sm-2">
                               <div class="img-picker" id="image_pager"></div>
                           </div>
                           <small id="image_pager_error" class="form-text text-danger"></small>

                           <div class="form-group">
                               <label>Discount</label>
                               <select  name="discount" class="form-control" id="discount_pager">
                                   <option value="0">0%</option>
                                   <option value="10">10%</option>
                                   <option value="20">20%</option>
                                   <option value="40">40%</option>
                                   <option value="50">50&</option>
                                   <option value="60">60%</option>
                               </select>
                               <small id="discount_pager_error" class="form-text text-danger"></small>
                           </div>

                           <div class="form-group">
                               <label>Category</label>
                               <select   name="category" id="category_pager" class="form-control category">
                                   <option value="-1">All</option>
                                   @forelse($categories as $category)
                                       <option value="{{$category->id}}">{{$category->name_en}}</option>
                                   @empty
                                   @endforelse
                               </select>
                               <small id="category_pager_error" class="form-text text-danger"></small>
                           </div>


                           <div class="form-group">
                               <label>Sub Category</label>
                               <select name="sub_category" id="sub_category_pager" class="form-control">
                                   <option value="-1">All</option>
                               </select>
                               <small id="sub_category_pager_error" class="form-text text-danger"></small>
                           </div>


                           <div class="form-group">
                               <label>Brands</label>
                               <select name="brand" class="form-control" id="brand_pager">
                                   <option value="-1">All</option>
                                   @forelse($brands as $brand)
                                       <option value="{{$brand->id}}">{{$brand->name_en}}</option>
                                   @empty
                                   @endforelse
                               </select>
                               <small id="brand_pager_error" class="form-text text-danger"></small>
                           </div>




                           <div class="form-group">
                               <label>Product Type</label>
                               <select name="product_type" class="form-control" id="type_pager">
                                   <option value="-1">All</option>
                                   @forelse($productTypes as $productType)
                                       <option value="{{$productType->id}}">{{$productType->name_en}}</option>
                                   @empty
                                   @endforelse
                               </select>
                               <small id="product_type_pager_error" class="form-text text-danger"></small>
                           </div>


                           <div class="form-group">
                               <label>Used For</label>
                               <select name="used_for" class="form-control" id="for_pager">
                                   <option value="1">Male</option>
                                   <option value="2">Female</option>
                                   <option value="3">Both</option>
                               </select>
                               <small id="used_for_pager_error" class="form-text text-danger"></small>
                           </div>


                       </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button  class="btn btn-default" id="close_btn_pager" data-dismiss="modal">Close</button>
                        <button  class="btn btn-success" id="pager_btn">Add</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal  " id="modal-content" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal_pager_title">Add new Home Content</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form_content">

                            <div class="form-group">
                                <label for="name_ar">Name Arabic</label>
                                <input type="text" class="form-control" id="name_ar" name="name_ar" placeholder="Name Arabic">
                                <small id="name_ar_content_error" class="form-text text-danger"></small>
                            </div>

                            <div class="form-group">
                                <label for="name_en">Name English</label>
                                <input type="text" class="form-control" id="name_en" name="name_en" placeholder="Name Arabic">
                                <small id="name_en_content_error" class="form-text text-danger"></small>
                            </div>

                            <div class="form-group">
                                <label>Discount</label>
                                <select  name="discount" class="form-control" id="discount_content">
                                    <option value="0">0%</option>
                                    <option value="10">10%</option>
                                    <option value="20">20%</option>
                                    <option value="40">40%</option>
                                    <option value="50">50&</option>
                                    <option value="60">60%</option>
                                </select>
                                <small id="discount_content_error" class="form-text text-danger"></small>
                            </div>

                            <div class="form-group">
                                <label>Category</label>
                                <select   name="category" id="category_content" class="form-control category">
                                    <option value="-1">All</option>
                                    @forelse($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name_en}}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <small id="category_content_error" class="form-text text-danger"></small>
                            </div>


                            <div class="form-group">
                                <label>Sub Category</label>
                                <select name="sub_category" id="sub_category_content" class="form-control">
                                    <option value="-1">All</option>
                                </select>
                                <small id="sub_category_content_error" class="form-text text-danger"></small>
                            </div>


                            <div class="form-group">
                                <label>Brands</label>
                                <select name="brand" class="form-control" id="brand_content">
                                    <option value="-1">All</option>
                                    @forelse($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name_en}}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <small id="brand_content_error" class="form-text text-danger"></small>
                            </div>




                            <div class="form-group">
                                <label>Product Type</label>
                                <select name="product_type" class="form-control" id="type_content">
                                    <option value="-1">All</option>
                                    @forelse($productTypes as $productType)
                                        <option value="{{$productType->id}}">{{$productType->name_en}}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <small id="product_type_content_error" class="form-text text-danger"></small>
                            </div>


                            <div class="form-group">
                                <label>Used For</label>
                                <select name="used_for" class="form-control" id="for_content">
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                    <option value="3">Both</option>
                                </select>
                                <small id="used_for_content_error" class="form-text text-danger"></small>
                            </div>


                        </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button  class="btn btn-default" id="close_btn_content" data-dismiss="modal">Close</button>
                        <button  class="btn btn-success" id="content_btn">Add</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->







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

            $('#splash_image').imagePicker({name: 'image',src:'{{$splashScreen}}'});
            $('#image_pager').imagePicker({name: 'image'});
        })



        function deleteRecord(id,isPager){
            $.ajax({
                type: 'post',
                url: isPager?"{{route('admin.deletePager')}}":"{{route('admin.deleteContent')}}",
                data: 'id=' + id,
                success: function (data) {
                    if (isPager){
                        $('.record_pager_'+id).remove();
                    }else {
                        $('.record_content_'+id).remove();
                    }


                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    Toast.fire({
                        icon: 'success',
                        title: data.msg
                    })



                }
            });
        }


        ////////////////////////////////////////////// Pager Modal ////////////////////////////////////////

        var modal=document.getElementById("modal-pager");

        $('#pager_add').click(function (e) {
            e.preventDefault();
            $('#pager_btn').text("Add");
            modal.style.display = "block";
        });

        $('.close').click(function () {
            modal.style.display = "none";
            modal_content.style.display = "none";

        })

        $('#close_btn_pager').click(function () {
            modal.style.display = "none";
        })

        document.getElementById('category_pager').addEventListener('change', function() {
            console.log('You selected: ', this.value);
            var categoryID = this.value;
            if(categoryID) {
                $.ajax({
                    type: 'post',
                    url: "{{route('subCategoriesById')}}",
                    data: 'id=' + categoryID,
                    success: function (html) {
                        $('#sub_category_pager').find('option').remove();
                        $('#sub_category_pager').append('<option value="-1">All</option>');
                        $('#sub_category_pager').append(html);
                    }
                });
            }
        });


        $(document).on('click', '#pager_btn', function (e) {
            e.preventDefault();

            var formData = new FormData($('#form_pager')[0]);

            $('#image_pager_error').text('');
            $('#category_pager_error').text('');
            $('#sub_category_pager_error').text('');
            $('#brand_pager_error').text('');
            $('#product_type_pager_error').text('');
            $('#used_for_pager_error').text('');


            $.ajax({
                type: 'post',
                url: "{{route('admin.addNewPager')}}",
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

                        var newrow = '';
                        newrow+='<tr class="record_pager_'+data.record.id+'" id="record_pager_'+data.record.id+'">';
                        newrow+=' <td><img src="'+data.record.image+'" class="rounded" width="150" height="150"></td>'
                        newrow+='<td>'+data.record.id+'</td>';
                        newrow+='<td> <div  class="icheck-primary d-inline ml-2"> <input type="checkbox" value="" name="todo'+data.record.id+'" id="todoCheck'+data.record.id+'"> ';
                        newrow+='<label for="todoCheck"></label> </div></td>';
                        newrow+='<td><div class="row"> <div class="col">';
                        newrow+='<button type="button" class="btn btn-block bg-gradient-danger  delete_pager"   value="'+data.record.id+'">Delete</button>'
                        newrow+='</div>  </div></td> </tr>';
                        $('#table_pager').append(newrow);


                        modal.style.display = "none";

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
                        $("#" + key + "_pager_error").text(val[0]);
                    });
                    console.log(reject);
                }
            });
        });



        {{--$('.delete_pager').click(function (e){--}}
        {{--    e.preventDefault();--}}
        {{--    var id=$(this).attr("value");--}}
        {{--    $.ajax({--}}
        {{--        type: 'post',--}}
        {{--        url: "{{route('admin.deletePager')}}",--}}
        {{--        data: 'id=' + id,--}}
        {{--        success: function (data) {--}}
        {{--            $('#record_pager_'+id).remove();--}}

        {{--            var Toast = Swal.mixin({--}}
        {{--                toast: true,--}}
        {{--                position: 'top-end',--}}
        {{--                showConfirmButton: false,--}}
        {{--                timer: 3000--}}
        {{--            });--}}

        {{--            Toast.fire({--}}
        {{--                icon: 'success',--}}
        {{--                title: data.msg--}}
        {{--            })--}}



        {{--        }--}}
        {{--    });--}}
        {{--})--}}


        //////////////////////////////////////////////////////////////////////////////////////////////////////

        ////////////////////////////////////////////// Content Modal ////////////////////////////////////////

        var modal_content=document.getElementById("modal-content");

        $('#content_add').click(function (e) {
            e.preventDefault();
            $('#content_btn').text("Add");
            modal_content.style.display = "block";
        });


        $('#close_btn_content').click(function () {
            modal_content.style.display = "none";
        })

        document.getElementById('category_content').addEventListener('change', function() {
            console.log('You selected: ', this.value);
            var categoryID = this.value;
            if(categoryID) {
                $.ajax({
                    type: 'post',
                    url: "{{route('subCategoriesById')}}",
                    data: 'id=' + categoryID,
                    success: function (html) {
                        $('#sub_category_content').find('option').remove();
                        $('#sub_category_content').append('<option value="-1">All</option>');
                        $('#sub_category_content').append(html);
                    }
                });
            }
        });


        $(document).on('click', '#content_btn', function (e) {
            e.preventDefault();

            var formData = new FormData($('#form_content')[0]);

            $('#name_ar_content_error').text('');
            $('#name_en_content_error').text('');
            $('#category_content_error').text('');
            $('#sub_category_content_error').text('');
            $('#brand_content_error').text('');
            $('#product_type_content_error').text('');
            $('#used_for_content_error').text('');


            $.ajax({
                type: 'post',
                url: "{{route('admin.addNewContent')}}",
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


                        var newrow = '';
                        newrow+='<tr class="record_content_'+data.record.id+'" id="record_content_'+data.record.id+'">';
                        newrow+='<td>'+data.record.id+'</td>';
                        newrow+='<td>'+data.record.name_en+'</td>';
                        newrow+='<td> <div  class="icheck-primary d-inline ml-2"> <input type="checkbox" value="" name="todo'+data.record.id+'" id="todoCheck'+data.record.id+'"> ';
                        newrow+='<label for="todoCheck"></label> </div></td>';
                        newrow+='<td><div class="row"> <div class="col">';
                        newrow+='<button type="button" class="btn btn-block bg-gradient-danger  delete_content"   value="'+data.record.id+'">Delete</button>'
                        newrow+='</div>  </div></td> </tr>';
                        $('#table_content').append(newrow);
                        modal_content.style.display = "none";

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
                        $("#" + key + "_content_error").text(val[0]);
                    });
                    console.log(reject);
                }
            });
        });



        {{--$('.delete_content').click(function (e){--}}
        {{--    e.preventDefault();--}}
        {{--    var id=$(this).attr("value");--}}
        {{--    $.ajax({--}}
        {{--        type: 'post',--}}
        {{--        url: "{{route('admin.deleteContent')}}",--}}
        {{--        data: 'id=' + id,--}}
        {{--        success: function (data) {--}}
        {{--            $('#record_content_'+id).remove();--}}

        {{--            var Toast = Swal.mixin({--}}
        {{--                toast: true,--}}
        {{--                position: 'top-end',--}}
        {{--                showConfirmButton: false,--}}
        {{--                timer: 3000--}}
        {{--            });--}}

        {{--            Toast.fire({--}}
        {{--                icon: 'success',--}}
        {{--                title: data.msg--}}
        {{--            })--}}

        {{--        }--}}
        {{--    });--}}
        {{--})--}}

//////////////////////////////////////////////////////////////////////////////////////////////////////////



        document.addEventListener( "click", someListener );

        function someListener(event){

            var element = event.target;
            console.log(element.tagName)

               if(element.tagName == 'BUTTON'&&element.classList.contains('delete_content')){
                event.preventDefault();
                var value=element.value;
                   deleteRecord(value,false);
            }else if(element.tagName == 'BUTTON'&&element.classList.contains('delete_pager')){
                   event.preventDefault();
                   var value=element.value;
                   deleteRecord(value,true);
               }
        }





        $(document).on('click', '#splash_btn', function (e) {
            e.preventDefault();

            var formData = new FormData($('#form_splash')[0]);

            $('#image_error').text('');

            $.ajax({
                type: 'post',
                url: "{{route('admin.addNewSplash')}}",
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

