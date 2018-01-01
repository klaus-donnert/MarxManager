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
                        @include('inc.messages')
                        <button class="btn btn-primary btn-lg"
                                data-toggle="modal"
                                data-target="#addModal"
                                type="button"
                                name="button">
                            Add Bookmark
                        </button>
                            <hr>
                        <h3>My Bookmarks</h3>
                        <ul class="list-group">
                            @foreach($bookmarks as $bookmark)
                                <li class="list-group-item clearfix">
                                    <a href="{{$bookmark->url}}" target="_blank">
                                        {{$bookmark->name}}&nbsp;
                                        <span class="label label-info">{{$bookmark->description}}</span>
                                    </a>
                                    <div class="pull-right btn-group" style="border: 1px;">
                                        <div data-id="{{$bookmark->id}}" class="delete-bookmark" title="Delete">
                                            <div class="glyphicon glyphicon-remove"></div>

                                        </div>
                                    </div>
                                </li>
                                @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="addModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Bookmark</h4>
                </div>
                <div class="modal-body">
                    <form action="{{route('bookmarks.store')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" type="text" name="name">
                        </div>
                        <div class="form-group">
                            <label>URL</label>
                            <input class="form-control" type="text" name="url">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                        <input type="submit" class="btn btn-success" name="submit" value="Submit">
                    </form>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
