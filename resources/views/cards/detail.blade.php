<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/site.css">
    <title>Pokemon TCG</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
        <a class="navbar-brand" href="{{ route('cards.index') }}">Pokemon TCG</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('cards.index') }}">Cards</a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('sets.index') }}">Sets</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div id="details" class="row justify-content-center">
            <div class="col-sm-12 col-md-6 col-lg-4">
                <img style="height:400px;" src="{{ $data['images']['large'] }}" alt="{{ $data['name'] }} card">
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <h2> {{ $data['name']}} <a href="{{ url('/?supertypes='.$data['supertype']) }}" class="btn btn-secondary btn-sm"> {{ $data['supertype'] }} </a> </h2>
                
                <span class="text-muted">{{ $data['set']['name'] }} #{{ $data['number'] }} </span> <br>

                <div class="center mt-3">
                    @foreach($data['types'] as $type)
                        <a href="{{ url('/?types='.$type) }}" class="btn btn-sm type-{{ $type }} text-white"> {{ $type }} </a>
                    @endforeach
                </div>

                <hr>
                <table class="table table-borderless table-sm">
                    <tbody>
                        <tr>
                            <td>Artist</td>
                            <td> : {{ $data['artist'] }}</td>
                        </tr>
                        <tr>
                            <td>Rarity</td>
                            <td> : <a href="{{ url('/?rarities='.$data['rarity']) }}">{{ $data['rarity'] }} </a></td>
                        </tr>
                        <tr>
                            <td>Total printed</td>
                            <td> : {{ $data['set']['printedTotal'] }}</td>
                        </tr>
                        <tr>
                            <td>Released on</td>
                            <td> : {{ $data['set']['releaseDate'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <h4>Pricelist</h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th>Type</th>
                                <th>Low</th>
                                <th>Mid</th>
                                <th>High</th>
                                <th>Market</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['tcgplayer']['prices'] as $item => $price)
                                <tr class="text-right">
                                    <td class="text-left"> {{ $item }} </td>
                                    <td> ${{ $price['low'] }} </td>
                                    <td> ${{ $price['mid'] }} </td>
                                    <td> ${{ $price['high'] }} </td>
                                    <td> ${{ $price['market'] }} </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-right text-muted">Last updated on {{ $data['tcgplayer']['updatedAt'] }}</div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>