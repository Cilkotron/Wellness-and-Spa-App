@extends('layouts.app')

@section('title','Contact')


@push('css')
@endpush

@section('content')

<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              @include('layouts.partials.msg')
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">{{ $contact->subject}}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <strong> Name: {{ $contact->name }}</strong><br>
                            <b>Email: {{ $contact->email }}</b><br>
                            <strong>Message:</strong><br>
                            <p>{{ $contact->message }}</p><br>
                        </div>
                    </div>
                    <a href="{{ route('contact.index') }}" class="btn btn-danger float-right">Back</a>
                    <div class="clearfix"></div>
                </div>
              </div>
            </div>

          </div>
        </div>

</div>

@endsection

@push('scripts')

@endpush
