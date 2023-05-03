@extends('layouts.dashboard')

@section('styles')
    <link href="{{ asset('css/icheck-bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    @include('_partials.breadcrumbs')
    <!-- /.content-header -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <form action="/admin/categories" method="post" id="categoryForm">
                {{ csrf_field() }}
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create Category</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName">Category Name</label>
                                <input name="name" type="text" id="inputName" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Parent Category</label>
                                <select name="parent_id" id="parentId" class="form-control custom-select">
                                    <option value="" selected>Select one</option>
                                    @foreach ($parent_categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Locations</h3>
                        </div>
                        <div class="card-body">
                            <!-- Minimal style -->
                            @foreach($locations as $key => $val)
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- checkbox -->
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input value="{{$val}}" name="locations[]" type="checkbox" id="{{$key}}">
                                                <label for="{{$key}}">
                                                    {{$val}}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            Many more skins available. <a href="https://bantikyan.github.io/icheck-bootstrap/">Documentation</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Subcategories</h3>
                    </div>
                    <div class="card-body">
                        <!-- Minimal style -->
                        @foreach($free_categories as $item)
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- checkbox -->
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            <input value="{{$item->name}}" name="subCategories[]" type="checkbox" id="{{$item->id}}">
                                            <label for="{{$item->id}}">
                                                {{$item->name}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        Many more skins available. <a href="https://bantikyan.github.io/icheck-bootstrap/">Documentation</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <a href="/admin/categories" class="btn btn-secondary">Cancel</a>
                <input type="submit" form="categoryForm" value="Create new Category" class="btn btn-success float-right">
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>

    </script>
@endsection
