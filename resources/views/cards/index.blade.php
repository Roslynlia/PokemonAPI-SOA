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
        <h2>Cards Collection</h2>
        <form method="GET" action="{{ route('cards.index') }}" id="formSearch">
            <input type="hidden" name="page" id="pageNo" value="{{ $page }}">
            <div class="form-inline my-2 my-lg-0">
                <input name="name" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" value="{{ Request::get('name') }}">
                <button class="btn btn-primary mr-sm-2 my-2 my-sm-0" type="button" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter">Filter</button>
                <button class="btn btn-success my-2 my-sm-0" type="submit" id="btnSearch">Search</button>
            </div>
            <div class="row my-3">
                <div class="col-lg-3 col-md-6 col-sm-12 mb-2">
                    <div class="collapse multi-collapse" id="collapseFilter">
                        <select name="types" id="types" class="form-control">
                            <option value="-1">All types</option>
                            @foreach($types as $type)
                                <option value="{{ $type }}" {{ $type === Request::get('types') ? 'selected' : ''}}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-2">
                    <div class="collapse multi-collapse" id="collapseFilter">
                        <select name="subtypes" id="subtypes" class="form-control">
                            <option value="-1">All subtypes</option>
                            @foreach($subtypes as $subtype)
                                <option value="{{ $subtype }}" {{ $subtype === Request::get('subtypes') ? 'selected' : ''}}>{{ $subtype }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-2">
                    <div class="collapse multi-collapse" id="collapseFilter">
                        <select name="supertypes" id="supertypes" class="form-control">
                            <option value="-1">All supertypes</option>
                            @foreach($supertypes as $supertype)
                                <option value="{{ $supertype }}" {{ $supertype === Request::get('supertypes') ? 'selected' : ''}}>{{ $supertype }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-2">
                    <div class="collapse multi-collapse" id="collapseFilter">
                        <select name="rarities" id="rarities" class="form-control">
                            <option value="-1">All rarities</option>
                            @foreach($rarities as $rarity)
                                <option value="{{ $rarity }}" {{ $rarity === Request::get('rarities') ? 'selected' : ''}}>{{ $rarity }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </form>
        
        @if(count($data) > 0)
            <div class="row">
                @foreach($data as $item)
                    <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                        <a href="{{ route('card.detail', $item['id']) }}" style="color:black; text-decoration:none;">
                            <div class="card">
                                <img class="card-img-top" src="{{ $item['images']['small'] }}" alt="Card image">
                                <div class="card-body">
                                    <p class="card-text"> <strong>Set:</strong> {{ $item['set']['name'] }} </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
            <div>
                <ul class="pagination">
                    @if($page != 1)
                        <li class="page-item">
                            <a class="page-link" href="" onclick=changePage({{ $page-1 }}) aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>

                        <li class="page-item"><a class="page-link" href="" onclick=changePage({{ $page-1 }})> {{ $page-1 }} </a></li>
                    @endif
                    
                    <li class="page-item active"><a class="page-link" href=""> {{ $page }} </a></li>

                    @if($page != $pages)
                        <li class="page-item"><a class="page-link" href="" onclick=changePage({{ $page+1 }})> {{ $page+1 }} </a></li>
                        <li class="page-item">
                            <a class="page-link" href="" onclick=changePage({{ $page+1 }}) aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        @else
            <h4>Card not found</h4>
        @endif
    </div>

    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

<script>
    function changePage(page) {
        alert(page);
        document.getElementById('pageNo').value = page;
        document.getElementById('formSearch').submit();
    }
</script>