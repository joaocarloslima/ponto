<?php
$active = Route::currentRouteName();
$active = str_contains($active, 'inativos') ? 'inativos' : $active;
$active = str_contains($active, 'funcionarios') ? 'funcionarios' : $active;
?>

<nav class="side-menu">
    <ul>
        <a href="{{ route('funcionarios.index') }}">
            <li @if ($active == 'funcionarios') class="active" @endif>
                <div class="menu-item">
                    <i class="fa-solid fa-user"></i>
                    <span>Funcionários</span>
                </div>
            </li>
        </a>
        <a href="#">
            <li @if ($active == 'feriados') class="active" @endif>
                <div class="menu-item">
                    <i class="fa-solid fa-calendar"></i>
                    <span>Feriados</span>
                </div>
            </li>
        </a>
        <a href="#">
            <li @if ($active == 'registros') class="active" @endif>
                <div class="menu-item">
                    <i class="fa-solid fa-clock"></i>
                    <span>Registros</span>
                </div>
            </li>
        </a>
        <a href="#">
            <li @if ($active == 'relatorios') class="active" @endif>
                <div class="menu-item">
                    <i class="fa-solid fa-print"></i>
                    <span>Relatórios</span>
                </div>
            </li>
        </a>
        <a href="{{ route('funcionarios.inativos') }}">
            <li @if ($active == 'inativos') class="active" @endif>
                <div class="menu-item">
                    <i class="fa-solid fa-user-slash"></i>
                    <span>Inativos</span>
                </div>
            </li>
        </a>
    </ul>
</nav>