@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="assets/css/fancybox.min.css" />
@endpush
@section('content')
<livewire:employer.employer/>
@stop
