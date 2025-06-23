@extends('layouts.app')

@section('content')
    <h1>Dashboard Analytics</h1>

    <ul>
        <li>Total Properties: {{ $stats['total_properties'] }}</li>
        <li>New This Week: {{ $stats['new_properties'] }}</li>
        <li>Total Users: {{ $stats['total_users'] }}</li>
        <li>Total Agents: {{ $stats['agents'] }}</li>
        <li>Inquiries Today: {{ $stats['inquiries_today'] }}</li>
    </ul>

    <h3>Top Cities</h3>
    <ul>
        @foreach ($stats['properties_by_city'] as $row)
            <li>{{ $row->city }}: {{ $row->count }} properties</li>
        @endforeach
    </ul>
@endsection
