@extends('layouts.app')

@section('title','Reservation')


@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')

<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
                <a href="{{ route('reservation.calendar') }}" class="btn btn-primary "><span class="material-icons">event</span>Calendar</a>
              @include('layouts.partials.msg')
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Reservations</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered"  id="table" style="width:100%">
                      <thead class=" text-primary">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Time&Date</th>
                        <th>Service</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                      </thead>
                      <tbody>

                    @foreach($reservations as $key=>$reservation)
                        <tr>
                            <td>{{ $key + 1}}</td>
                            <td>{{ $reservation->name  }}</td>
                            <td>{{ $reservation->email  }}</td>
                            <td>{{ $reservation->phone  }}</td>
                            <td class="text-truncate" style="max-width: 100px;">{{ $reservation->date_and_time  }}</td>
                            <td>{{ $reservation->service->name  }}</td>
                            <td class="text-truncate" style="max-width: 100px;">{{ $reservation->message  }}</td>
                            <td>
                                @if($reservation->status == true )
                                   <span class="badge badge-pill badge-success">Confirmed</span>
                                @else
                                    <span class="badge badge-pill badge-danger">NotConfirmed</span>
                                @endif
                            </td>
                            <td class="text-truncate" style="max-width: 100px;">{{ $reservation->created_at }}</td>
                            <td>
                                @if($reservation->status == false)
                                <form id="status-form-{{ $reservation->id }}" action="{{ route('reservation.status',$reservation->id) }}" style="display: none;" method="POST">
                                    @csrf
                                </form>
                                <button type="button" class="btn btn-info btn-sm" onclick="if(confirm('Have you confirmed this resevation by phone?')){
                                        event.preventDefault();
                                        document.getElementById('status-form-{{ $reservation->id }}').submit();
                                        }else {
                                        event.preventDefault();
                                        }"><i class="material-icons">done</i></button>
                            @endif

                                <form id="delete-form-{{ $reservation->id }}" action="{{ route('reservation.destroy', $reservation->id ) }}" style="display:none;" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure? You want to delete this?')){
                                    event.preventDefault();
                                    document.getElementById('delete-form-{{ $reservation->id }}').submit();
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
