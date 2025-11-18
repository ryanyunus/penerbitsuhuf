@extends('layouts.frontend')

@section('content')
<h3>Hasil pencarian: <b>{{ $query }}</b></h3>
@include('blog.partials.post-list')
@endsection
