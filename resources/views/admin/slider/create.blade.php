@extends('layouts.app')

@section('title','Slider')


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
                  <h4 class="card-title">Add New Slider</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('slider.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label class="bmd-label-floating">Title </label>
                                  <input type="text" class="form-control" name="title">
                                </div>
                              </div>
                        </div>
                        <div class="row justify-content-center">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label class="bmd-label-floating">Sub Title </label>
                                  <input type="text" class="form-control" name="sub_title">
                                </div>
                              </div>
                       </div>
                       <div class="row justify-content-center">
                              <div class="col-md-12">
                                  <label class="bmd-label-floating">Image</label>
                                  <br>
                                  <input type="file" name="image">
                              </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('slider.index') }}" class="btn btn-danger pull-right">Back</a>
                                <button class="btn btn-primary pull-right mr-3" type="submit">Save</button>
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
