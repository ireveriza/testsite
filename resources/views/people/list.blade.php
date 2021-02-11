@extends('layout')
@section('content')
    <div class="row">
        <div class="card w-50 mt-5 mr-auto ml-auto">
            <div class="card-body">
                <a href="{{ route('people.create') }}" type="button" class="btn btn-primary btn-sm mb-2">Add New Person</a>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Organizations</th>
                        <th scope="col">Operations</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($people as $person)
                        <tr>
                            <th scope="row">{{ $person->id }}</th>
                            <td>{{ $person->name }}</td>
                            <td>
                                @if($person->organizations)
                                    <ul>
                                        @foreach($person->organizations as $organization)
                                            <li>{{ $organization->name }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span>NONE</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('people.destroy', ['person' => $person->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('people.edit', ['person' => $person->id]) }}" type="button" class="btn btn-primary btn-sm btn-block">Edit</a>
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
