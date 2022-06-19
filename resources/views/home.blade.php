@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Home') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="mb-3">
                      {{ __('You are at Home!') }}
                    </div>

                    <table class = "bg-light" style="width:100vh;">
                      <tr>
                        <td>
                          <p style = "text-align: right;">right aligned</p>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <p style = "text-align: left;">left aligned</p>
                        </td>
                      </tr>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
