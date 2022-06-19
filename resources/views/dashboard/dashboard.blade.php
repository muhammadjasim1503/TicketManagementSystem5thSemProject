@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                      {{ __('You are logged in!') }}

                    @if(auth()->user()->is_admin == 0)
                    <div class="row mb-3">
                        <div class="col-md-3">
                          <a href="{{ route('ticket-form') }}">
                            <button class="btn btn-primary">
                              {{ __('Add Ticket') }}
                            </button>
                          </a>
                        </div>

                        <div class="col-md-3">
                          <a href="{{ route('ticket') }}">
                            <button class="btn btn-primary">
                              {{ __('My Tickets') }}
                            </button>
                          </a>
                        </div>
                    </div>

                    <hr>

                    <div class="mb-3">
                      {{ __('My Tickets!') }}
                    </div>

                    @foreach ($tickets as $ticket)
                      <div class="row mb-3">
                        <div class="col-md" style = "line-height: 2;" >
                          {{__('Image:')}} {{$ticket->image}}<br>
                          {{__('Title:') }} {{$ticket->title}} {{__('Subject:')}} {{$ticket->subject}} <br>
                          {{__('Description:')}} {{$ticket->description}} <br>
                          <a href="{{ route('ticket-reply',['id' => $ticket->id]) }}">
                            <button class="btn btn-primary mt-1">
                              {{ __('View Replies') }}
                            </button>
                          </a>
                        </div>
                      </div>
                      <hr>
                     @endforeach

                   @else

                   @foreach ($users as $user)
                     <div class="row mb-3">
                       <div class="col-md" style = "line-height: 2;" >
                         {{__('Name:')}} {{$user->name}}<br>
                         <a href="{{ route('dashboard-ticket', ['id' => $user->id] ) }}">
                           <button class="btn btn-primary mt-1">
                             {{ __('View Tickets') }}
                           </button>
                         </a>
                       </div>
                     </div>
                    <hr>
                    @endforeach

                   @endif



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
