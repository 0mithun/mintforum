@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Privacy Policy</div>
                    <div class="panel-body">
                        {!! $admin->faq !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
