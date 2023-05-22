<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Ponto - Funcionários</title>
</head>
<body>
    <header>
        <div class="logo">
            <img src="{{ asset('images/logo-icon.png') }}" alt="">
            <h1>PONT<span>O</span> ETECIA</h1>
        </div>
    </header>

    <div class="container">
        <x-menu />

        <main>
            <h2>Funcionários</h2>

            <div class="mission-stats">
    
                <div class="mission-stat">
                    <div class="mission-stat-icon verde">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="mission-stat-number">
                        10
                    </div>
                    <span>funcionários ativos</span>
                </div>
                <div class="mission-stat">
                    <div class="mission-stat-icon laranja">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="mission-stat-number">
                        10
                    </div>
                    <span>funcionários inativos</span>
                </div>
                <div class="mission-stat">
                    <div class="mission-stat-icon azul">
                        <i class="fa-solid fa-user-clock"></i>
                    </div>
                    <div class="mission-stat-number">
                        10
                    </div>
                    <span>funcionários presentes</span>
                </div>
                <div class="mission-stat">
                    <div class="mission-stat-icon">
                        <i class="fa-solid fa-user-group"></i>
                    </div>
                    <div class="mission-stat-number">
                        10
                    </div>
                    <span>total de funcionários</span>
                </div>
            </div>

            <div class="toolbar">
                <div class="field">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <label for="search" class="hide">Search</label>
                    <input type="search" name="search" id="search" placeholder="procurar...">
                </div>
                <a class="button" href="{{ route('funcionarios.create') }}">
                    <i class="fa-solid fa-user-plus"></i>
                    novo funcionário
                </a>
            </div>

            <ul class="crud-list">
                @foreach ($funcionarios as $funcionario)
                    <li class="crud-item">
                        <div class="crud-data">
                            <div class="crud-title">
                                <div class="avatar">
                                    <img src="{{ $funcionario->foto }}"
                                        onerror="this.onerror=null;this.src='{{ asset('images/avatar.png') }}'">
                                </div>
                                {{ $funcionario->nome }}
                            </div>
                        </div>
                        <div class="crud-actions">
                            <a class="button icon warning" href="{{ route('funcionarios.edit', $funcionario->id) }}">
                                <i class="fa-solid fa-user-pen"></i>
                            </a>
                            <form action="{{ route('funcionarios.destroy', $funcionario->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="button icon danger">
                                    <i class="fa-solid fa-user-xmark"></i>
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
               
        </main>
    </div>
    <script src="{{ asset('js/search.js') }}" defer></script>
</body>
</html>