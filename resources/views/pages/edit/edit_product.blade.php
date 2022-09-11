@extends('layouts.master')

@section('title')
    Edit Product
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}"/>

    <link rel="stylesheet" href="{{asset('/assets//plugins/toastr/toastr.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('/css/image_picker.css')}}"/>
@endsection

@section('title_page1')
    Products
@endsection

@section('title_page2')
    Edit Product
@endsection


@section('content')
    <!-- Main content -->
    <section class="content">


        <div >
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Product </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="newProduct">
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" name="id" class="invisible" value="{{$product->id}}"  >
                            <br>
                            <label for="name_ar">Name Arabic</label>
                            <input type="text" class="form-control" id="name_ar" name="name_ar" value="{{$product->productAr->name}}">
                            <small id="name_ar_error" class="form-text text-danger"></small>
                        </div>

                        <div class="form-group">
                            <label for="name_en">Name English</label>
                            <input type="text" class="form-control" id="name_en" name="name_en" value="{{$product->productEn->name}}">
                            <small id="name_en_error" class="form-text text-danger"></small>
                        </div>

                        <div class="form-group">
                            <label >Details Arabic</label>
                            <textarea class="form-control" rows="3"  name="detail_ar"  value="{{$product->productAr->detail}}">{{$product->productAr->detail}}</textarea>
                            <small id="detail_ar_error" class="form-text text-danger"></small>
                        </div>

                        <div class="form-group">
                            <label >Details English</label>
                            <textarea class="form-control" rows="3" name="detail_en" value="{{$product->productEn->detail}}">{{$product->productEn->detail}}</textarea>
                            <small id="detail_en_error" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label >Price</label>
                            <input type="number" class="form-control"  name="price" value="{{$product->price}}">
                            <small id="price_error" class="form-text text-danger"></small>
                        </div>

                        <div class="form-group">
                            <label >Quantity</label>
                            <input type="number" class="form-control"  name="quantity" value="{{$product->quantity}}">
                            <small id="quantity_error" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label>Discount</label>
                            <select  name="discount" class="form-control">
                                <option @if($product->dicount===0) selected @endif value="0">0%</option>
                                <option @if($product->dicount===10) selected @endif value="10">10%</option>
                                <option @if($product->dicount===20) selected @endif value="20">20%</option>
                                <option @if($product->dicount===40) selected @endif value="40">40%</option>
                                <option @if($product->dicount===50) selected @endif value="50">50&</option>
                                <option @if($product->dicount===60) selected @endif value="60">60%</option>
                            </select>
                            <small id="discount_error" class="form-text text-danger"></small>
                        </div>

                        <div class="form-group">
                            <label>Category</label>
                            <select   name="category" id="category" class="form-control category">
                                <option value="">Select Category</option>
                                @forelse($categories as $category)
                                    <option @if($product->category->id==$category->id) selected @endif value="{{$category->id}}">{{$category->name_en}}</option>
                                @empty
                                @endforelse
                            </select>
                            <small id="category_error" class="form-text text-danger"></small>
                        </div>


                        <div class="form-group">
                            <label>Sub Category</label>
                            <select name="sub_category" id="sub_category" class="form-control">
                            </select>
                            <small id="sub_category_error" class="form-text text-danger"></small>
                        </div>


                        <div class="form-group">
                            <label>Brands</label>
                            <select name="brand" class="form-control">
                                @forelse($brands as $brand)
                                    <option @if($product->brand->id==$brand->id) selected @endif value="{{$brand->id}}">{{$brand->name_en}}</option>
                                @empty
                                @endforelse
                            </select>
                            <small id="brand_error" class="form-text text-danger"></small>
                        </div>




                        <div class="form-group">
                            <label>Product Type</label>
                            <select name="product_type" class="form-control">
                                @forelse($productTypes as $productType)
                                    <option  @if($product->productType->id==$productType->id) selected @endif  value="{{$productType->id}}">{{$productType->name_en}}</option>
                                @empty
                                @endforelse
                            </select>
                            <small id="product_type_error" class="form-text text-danger"></small>
                        </div>


                        <div class="form-group">
                            <label>Used For</label>
                            <select name="used_for" class="form-control">
                                <option @if($product->used_for===1) selected @endif value="1">Male</option>
                                <option @if($product->used_for===2) selected @endif value="2">Female</option>
                                <option @if($product->used_for===3) selected @endif value="3">Both</option>
                            </select>
                            <small id="used_for_error" class="form-text text-danger"></small>
                        </div>

                        <div class="row" id="images">
                            @forelse($product->images as $img)
                            <div class="form-group col-sm-2">
                            <div class="img-picker saved img_{{$img->id}} {{$img->id}}" src="{{$img->image}}"  id="img_{{$img->id}}" ></div>
                            </div>
                            @empty
                            @endforelse
                        </div>
                        <small id="image_error" class="form-text text-danger"></small>

                    </div>

                    <button id="new_image" class="btn btn-primary">Add new Image</button>
                    <!-- /.card-body -->


                    <br>
                    <br>

                    <div class="card-footer">
                        <button id="add_btn" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>

        </div>

        <br>
        <hr>
        <h4 class="align-self-center">Product Feature</h4>
        <br>

        <div id="newform">
            @forelse($product->features as $feature)
                <div class="card card-primary saved card_{{$feature->id}} " id="card_{{$feature->id}}">
                    <div class="card-header">
                        <h3 class="card-title"> Feature </h3>
                        <div class="card-tools">
                            <button   id="close" value="{{$feature->id}}" class="btn btn-tool" >
                                <i class="fas fa-times {{$feature->id}}"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="form_{{$feature->id}}" id="form_{{$feature->id}}">
                            <div class="form-group">
                                <label >Name Arabic</label>
                                <input type="text" name="id" class="invisible" value="{{$feature->id}}"  >
                                <input type="text" class="form-control" value="{{$feature->title_ar}}" name="f_name_ar" >
                                <small id="f_name_ar{{$feature->id}}_error" class="form-text text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label >Name English</label>
                                <input type="text" class="form-control" value="{{$feature->title_en}}" name="f_name_en" >
                                <small id="f_name_en{{$feature->id}}_error" class="form-text text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label >Details Arabic</label>
                                <textarea class="form-control" rows="3"  value="{{$feature->detail_ar}}" name="f_detail_ar" placeholder="Enter ...">{{$feature->detail_ar}}
                                            </textarea>
                                <small id="f_detail_ar{{$feature->id}}_error" class="form-text text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label >Details English</label>
                                <textarea class="form-control" rows="3"  value="{{$feature->detail_en}}" name="f_detail_en" placeholder="Enter ...">{{$feature->detail_en}}
                                            </textarea>
                                <small id="f_detail_en{{$feature->id}}_error" class="form-text text-danger"></small>
                            </div>

                            <div class="">
                                <button value="{{$feature->id}}"  class="btn btn-primary feature_btn saved">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

                <br>

            @empty
            @endforelse
        </div>


        <div>
            <button id="new_form" class="btn btn-primary">Add new feature</button>
        </div>

        <hr>









        <div class="modal " id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Confirmation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="modal_txt"></p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button  class="btn btn-default" id="close_btn" data-dismiss="modal">Close</button>
                        <button  class="btn btn-danger" id="delete_btn">Delete</button>
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

                    src:"",

                    value:""
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
                var picker_preview_remove = $('<button class="btn btn-link image delete"><small>Remove</small></button>');

                // The preview element
                var picker_preview = $('<div class="text-center"></div>')
                    .append(input)
                    .append(picker_preview_image)
                    .append(picker_preview_remove);

                // Remove image listener
                picker_preview_remove.click(function(e) {
                    e.preventDefault();

                    if ($('.img_'+settings.value)[0].classList.contains('saved')){
                        id=settings.value;
                        isImage=true;
                        $('#modal_txt').text("Do you want to delete item "+id+" ?");
                        modal.style.display = "block";
                        console.log("hello"+id)
                    }else {
                        var btn = create_btn(that, settings);
                        $(that).html(btn);
                    }

                });

                return picker_preview;
            };

        }( jQuery ));

        $(document).ready(function() {

            @forelse($product->images as $img)
            $('.img_{{$img->id}}').imagePicker({name: 'image[]',src:$('.img_{{$img->id}}').attr("src"),value:"{{$img->id}}"});
            @empty
            @endforelse




        });


        var modal=document.getElementById("modal-default");
        var modal_txt = document.getElementById("modal_txt");
        var deleteBtn = document.getElementById("delete_btn");
        var closeBtn = document.getElementById("close_btn");

        var id=-1;
        var isImage=false;




        // $('.delete').click(function (e){
        //     e.preventDefault();
        //     id=$(this).attr("value");
        //     $('#modal_txt').text("Do you want to delete item "+id+" ?");
        //     modal.style.display = "block";
        //     console.log('hello '+id);
        // })

        closeBtn.onclick = function() {
            modal.style.display = "none";
            id=-1;
        }


        deleteBtn.onclick = function() {
            modal.style.display = "none";
            if(id>-1) {
                if (isImage){
                    $.ajax({
                        type: 'post',
                        url: "{{route('admin.deleteProductImage')}}",
                        data: 'id=' + id,
                        success: function (data) {
                            var Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });

                            if (data.status) {
                                Toast.fire({
                                    icon: 'success',
                                    title: data.msg
                                })
                                $('.img_' + id).remove();
                            }else {
                                Toast.fire({
                                    icon: 'error',
                                    title: data.msg
                                })
                            }
                            id=-1;
                        }
                    });
                }else {
                    $.ajax({
                        type: 'post',
                        url: "{{route('admin.deleteFeature')}}",
                        data: 'id=' + id,
                        success: function (data) {
                            var Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });

                            if (data.status) {
                                Toast.fire({
                                    icon: 'success',
                                    title: data.msg
                                })
                                $('.card_' + id).remove();
                            }else {
                                Toast.fire({
                                    icon: 'error',
                                    title: data.msg
                                })
                            }
                            id=-1;
                        }
                    });
                }

            }
        }




        var count={{$product->features[count($product->features)-1]->id??-1}};
        var imageCount={{$product->images[count($product->images)-1]->id+1}};
        var listErrorId=[];

            $('#new_form').click(function(e){
                e.preventDefault();
                count++;
                $('#newform').slideDown();
                var newrow = '';


                newrow += '<div class="card card-primary card_'+count+'" id="card_'+count+'">';
                newrow += ' <div class="card-header"> <h3 class="card-title">New Feature </h3> <div class="card-tools"> <button   id="close" value="'+(count)+'" class="btn btn-tool" > <i class="fas fa-times close '+(count)+'"></i>  </button>   </div> </div> ';
                newrow += '<div class="card-body">';

                newrow+='<form class="form_'+count+'" id="form_'+count+'">';
                newrow+='<div id="input_id'+count+'">';
                newrow+='</div>';

                newrow+='<input type="text" name="product_id" class="invisible" value="{{$product->id}}"  >';
                newrow += ' <div class="form-group"> <label >Name Arabic</label> <input type="text" class="form-control" id="f_name_ar" name="f_name_ar" placeholder="Name Arabic"> <small id="f_name_ar'+(count)+'_error" class="form-text text-danger"></small> </div>';
                listErrorId.push('f_name_ar'+(count)+'_error');
                newrow += ' <div class="form-group"> <label >Name English</label> <input type="text" class="form-control" id="f_name_en" name="f_name_en" placeholder="Name English"> <small id="f_name_en'+(count)+'_error" class="form-text text-danger"></small> </div>';
                listErrorId.push('f_name_en'+(count)+'_error');

                newrow += '<div class="form-group">  <label >Details Arabic</label> <textarea class="form-control" rows="3"  name="f_detail_ar" placeholder="Enter ..."></textarea> <small id="f_detail_ar'+(count)+'_error" class="form-text text-danger"></small> </div>';
                listErrorId.push('f_detail_ar'+(count)+'_error');
                newrow += '<div class="form-group">  <label >Details English</label> <textarea class="form-control" rows="3"  name="f_detail_en" placeholder="Enter ..."></textarea> <small id="f_detail_en'+(count)+'_error" class="form-text text-danger"></small> </div>';
                listErrorId.push('f_detail_en'+(count)+'_error');
                newrow+= ' <div class=""> <button value="'+count+'" type="button"  class="btn btn-primary feature_btn ">Save</button> </div>';
                newrow += '</form>';
                newrow += '</div>';
                newrow += '</div>';

                $('#newform').append(newrow);


            });


        $('#new_image').click(function(e){
            e.preventDefault();
            imageCount++;
            $('#images').slideDown();
            var newrow = '<div class="form-group col-sm-2">';


            newrow += '<div class="img-picker img_'+imageCount+'" id="img_'+imageCount+'" ></div>';

            newrow += '</div>';

            $('#images').append(newrow);
            $('.img_'+imageCount).imagePicker({name: 'image[]',value:imageCount});
            console.log(imageCount)


        });


        $('.feature_btn').click(function (e){
            e.preventDefault();


        });

        function updateFeature(value){
            $('#f_name_ar'+value+'_error').text('');
            $('#f_detail_en'+value+'_error').text('');
            $('#f_name_en'+value+'_error').text('');
            $('#f_detail_ar'+value+'_error').text('');
            var formData = new FormData($('.form_'+value)[0]);

                $.ajax({
                    type: 'post',
                    url: "{{route('admin.updateFeature')}}",
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
                            var k=key.replace(".", "")
                            console.log(k);

                            $("#" + k +value+ "_error").text(val[0]);
                        });
                        console.log(reject);
                    }
                });




        }


        function addNewFeature(value){

            $('#f_name_ar'+value+'_error').text('');
            $('#f_detail_en'+value+'_error').text('');
            $('#f_name_en'+value+'_error').text('');
            $('#f_detail_ar'+value+'_error').text('');
            var formData = new FormData($('.form_'+value)[0]);


                $.ajax({
                    type: 'post',
                    url: "{{route('admin.addNewFeature')}}",
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
                            $('#input_id'+value).slideDown();
                            $('#input_id'+value).append('<input type="text" name="id" class="invisible" value="'+data.id+'">');
                            $('.feature_btn').text('Update');
                            $('.card_'+value)[0].classList.add('saved');
                        }else {
                            Toast.fire({
                                icon: 'error',
                                title: data.msg
                            })
                        }






                    }, error: function (reject) {
                        var response = $.parseJSON(reject.responseText);
                        $.each(response, function (key, val) {
                            var k=key.replace(".", "")
                            console.log(k);

                            $("#" + k +value+ "_error").text(val[0]);
                        });
                        console.log(reject);
                    }
                });




        }




        // document.getElementById('close').addEventListener('click', function(e) {
        //     e.preventDefault();
        //     // var id=$(this).attr("value");
        //     console.log(hello);
        //     // $("#card_"+id).remove();
        //
        // });


        document.addEventListener( "click", someListener );

        function someListener(event){

            var element = event.target;
            console.log(element.tagName)
            if(element.tagName == 'I'){
                event.preventDefault();
                console.log(element.classList[element.classList.length-1]);
                var value=element.classList[element.classList.length-1];

                if ($('.card_'+value)[0].classList.contains('saved')){
                    id=value;
                    isImage=false;
                    $('#modal_txt').text("Do you want to delete item "+id+" ?");
                    modal.style.display = "block";
                }else {
                    $(".card_"+value).remove();
                }


            }else if(element.tagName == 'BUTTON'&&element.classList.contains('feature_btn')){
                event.preventDefault();
                var value=element.value;

                if ($('.card_'+value)[0].classList.contains('saved')){
                    updateFeature(value);
                }else {
                    addNewFeature(value);
                }
            }
        }


        document.getElementById('category').addEventListener('change', function() {
                console.log('You selected: ', this.value);
                    var categoryID = this.value;
                    if(categoryID) {
                        $.ajax({
                            type: 'post',
                            url: "{{route('subCategoriesById')}}",
                            data: 'id=' + categoryID,
                            success: function (html) {
                                $('#sub_category').html(html);
                            }
                        });
                    }
            });




        $(document).ready(function (e) {
            var categoryID = document.getElementById('category').value;
            if(categoryID) {
                $.ajax({
                    type: 'post',
                    url: "{{route('subCategoriesById')}}",
                    data: {'id':  categoryID,'selectedId': "{{$product->subCategory->id}}"},
                    success: function (html) {
                        $('#sub_category').html(html);
                    }
                });
            }
        });



        $(document).on('click', '#add_btn', function (e) {
            e.preventDefault();

            var formData = new FormData($('#newProduct')[0]);

            $('#name_ar_error').text('');
            $('#name_en_error').text('');
            $('#detail_ar_error').text('');
            $('#detail_en_error').text('');
            $('#price_error').text('');
            $('#discount_error').text('');
            $('#category_error').text('');
            $('#sub_category_error').text('');
            $('#brand_error').text('');
            $('#product_type_error').text('');
            $('#image_error').text('');
            listErrorId.forEach(function (item){
                $('#'+item).text('');
            });

            $.ajax({
                type: 'post',
                url: "{{route('admin.updateProduct')}}",
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
                            window.location.href="{{route('admin.products')}}";
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
                        var k=key.replace(".", "").replace(/\d/g,"");
                        console.log(k);

                        $("#" + k + "_error").text(val[0]);
                    });
                    console.log(reject);
                }
            });
        });

    </script>
@endsection

