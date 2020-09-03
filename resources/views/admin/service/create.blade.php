@extends('layouts.app')

@section('title','Service')


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
                  <h4 class="card-title">Add New Service</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('service.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label class="bmd-label-floating">Category</label>
                                  <select class="form-control" name="category_id">
                                    <option value='' selected disabled>--- please select ---</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label class="bmd-label-floating">Name</label>
                                <input type="text" class="form-control" name="name">
                              </div>
                            </div>
                      </div>
                      <div class="row justify-content-center">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="bmd-label-floating">Description</label>
                            <textarea class="form-control" name="description"></textarea>
                          </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="bmd-label-floating">Price</label>
                            <input type="number" class="form-control" name="price">
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
                                <button class="btn btn-primary pull-right mr-3" type="submit">Save</button>
                                <a href="{{ route('service.index') }}" class="btn btn-danger pull-right">Back</a>
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
