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
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cards.index') }}">Cards</a>
                </li>
                <li>
                    <a class="nav-link active" href="{{ route('sets.index') }}">Sets</a>
                </li>
            </ul>
        </div>
    </nav>
    
    <div class="container">
        <form method="GET" action="{{ route('sets.index') }}" id="formSearch">
            <input type="hidden" name="page" id="pageNo" value="{{ $page }}">
            <div class="form-inline my-2 my-lg-0">
                <input name="name" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" value="{{ Request::get('name') }}">
                <button class="btn btn-success my-2 my-sm-0" type="submit" id="btnSearch">Search</button>
            </div>
        </form>
        <h2>Sets Collection</h2>
        @if(count($data) > 0)
            <div class="row">
                @foreach($data as $item)
                    <div class="col-12 mb-3">
                        <div class="card">
                            <div class="card-horizontal">
                                <div class="img-square-wrapper">
                                    <img class="card-img-left" src="{{ $item['images']['logo'] }}" alt="{{ $item['name'].'-logo' }}">
                                </div>
                                <div class="card-body">
                                    <p class="card-text"> <strong>Name:</strong> {{ $item['name'] }} </p>
                                    <p class="card-text"> <strong>Series:</strong> {{ $item['series'] }} </p>
                                    <p class="card-text"> <strong>Total printed:</strong> {{ $item['printedTotal'] }} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                </div>
                <!-- <div>
                    <ul class="pagination">
                        @if($page != 1)
                            <li class="page-item">
                                <a class="page-link" href="{{ url('/sets?page='.$page-1) }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>

                            <li class="page-item"><a class="page-link" href="{{ url('/sets?page='.$page-1) }}">{{ $page-1 }}</a></li>
                        @endif
                        
                        <li class="page-item active"><a class="page-link" href=""> {{ $page }} </a></li>

                        @if($page != $pages)
                            <li class="page-item"><a class="page-link" href="{{ url('/sets?page='.$page+1) }}">{{ $page+1 }}</a></li>
                            <li class="page-item">
                                <a class="page-link" href="{{ url('/sets?page='.$page+1) }}" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div> -->
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
            </div>
        @else
            <h4>Set not found</h4>
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