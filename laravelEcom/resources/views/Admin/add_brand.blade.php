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
                <form action="{{ url('/admin/save-brand') }}" method="POST"  enctype="multipart/form-data">
                  @csrf
                      <div class="form-group">
                        <label for="brand_name">Brand Name</label>
                        <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="Enter Brand Name">
                        @error('brand_name') <span class="text-danger">{{ $message }}</span>@enderror
                      </div>
                      <div class="form-group">
                        <label for="image">File input</label>
                        <input type="file" name="image" id="image" class="form-control">
                        @error('image') <span class="text-danger">{{ $image }}</span>@enderror
                      </div>
                      <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control">
                        @error('slug') <span class="text-danger">{{ $slug }}</span>@enderror
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

