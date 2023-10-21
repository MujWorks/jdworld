<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JD World</title>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
     <link rel="icon" type="image/x-icon" href="{{asset('assets/images/logo.webp')}}">
     <meta property="og:image" itemprop="image" content="{{asset('assets/images/logo.webp')}}">
    
    @include('include.header_link')

    <script type="text/javascript">
        var base_url="{!! env('APP_URL') !!}";
    </script>
</head>