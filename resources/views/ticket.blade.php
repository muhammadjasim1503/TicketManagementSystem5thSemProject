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

                    <div class="mb-3 ticket">
                      {{ __('My Tickets!') }}
                    </div>

                    @foreach ($tickets as $ticket)
                    <div class="row mb-3">
                      <div class="col-md" style = "line-height: 2;" >
                        @if ($ticket->image)
                          <a href="{{ route('show-image',$ticket->image) }}">
                            {{__('Image:')}} {{$ticket->image}}<br>
                          </a>
                          @else
                            {{__('Image:')}} {{$ticket->image}}<br>
                          @endif
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

                </div>
            </div>
        </div>
    </div>
</div>

<script>
  // Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
@endsection
