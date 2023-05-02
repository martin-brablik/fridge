<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title>Lednice</title>
</head>
<body>
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <form class="container-sm" action="/edit_submit/{{ $item->id }}" method="post">
            @csrf
            <h2>Upravit potravinu</h2>
            <div class="form-group mb-3">
                <label for="name">Název potraviny</label>
                <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $item->name) }}">
            </div>
            <div class="form-group mb-3">
                <label for="dv">Datum výroby</label>
                <input class="form-control" type="date" name="dv" id="dv" value="{{ old('name', $item->dv) }}">
            </div>
            <div class="form-group mb-3">
                <label for="dn">Datum nákupu</label>
                <input class="form-control" type="date" name="dn" id="dn" value="{{ old('name', $item->dn) }}">
            </div>
            <div class="form-group mb-3">
                <label for="dmt">Datum minimální trvanlivosti</label>
                <input class="form-control" type="date" name="dmt" id="dmt" value="{{ old('name', $item->dmt) }}">
            </div>
            <div class="form-group mb-3">
                <label for="ds">Datum spotřeby</label>
                <input class="form-control" type="date" name="ds" id="ds" value="{{ old('name', $item->ds) }}">
            </div>
            <button class="btn btn-primary" type="submit">Upravit</button>
        </form>
    </div>
</body>
</html>