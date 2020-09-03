@extends('layouts.app')

@section('title','Dashboard')


@push('css')
@endpush

@section('content')
<div class="container-fluid mt-5">
            <div class="row mt-5">
                <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">aspect_ratio</i>
                    </div>
                    <p class="card-category">Category/Services</p>
                    <h3 class="card-title">{{ $categoryCount }}/{{ $serviceCount }}
                    </h3>
                    </div>
                    <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">info</i>
                        <a href="javascript:;">Total categories & services</a>
                    </div>
                    </div>
                </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">slideshow</i>
                    </div>
                    <p class="card-category">Slider Count</p>
                    <h3 class="card-title">{{ $sliderCount }}</h3>
                    </div>
                    <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">details</i>
                        <a href="{{ route('slider.index') }}">Get More Details</a>
                    </div>
                    </div>
                </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-danger card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">info_outline</i>
                    </div>
                    <p class="card-category">Reservation</p>
                    <h3 class="card-title">{{ $reservations->count() }}
                    </h3>
                    </div>
                    <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">local_offer</i><span>Not Confirmed</span>
                    </div>
                    </div>
                </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">contacts</i>
                    </div>
                    <p class="card-category">Contacts</p>
                    <h3 class="card-title">{{ $contactCount }}</h3>
                    </div>
                    <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">update</i> Just Updated
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
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
                            <th>Phone</th>
                            <th>Service</th>
                            <th>Status</th>
                            <th>Actions</th>
                          </thead>
                          <tbody>

                        @foreach($reservations as $key=>$reservation)
                            <tr>
                                <td>{{ $key + 1}}</td>
                                <td>{{ $reservation->name  }}</td>
                                <td>{{ $reservation->phone  }}</td>
                                <td>{{ $reservation->service->name  }}</td>
                                <td>
                                    @if($reservation->status == true )
                                       <span class="badge badge-pill badge-success">Confirmed</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">NotConfirmed</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('reservation.calendar') }}" class="btn btn-primary btn-sm" title="Calendar"><span class="material-icons">event</span></a>
                                    @if($reservation->status == false)
                                    <form id="status-form-{{ $reservation->id }}" action="{{ route('reservation.status',$reservation->id) }}" style="display: none;" method="POST">
                                        @csrf
                                    </form>
                                    <button type="button" class="btn btn-info btn-sm" title="Confirm Reservation" onclick="if(confirm('Have you confirmed this resevation by phone?')){
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
                                    <button type="button" class="btn btn-danger btn-sm" title="Delete" onclick="if(confirm('Are you sure? You want to delete this?')){
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

@endsection

@push('scripts')

@endpush
