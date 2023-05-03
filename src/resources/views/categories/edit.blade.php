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
                <form action="/admin/categories/{{$category->id}}" method="post" id="categoryForm">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Category Edit</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                            <div class="form-group">
                                <label for="inputName">Category Name</label>
                                <input name="name" value="{{$category->name}}" type="text" id="inputName" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Parent Category</label>
                                <select name="parent_id" id="parentId" class="form-control custom-select">
                                    <option value="">Select one</option>
                                    @foreach ($parent_categories as $parent_category)
                                        <option @if(!empty($category->parentCategory) && $parent_category->id == $category->parentCategory->id) selected @endif value="{{$parent_category->id}}">{{$parent_category->name}}</option>
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
                        @foreach($locations as $key => $val)
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- checkbox -->
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            <input value="{{$val}}" name="locations[]" type="checkbox" id="{{$key}}" @if(in_array($key, $selected_locations)) checked="checked" @endif>
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
        </div>
        <div class="row">
            <div class="col-6">
                <a href="/admin/categories" class="btn btn-secondary">Cancel</a>
                <input type="submit" form="categoryForm" value="Update Category" class="btn btn-success float-right">
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script type="text/javascript">

    </script>
@endsection
