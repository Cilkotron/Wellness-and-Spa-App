@extends('layouts.app')

@section('title','Contact')


@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')

<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              @include('layouts.partials.msg')
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Contact Messages</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered"  id="table" style="width:100%">
                      <thead class=" text-primary">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Sent At</th>
                        <th>Actions</th>
                      </thead>
                      <tbody>

                    @foreach($contacts as $key=>$contact)
                        <tr>
                            <td>{{ $key + 1}}</td>
                            <td>{{ $contact->name  }}</td>
                            <td>{{ $contact->email  }}</td>
                            <td>{{ $contact->subject  }}</td>
                            <td>{{ $contact->created_at }}</td>
                            <td>
                                <a href="{{ route('contact.show', $contact->id) }}" class="btn btn-info btn-sm"><i class="material-icons">details</i></a>

                                <form id="delete-form-{{ $contact->id }}" action="{{ route('contact.destroy', $contact->id) }}" style="display:none;" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure? You want to delete this?')){
                                    event.preventDefault();
                                    document.getElementById('delete-form-{{ $contact->id }}').submit();
                                } else {
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
