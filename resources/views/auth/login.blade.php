@extends('layouts.app')

@section('title','Login')


@push('css')

@endpush

@section('content')

<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('layouts.partials.msg')
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Login</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label class="bmd-label-floating">Email</label>
                                  <input type="email" class="form-control" name="email" required>
                                </div>
                              </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label class="bmd-label-floating">Password</label>
                                <input type="password" class="form-control" name="password" required>
                              </div>
                            </div>
                      </div>
                        <div class="row">
                            <div class="col-md-12  mt-3">
                                <button class="btn btn-primary pull-right mr-3" type="submit">Login</button>
                                <a type="button" class="btn btn-secondary pull-left ml-3" href="{{ route('register') }}">Dont Have Account Yet?</a>
                            </div>
                        </div>

                    </form>

                </div>
              </div>
            </div>

          </div>
        </div>

</div>

@endsection

@push('scripts')

@endpush
