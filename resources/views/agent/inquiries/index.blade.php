@extends('layouts.app')

@section('content')
    <h1>Inquiries</h1>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inquiries as $inquiry)
                <tr>
                    <td>{{ $inquiry->name }}</td>
                    <td>{{ $inquiry->email }}</td>
                    <td>{{ $inquiry->message }}</td>
                    <td>
                        <form action="{{ route('agent.inquiries.destroy', $inquiry->id) }}" method="POST"
                            style="display:inline;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Delete inquiry?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
