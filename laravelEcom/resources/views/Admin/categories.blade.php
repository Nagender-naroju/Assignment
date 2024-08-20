@extends('layouts.admin')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Categories</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Categories</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

   <!-- Add modal -->
      <div class="modal fade" id="Mymodallg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Category</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{ url('/admin/save-category') }}" method="POST" id="add_category" enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                      <label for="category_name">Category Name</label>
                      <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter Category Name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">File input</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="image" name="image">
                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                          <input type="file" style="widows:0; height:0" id="ImageBrowse" hidden="hidden" name="image" size="30"/>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="status">Status</label>
                        <select name="status" class="form-control" id="status">
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                        </select>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Add</button>
                  </div>
              </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
  <!-- End add modal -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
          <div class="col-md-12">
              <div class="card">
                <div class="card-header">Categories 
                  <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#Mymodallg">
                    Add
                  </button>
                </div>
                <span class="text-success" id="msg"></span>
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>S.NO</th>
                        <th>Category Name</th>
                        <th style="white-space:nowrap">Category Image</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                    @forelse ($categories as $row)
                      <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->category_name }}</td>
                        <td><img src="{{ asset('category_images/'.$row->category_image) }}"></td>
                        <td> {{ $row->status == "1" ? "Active" : "Inactive" }} </td>
                      </tr>
                    @empty
                      <th colspan="5">No Data Founs</th>
                    @endforelse
                    </tbody>
                      <tfoot>
                        <tr>
                          <th>S.NO</th>
                          <th>Category Name</th>
                          <th>Category Image</th>
                          <th>Statue</th>
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

