@extends('_layouts.master')

@push('meta')
    <meta property="og:title" content="About {{ $page->siteName }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ $page->getUrl() }}"/>
    <meta property="og:description" content="A little bit about {{ $page->siteName }}" />
@endpush

@section('body')
    <h1>About</h1>

    <img src="/assets/img/about.png"
        alt="About image"
        class="flex rounded-full h-64 w-64 bg-contain mx-auto md:float-right my-6 md:ml-10">

    <p class="mb-6">Hey there. I'm Phil Betley. I'm a web developer by trade, and you can find a lot of my thoughts on web and app development on this site.</p>

    <p class="mb-6">In my spare time, I volunteer as a Scoutmaster of Troop 285, in the Del-Mar-Va Council, where I was also a scout as a kid.</p>

    <p class="mb-6">I'm also a huge fan of Dungeons and Dragons, and play a regular weekly game with a group of college buddies.</p>
@endsection
