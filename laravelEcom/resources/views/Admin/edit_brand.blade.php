@extends('layouts.admin')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Brands</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Brands</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
     
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">Add Brand</div>
              <div class="card-body">
                @if(Session::has('status'))
                  <p class="alert alert-success">{{ Session::get('status') }}</p>
                @endif
                <form action="{{ url('/admin/update-brand') }}" method="POST"  enctype="multipart/form-data">
                  @csrf
                      <div class="form-group">
                        <label for="brand_name">Brand Name</label>
                        <input type="text" class="form-control" id="edit_name" name="edit_name" value="{{ $brand->name }}" placeholder="Enter Brand Name">
                        <input type="hidden" class="form-control" id="old_id" name="old_id" value="{{ $brand->id }}">
                        <input type="hidden" class="form-control" id="old_image" name="old_image" value="{{ $brand->image }}">
                        @error('edit_name') <span class="text-danger">{{ $message }}</span>@enderror
                      </div>
                      <div class="form-group">
                        <label for="image">File input</label>
                        <input type="file" name="image" id="image" class="form-control">
                        <img src="{{ asset('brands/'.$brand->image) }}" class='mt-3'>
                        @error('image') <span class="text-danger">{{ $message }}</span>@enderror
                      </div>
                      <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" name="edit_slug" id="edit_slug" value="{{ $brand->slug }}" class="form-control">
                        @error('edit_slug') <span class="text-danger">{{ $message }}</span>@enderror
                      </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <a href="{{ url('/admin/brands') }}" class="btn btn-danger">Back</a>
                        <input type="submit" class="btn btn-success" >
                    </div>
                </form>
              </div>
            </div>
          </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

