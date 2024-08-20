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
              <div class="card-header">Brands List
                  <a href="{{ url('/admin/add-brand')}}" class="btn btn-success float-right">Add</a>
              </div>
              <span class="text-success" id="msg"></span>
              <div class="card-body">
               @if(Session::has('status'))
                  <p class="alert alert-success">{{ Session::get('status') }}</p>
                @endif
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>S.NO</th>
                      <th>Brand Name</th>
                      <th style="white-space:nowrap">Slug</th>
                      <th style="white-space:nowrap">Image</th>
                      <td>Actions</td>
                    </tr>
                  </thead>
                  <tbody>
                  @forelse ($brands as $row)
                    <tr>
                      <td>{{ $row->id }}</td>
                      <td>{{ $row->name }}</td>
                      <td>{{ $row->slug }}</td>
                      <td><img src="{{ asset('brands/'.$row->image) }}"></td>
                      <td>
                      <a href="{{ url('/admin/edit-brand/'.$row->id)}}" class="btn btn-success">Edit</a>
                      <a href="{{ url('/admin/delete-brand/'.$row->id)}}" class="btn btn-danger">Delete</a>
                      </td>
                    </tr>
                  @empty
                    <th colspan="5" class="text-center">No Data Found</th>
                  @endforelse
                  </tbody>
                    <tfoot>
                      <tr>
                        <th>S.NO</th>
                        <th>Brand Name</th>
                        <th style="white-space:nowrap">Slug</th>
                        <th style="white-space:nowrap">Image</th>
                        <th>Actions</th>
                      </tr>
                    </tfoot>
                </table>
              </div>
          </div>
        </div>
      </div>
        <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

