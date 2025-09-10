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
<link rel="icon" href="/images/final.png" sizes="any">
<link rel="icon" href="/images/final.png" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.9.1/summernote.min.js" integrity="sha512-07bR+AJ2enmNU5RDrZkqMfVq06mQHgFxcmWN/hNSNY4E5SgYNOmTVqo/HCzrSxBhWU8mx3WB3ZJOixA9cRnCdA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.9.1/summernote-bs5.min.css" integrity="sha512-rDHV59PgRefDUbMm2lSjvf0ZhXZy3wgROFyao0JxZPGho3oOuWejq/ELx0FOZJpgaE5QovVtRN65Y3rrb7JhdQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance
