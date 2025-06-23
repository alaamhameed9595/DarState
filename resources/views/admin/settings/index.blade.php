@extends('layouts.app')

@section('content')
    <h1>Site Settings</h1>
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <label>Site Name</label>
        <input type="text" name="site_name" value="{{ $settings['site_name'] ?? '' }}">

        <label>Contact Email</label>
        <input type="email" name="contact_email" value="{{ $settings['contact_email'] ?? '' }}">

        <label>Default Currency</label>
        <input type="text" name="default_currency" value="{{ $settings['default_currency'] ?? '' }}">

        <button type="submit">Save</button>
    </form>
@endsection
