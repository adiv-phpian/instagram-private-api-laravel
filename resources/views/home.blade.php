@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="boxes">
                      <div class="box">
                        <span class="number">{{ $total_count }}</span>
                        Total users
                      </div>

                      <div class="box">
                        <span class="number">{{ $today_count }}</span>
                        Today Signup
                      </div>

                      <div class="box">
                        <span class="number">{{ $login_count }}</span>
                        Today Login
                      </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
