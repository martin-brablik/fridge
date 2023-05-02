<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Lednice</title>
</head>
<body>
    <header class="mt-4 mb-4 d-flex flex-column justify-content-center align-items-center">
        <h2>Potraviny v lednici</h2>  
        <a class="btn btn-primary" href="/add">Přidat potravinu</a>
    </header>
    <section class="mt-4 d-flex justify-content-center align-items-center">
        <table class="table container-sm" action="/add" method="post">
            <thead>
                <tr>
                    <th scope="col">Název</th>
                    <th scope="col">Datum výroby</th>
                    <th scope="col">Datum nákupu</th>
                    <th scope="col">Datum minimální trvanlivosti</th>
                    <th scope="col">Datum spotřeby</th>
                    <th scope="col">Upravit</th>
                    <th scope="col">Smazat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr style="background-color:
                    @if(($item->ds ? $item->ds : $item->dmt) < date("Y-m-d"))
                        red
                    @elseif($item->ps < date("Y-m-d"))
                        orange
                    @endif
                    ;">
                        <td class="align-middle">{{ $item->name }}</td>
                        <td class="align-middle">{{ $item->dv }}</td>
                        <td class="align-middle">{{ $item->dn }}</td>
                        <td class="align-middle">{{ $item->dmt }}</td>
                        <td class="align-middle">{{ $item->ds }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('item.edit', $item->id) }}"><i class="bi bi-pencil-fill"></i></a>
                        </td>
                        <td>
                            <form action="{{ route('item.destroy', $item->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit"><i class="bi bi-trash-fill"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>