@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ticket Form') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('statusDanger'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('statusDanger') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <div class="card-body">
                        <form method="POST" action="{{ route('ticket-form') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="subject" class="col-md-4 col-form-label text-md-end">{{ __('Subject') }}</label>

                                <div class="col-md-6">
                                    <input id="subject" type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject') }}" required autocomplete="subject" autofocus>

                                    @error('subject')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                              <label for="#" class="col-md-4 col-form-label text-md-end">{{ __('Select') }}</label>
                              <div class="col-md-3">
                                <select name = "priority" class="form-select form-select-md mb-3" aria-label=".form-select-md priority">
                                  <option value = 0 selected>Priority</option>
                                  <option value="1">Low</option>
                                  <option value="2">Medium</option>
                                  <option value="3">High</option>
                                </select>
                                @error('priority')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>

                              <div class="col-md-3">
                                <select name = "department" class="form-select form-select-md mb-3" aria-label=".form-select-md department">
                                  <option value = 0 selected>Department</option>
                                  <option value="1">Sales</option>
                                  <option value="2">Marketing</option>
                                  <option value="3">HR</option>
                                </select>
                                @error('department')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus></textarea>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                              <div class="col-md-6 offset-md-4">
                                <div class="mb-3">
                                  <label for="image" class="form-label">Add screenshots</label>
                                  <input name = "image" class="form-control @error('subject') is-invalid @enderror" type="file" id="image">
                                  @error('image')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                                </div>
                              </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Add Ticket') }}
                                    </button>
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
