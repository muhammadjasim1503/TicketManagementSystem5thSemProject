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

                    <div class="mb-3">
                      {{ __('My Tickets!') }}
                    </div>

                    <hr>

                    @foreach ($tickets as $ticket)
                    <div class="row mb-3">
                      <div class="col-md" style = "line-height: 2;" >
                        {{__('Image:')}} {{$ticket->image}}<br>
                        {{__('Title:') }} {{$ticket->title}} {{__('Subject:')}} {{$ticket->subject}} <br>
                        {{__('Description:')}} {{$ticket->description}} <br>

                        <div class="row">
                          <div class="col-md-3">
                            <a href="{{ route('ticket-reply',['id' => $ticket->id]) }}">
                              <button class="btn btn-primary mt-1">
                                {{ __('View Replies') }}
                              </button>
                            </a>
                          </div>

                          <div class="col-md-3">
                          @if($ticket->is_closed == 0)
                            <form class="" action="{{ route('close-ticket',['id' => $ticket->id]) }}" method="post">
                              @csrf
                              <button type = "submit" class="btn btn-primary mt-1">
                                {{ __('Close Thread') }}
                              </button>
                            </form>
                          @else

                            {{__("Thread is Closed")}}

                          @endif
                          </div>
                        </div>

                      </div>
                    </div>
                   <hr>
                   @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
