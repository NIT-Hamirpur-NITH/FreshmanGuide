<!DOCTYPE html>
<html>
<head>
    <title>Editable</title>
    <link rel="stylesheet" type="text/css" href="/assets/editor/content-tools.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/editor/editor.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

    <div data-editable data-name='content'>
        {!! $article->content !!}
    </div>

    <script src="/assets/libs/jquery.min.js" type="text/javascript"></script>
    <script src="/assets/editor/content-tools.min.js" type="text/javascript"></script>
    <script src="/assets/editor/editor.js" type="text/javascript"></script>
</body>
</html>