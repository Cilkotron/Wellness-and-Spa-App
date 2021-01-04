@extends('layouts.app')

@section('title','Category')


@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')

<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
                <a href="{{ route('category.create') }}" class="btn btn-primary btn-md">Add New</a>
              @include('layouts.partials.msg')
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Categories</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered"  id="table" style="width:100%">
                      <thead class="text-primary">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                      </thead>
                      <tbody>

                    @foreach($categories as $key=>$category)
                        <tr>
                            <td>{{ $key + 1}}</td>
                            <td>{{ $category->name  }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->created_at }}</td>
                            <td>{{ $category->updated_at }}</td>
                            <td>
                              <a href="{{ route('category.edit', $category->id) }}" class="btn btn-info btn-sm"><i class="material-icons">mode_edit</i></a>

                              <form id="delete-form-{{ $category->id }}" action="{{ route('category.destroy', $category->id) }}" style="display:none;" method="POST">
                                  @csrf
                                  @method('DELETE')
                              </form>
                              <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure? You want to delete this?')){
                                  event.preventDefault();
                                  document.getElementById('delete-form-{{ $category->id }}').submit();
                              }else {
                                  event.preventDefault();
                                      }"><span class="material-icons">delete</span></button>
                            </td>
                        </tr>
                      @endforeach

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>

</div>

@endsection

@push('scripts')
    <script  type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script  type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        } );
    </script>
@endpush
