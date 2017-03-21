@extends('layouts.app')

@section('content')
    @include('vendor.ueditor.assets')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $question->title }}</div>

                    <div class="panel-body">
                        {!! $question->body !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
