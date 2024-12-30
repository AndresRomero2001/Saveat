@props(['name'])

@php
    $svgContent = file_get_contents(public_path("icons/{$name}.svg"));
@endphp

{!! $svgContent !!}
