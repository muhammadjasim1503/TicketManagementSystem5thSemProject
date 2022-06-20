@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ticket Reply') }}</div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(session('statusDanger'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('statusDanger') }}
                        </div>
                    @endif

                    <div class="mb-3">
                        {{ __('You are logged in!') }}
                    </div>
                        
                    {{-- To show the replies from a database to a specific ticket --}}
                    <div class="row mb-3">
                        <div class="col-md" style="line-height: 2;">
                            <strong>{{ __("User issue:") }}</strong> <br>
                            @if ($ticket->image)
                            <a href="{{ route('show-image',$ticket->image) }}">
                                {{__('Image:')}} {{$ticket->image}}<br>
                            </a>
                            @else
                                {{__('Image:')}} {{$ticket->image}}<br>
                            @endif
                            {{ __('Title:') }} {{ $ticket->title }} <br>
                            {{ __('Description:') }} {{ $ticket->description }} <br>
                        </div>
                    </div>
                    <hr style="border-top: 5px solid">
                    @foreach($replies as $reply)
                        <div class="row mb-3">
                            <div class="col-md" style="line-height: 2;">
                                @if ($reply->is_admin == 0)
                                    <em>{{ __("From user:") }}</em> <br>
                                    @else
                                    <em>{{ __("From admin:") }}</em> <br>
                                @endif

                                @if ($reply->image)
                                <a href="{{ route('show-image',$reply->image) }}">
                                    {{__('Image:')}} {{$reply->image}}<br>
                                </a>
                                @else
                                    {{__('Image:')}} {{$reply->image}}<br>
                                @endif

                                {{-- {{ __('Image:') }} {{ $reply->image }}<br> --}}
                                {{ __('Description:') }} {{ $reply->description }} <br>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>

                @if ($ticket->is_closed==0)
                {{-- a code to reply to a message --}}
                <div class="card-body">
                    <form method="POST"
                        action="{{ route('send-ticket-reply', ['id' => $ticket_id] ) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-9">
                                <textarea name="msg" rows="5" cols="80"
                                    class="form-control @error('msg') is-invalid @enderror"
                                    placeholder="Write message here" value="{{ old('msg') }}" required
                                    autocomplete="msg" autofocus></textarea>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="image"
                                class=" col-form-label text-md-end">{{ __('Add screenshot') }}</label>
                                <input name="image" class="mb-3 form-control" type="file" id="image">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Reply') }}
                                </button>
                            </div>
                @else
                    <div class = "card-body">
                        <div class="row-mb-3">
                            <div class = "col-md">
                                <em>
                                    {{ __("This thread is closed. You can not reply to this conversation anymore!!!") }}
                                </em>
                            </div>
                        </div>
                    </div>
                @endif
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
