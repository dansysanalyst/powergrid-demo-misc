@extends('layouts.base')

@section('title')
    {{ $title }}
@endsection

@section('description')
    {{ $description }}
@endsection

@section('main')
    <livewire:batch-export-table />
@endsection
