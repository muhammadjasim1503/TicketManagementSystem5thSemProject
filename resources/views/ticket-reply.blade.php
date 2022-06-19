@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ticket Reply') }}</div>

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

                    <div class="mb-3">
                      {{ __('You are logged in!') }}
                    </div>

                    @foreach ($replies as $reply)
                    <div class="row mb-3">
                      <div class="col-md" style = "line-height: 2;" >
                        {{__('Image:')}} {{$reply->image}}<br>
                        {{__('Description:')}} {{$reply->description}} <br>
                      </div>
                    </div>
                   <hr>
                    @endforeach
                </div>

                <div class="card-body">
                  <form method="POST" action="{{ route('send-ticket-reply', ['id' => $ticket_id] ) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                      <div class="col-md-9">
                        <textarea name="msg" rows="5" cols="80" class = "form-control @error('msg') is-invalid @enderror" placeholder="Write message here" value = "{{ old('msg') }}" required autocomplete="msg" autofocus></textarea>
                        @error('name')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      <div class="col-md-3">
                        <label for="image" class=" col-form-label text-md-end">{{ __('Add screenshot') }}</label>
                        <input name = "image" class="mb-3 form-control" type="file" id="image">
                        <button type="submit" class="btn btn-primary">
                          {{ __('Send Reply') }}
                        </button>
                      </div>
                    </div>
                  </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
