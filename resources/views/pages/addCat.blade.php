@extends('layouts.master')
@section('content')
    <script>
        $( document ).ready(function() {
            $('#title').html('Add a new cat to the family:');
        });
    </script>

    @include("layouts.catFields")

@endsection