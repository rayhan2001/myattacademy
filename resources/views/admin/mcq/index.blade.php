@extends('layouts.admin_app')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="com-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{route('mcq.create')}}" class="btn btn-success">add mcq</a>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($mcqs as $mcq)
                                <tr>
                                    <th scope="row">1</th>
                                    <td>{{$mcq->question}}</td>
                                    <td>
                                        <a href="{{route('mcq.edit',$mcq->id)}}" class="btn btn-primary">Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
