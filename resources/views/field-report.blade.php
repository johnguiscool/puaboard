@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8 mt-3">
            <div class="card">
                <div class="card-header">{{$fieldReport->title}}</div>

                <div class="card-body">
                    {{$fieldReport->created_at}}

                    <p>
                        <p>

                            {{$fieldReport->content}}

                            @if($hasPermissions)
                            <div class="container">
                                <div class="row justify-content-center" data-toggle="modal" data-target="#exampleModal">
                                    <button type="button" class="btn btn-danger">Delete</button>
                                </div>
                            </div>
                            @endif
                </div>

            </div>

        </div>

    </div>
</div>

@if($hasPermissions)
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endif

@endsection