@extends('layouts.app')

@section('title','Category')


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
                  <h4 class="card-title">Add New Category</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label class="bmd-label-floating">Name</label>
                                  <input type="text" class="form-control" name="name">
                                </div>
                              </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-primary pull-right mr-3" type="submit">Save</button>
                                <a href="{{ route('category.index') }}" class="btn btn-danger pull-right">Back</a>
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
