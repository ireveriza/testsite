@extends('layout')
@section('content')
    <div class="row">
        <div class="card w-50 mt-5 mr-auto ml-auto">
            <div class="card-body">
                <a href="{{ route('organizations.create') }}" type="button" class="btn btn-primary btn-sm mb-2">Add New Organization</a>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">People</th>
                        <th scope="col">Operations</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($organizations as $organization)
                        <tr>
                            <th scope="row">{{ $organization->id }}</th>
                            <td>{{ $organization->name }}</td>
                            <td>
                                @if($organization->people)
                                    <ul>
                                        @foreach($organization->people as $person)
                                            <li>{{ $person->name }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span>NONE</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('organizations.destroy', ['organization' => $organization->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('organizations.edit', ['organization' => $organization->id]) }}" type="button" class="btn btn-primary btn-sm btn-block">Edit</a>
                                    <button type="submit" class="btn btn-danger btn-sm btn-block">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
