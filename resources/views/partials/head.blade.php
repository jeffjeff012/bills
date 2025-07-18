<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? config('app.name') }}</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-some-integrity-code" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    integrity="sha512-ZwO7OYfLmB4zJhUeW7+ZFALD/El2tFOJPZPZhwhPfq5HCe1ChWhvL1zWd0WW8boMdZFLkRu8c6HFfFEOOjMZjA=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
/>
<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance
