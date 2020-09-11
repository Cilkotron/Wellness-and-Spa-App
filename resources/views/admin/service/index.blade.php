@extends('layouts.app')

@section('title','Service')


@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')

<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
                <a href="{{ route('service.create') }}" class="btn btn-primary btn-md">Add New</a>
              @include('layouts.partials.msg')
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Services</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered"  id="table" style="width:100%">
                      <thead class=" text-primary">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Category Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                      </thead>
                      <tbody>

                    @foreach($services as $key=>$service)
                        <tr>
                            <td>{{ $key + 1}}</td>
                            <td class="text-truncate" style="max-width: 100px;">{{ $service->name  }}</td>
                            <td><img class="img-responsive img-thumbnail" src="{{ Storage::disk('s3')->url($service->image)}}" style="height: 100px; width: 100px;" alt=""></td>
                            <td class="text-truncate" style="max-width: 100px;">{{ $service->category->name }}</td>
                            <td class="text-truncate" style="max-width: 100px;">{{ $service->description }}</td>
                            <td>{{ $service->price }}</td>
                            <td class="text-truncate" style="max-width: 100px;">{{ $service->created_at }}</td>
                            <td  class="text-truncate" style="max-width: 100px;">{{ $service->updated_at }}</td>
                            <td>
                              <a href="{{ route('service.edit', $service->id) }}" class="btn btn-info btn-sm"><i class="material-icons">mode_edit</i></a>

                              <form id="delete-form-{{ $service->id }}" action="{{ route('service.destroy', $service->id) }}" style="display:none;" method="POST">
                                  @csrf
                                  @method('DELETE')
                              </form>
                              <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure? You want to delete this?')){
                                  event.preventDefault();
                                  document.getElementById('delete-form-{{ $service->id }}').submit();
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
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        } );
    </script>
@endpush
