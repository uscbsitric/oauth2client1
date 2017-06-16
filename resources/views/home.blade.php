@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                  Passport Clients:
                  <passport-clients></passport-clients>
                  Passport Authorized Clients:
                  <passport-authorized-clients></passport-authorized-clients>
                  Passport Personal Access Tokens:
                  <passport-personal-access-tokens></passport-personal-access-tokens>
                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
