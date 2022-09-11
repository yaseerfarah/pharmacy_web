@extends('layouts.master')

@section('title')
    Orders
@stop

@section('css')

@endsection

@section('title_page1')
    Orders
@endsection

@section('title_page2')
    Orders
@endsection


@section('content')
    <!-- Main content -->
    <section class="content">


        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Product</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>183</td>
                                <td>John Doe</td>
                                <td>Product name</td>
                                <td>11-7-2014</td>
                                <td>Approved</td>

                                <td><div class="row">
                                        <div class="col">
                                        <button type="button" class="btn btn-block bg-gradient-success">Success</button>
                                        </div>
                                        <div class="col">
                                            <button type="button" class="btn btn-block bg-gradient-success">Success</button>
                                        </div>
                                        <div class="col">
                                            <button type="button" class="btn btn-block bg-gradient-success">Success</button>
                                        </div>
                                    </div></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>


    </section>
    <!-- /.content -->
@endsection


@section('scripts')

@endsection

