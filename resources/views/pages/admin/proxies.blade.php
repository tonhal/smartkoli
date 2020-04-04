@extends('layouts.app')

@section('content')
    <table>
        <thead>
        <th>Name</th>
        @foreach ($doors as $door)
            <th>{{ $door->name }}</th>
        @endforeach
        </thead>
        <tbody>
            <tr>
                <td>én</td>
                @foreach($doors as $door)
                    @if(in_array('én',$door->auth))
                        <td>igen</td>
                    @else
                        <td>nem</td>
                    @endif
                @endforeach
            </tr>
        </tbody>
    </table>
@endsection