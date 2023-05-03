@extends('layouts.dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    @include('_partials.breadcrumbs')
    <!-- /.content-header -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Categories</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="categoriesTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Parent Category</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script>
        $(function (){
            $('#categoriesTable').DataTable({
                ajax: '/admin/categories',
                paging: true,
                lengthChange: false,
                searching: false,
                ordering: true,
                info: true,
                autoWidth: false,
                responsive: true,
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'parent_category.name', name: 'parent category', defaultContent: ''},
                    {data: function (row){
                        return `<a href="/admin/categories/${row.id}/edit" class="btn btn-default">edit</a>`;
                    }},
                ]
            });
        });
    </script>
@endsection
