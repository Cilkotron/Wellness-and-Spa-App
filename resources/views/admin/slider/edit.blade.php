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
                  <h4 class="card-title">Edit Slider</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('slider.update', $slider->id ) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row justify-content-center">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label class="bmd-label-floating">Title </label>
                                  <input type="text" class="form-control" name="title" value="{{ $slider->title }}">
                                </div>
                              </div>
                        </div>
                        <div class="row justify-content-center">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label class="bmd-label-floating">Sub Title </label>
                                  <input type="text" class="form-control" name="sub_title" value="{{ $slider->sub_title }}">
                                </div>
                              </div>
                       </div>
                       <div class="row justify-content-center">
                              <div class="col-md-12">
                                  <label class="bmd-label-floating">Re-Upload Image</label>
                                  <br>
                                  <input type="file" name="image">
                              </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-primary pull-right mr-3" type="submit">Save</button>
                                <a href="{{ route('slider.index') }}" class="btn btn-danger pull-right">Back</a>
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
