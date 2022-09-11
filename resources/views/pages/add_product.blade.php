@extends('layouts.master')

@section('title')
    Add New Product
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}"/>

    <link rel="stylesheet" href="{{asset('/assets//plugins/toastr/toastr.min.css')}}"/>
@endsection

@section('title_page1')
    Products
@endsection

@section('title_page2')
    Add Product
@endsection


@section('content')
    <!-- Main content -->
    <section class="content">


        <div >
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add New Product </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="newProduct">
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
                            <label >Details Arabic</label>
                            <textarea class="form-control" rows="3"  name="detail_ar" placeholder="Enter ..."></textarea>
                            <small id="detail_ar_error" class="form-text text-danger"></small>
                        </div>

                        <div class="form-group">
                            <label >Details English</label>
                            <textarea class="form-control" rows="3" name="detail_en" placeholder="Enter ..."></textarea>
                            <small id="detail_en_error" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label >Price</label>
                            <input type="number" class="form-control"  name="price" placeholder="Price">
                            <small id="price_error" class="form-text text-danger"></small>
                        </div>

                        <div class="form-group">
                            <label >Quantity</label>
                            <input type="number" class="form-control"  name="quantity" placeholder="Quantity">
                            <small id="quantity_error" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label>Discount</label>
                            <select  name="discount" class="form-control">
                                <option value="0">0%</option>
                                <option value="10">10%</option>
                                <option value="20">20%</option>
                                <option value="40">40%</option>
                                <option value="50">50&</option>
                                <option value="60">60%</option>
                            </select>
                            <small id="discount_error" class="form-text text-danger"></small>
                        </div>

                        <div class="form-group">
                            <label>Category</label>
                            <select   name="category" id="category" class="form-control category">
                                <option value="">Select Category</option>
                                @forelse($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name_en}}</option>
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
                                    <option value="{{$brand->id}}">{{$brand->name_en}}</option>
                                @empty
                                @endforelse
                            </select>
                            <small id="brand_error" class="form-text text-danger"></small>
                        </div>




                        <div class="form-group">
                            <label>Product Type</label>
                            <select name="product_type" class="form-control">
                                @forelse($productTypes as $productType)
                                    <option value="{{$productType->id}}">{{$productType->name_en}}</option>
                                @empty
                                @endforelse
                            </select>
                            <small id="product_type_error" class="form-text text-danger"></small>
                        </div>


                        <div class="form-group">
                            <label>Used For</label>
                            <select name="used_for" class="form-control">
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                                <option value="3">Both</option>
                            </select>
                            <small id="used_for_error" class="form-text text-danger"></small>
                        </div>

                        <div class="form-group">
                            <label for="formFileMultiple" class="form-label">Multiple images files </label>
                            <input class="form-control" type="file" name="image[]" id="formFileMultiple" multiple accept="image/*" />
                        </div>
                        <small id="image_error" class="form-text text-danger"></small>

                    </div>
                    <!-- /.card-body -->

                    <div id="newform">


                    </div>


                        <button id="new_form" class="btn btn-primary">Add new feature</button>

                    <hr>
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












        var count=0;
        var listErrorId=[];

            $('#new_form').click(function(e){
                e.preventDefault();
                count++;
                $('#newform').slideDown();
                var newrow = '';


                newrow += '<div class="card card-primary" id="card_'+count+'">';
                newrow += ' <div class="card-header"> <h3 class="card-title">New Feature '+count+' </h3> <div class="card-tools"> <button   id="close" value="'+(count)+'" class="btn btn-tool" > <i class="fas fa-times '+(count)+'"></i>  </button>   </div> </div> ';
                newrow += '<div class="card-body">';

                newrow += ' <div class="form-group"> <label >Name Arabic</label> <input type="text" class="form-control" id="f_name_ar" name="f_name_ar[]" placeholder="Name Arabic"> <small id="f_name_ar'+(count-1)+'_error" class="form-text text-danger"></small> </div>';
                listErrorId.push('f_name_ar'+(count-1)+'_error');
                newrow += ' <div class="form-group"> <label >Name English</label> <input type="text" class="form-control" id="f_name_en" name="f_name_en[]" placeholder="Name English"> <small id="f_name_en'+(count-1)+'_error" class="form-text text-danger"></small> </div>';
                listErrorId.push('f_name_en'+(count-1)+'_error');

                newrow += '<div class="form-group">  <label >Details Arabic</label> <textarea class="form-control" rows="3"  name="f_detail_ar[]" placeholder="Enter ..."></textarea> <small id="f_detail_ar'+(count-1)+'_error" class="form-text text-danger"></small> </div>';
                listErrorId.push('f_detail_ar'+(count-1)+'_error');
                newrow += '<div class="form-group">  <label >Details English</label> <textarea class="form-control" rows="3"  name="f_detail_en[]" placeholder="Enter ..."></textarea> <small id="f_detail_en'+(count-1)+'_error" class="form-text text-danger"></small> </div>';
                listErrorId.push('f_detail_en'+(count-1)+'_error');

                newrow += '</div>';
                newrow += '</div>';

                $('#newform').append(newrow);


            });


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
            if(element.tagName == 'I'){
                event.preventDefault();
                console.log(element.classList[element.classList.length-1]);
                var id=element.classList[element.classList.length-1];
                $("#card_"+id).remove();
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
                url: "{{route('admin.addNewProduct')}}",
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
                        var k=key.replace(".", "")
                        console.log(k);

                        $("#" + k + "_error").text(val[0]);
                    });
                    console.log(reject);
                }
            });
        });

    </script>
@endsection

