@extends('_layouts.master')

@push('meta')
    <meta property="og:title" content="Contact {{ $page->siteName }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ $page->getUrl() }}"/>
    <meta property="og:description" content="Get in touch with {{ $page->siteName }}" />
@endpush

@section('body')
<h1>Contact</h1>

<p class="mb-8">If you'd like to get in contact with me, you can email me at <a href="mailto:webmaster@jpbetley.com">webmaster@jpbetley.com</a>.</p>

<p class="mb-8">
    You may also be interested in my:
    <ul>
        <li><a href="https://github.com/JPBetley">Github</a></li>
        <li><a href="https://twitter.com/jpbetley">Twitter</a></li>
    </ul>
</p>

@stop
