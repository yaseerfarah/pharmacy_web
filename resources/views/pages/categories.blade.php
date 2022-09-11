@extends('layouts.master')

@section('title')
    Categories
@stop

@section('css')

@endsection

@section('title_page1')
    Categories
@endsection

@section('title_page2')
    Categories
@endsection


@section('content')
    <!-- Main content -->
    <section class="content">


        <br>

        <a href="{{route('admin.addCategory')}}">
            <button type="button" class="btn btn-primary " >
                <i class="fa fa-plus"></i>
                Add New Category
            </button>
        </a>
        <br>
        <br>

        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>  </th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>SubCategories Number</th>
                                <th>Products Number</th>
                                <th>Actions</th>

                            </tr>
                            </thead>
                            <tbody>
                            @forelse($categories as $category)
                                <tr id="record_{{$category->id}}">
                                    <td><img src="{{asset($category->image)}}" class="rounded" width="150" height="150"></td>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->name_en}}</td>
                                    <td>{{$category->subCategory->count()}}</td>
                                    <td>{{$category->products->count()}}</td>


                                    <td><div class="row">
                                            <div class="col">
                                                <button type="button" class="btn btn-block bg-gradient-success edit" value="{{$category->id}}">edit</button>
                                            </div>
                                            <div class="col">
                                                <button type="button" class="btn btn-block bg-gradient-danger  delete"   value="{{$category->id}}">Delete</button>
                                            </div>
                                        </div></td>
                                </tr>
                            @empty

                            @endforelse

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>




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


        var modal=document.getElementById("modal-default");
        var modal_txt = document.getElementById("modal_txt");
        var deleteBtn = document.getElementById("delete_btn");
        var closeBtn = document.getElementById("close_btn");

        var id=-1;



        $('.edit').click(function (e){
            e.preventDefault();
            var value=$(this).attr("value");
            var url = '{{ route("admin.editCategory", ":id") }}';
            url = url.replace(':id', value );
            window.location.href=url;
        })

        $('.delete').click(function (e){
            e.preventDefault();
            id=$(this).attr("value");
            $('#modal_txt').text("Do you want to delete item "+id+" ?");
            modal.style.display = "block";
            console.log('hello '+id);
        })

        closeBtn.onclick = function() {
            modal.style.display = "none";
            id=-1;
        }


        deleteBtn.onclick = function() {
            modal.style.display = "none";
            if(id>-1) {
                $.ajax({
                    type: 'post',
                    url: "{{route('admin.deleteCategory')}}",
                    data: 'id=' + id,
                    success: function (data) {
                        $('#record_'+id).remove();

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
                        id=-1;
                    }
                });
            }
        }



    </script>
@endsection

