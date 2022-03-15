<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>委员会</title>
    </head>
    <body>
        @foreach ($committees as $committee)
            <p>
                委员会：{{$committee->committee}}<br />
                议题：{{$committee->topic}}
            </p>
        @endforeach
    </body>
</html>
