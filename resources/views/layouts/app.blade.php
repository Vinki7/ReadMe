<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csfr-token" content="{{ csrf_token() }}">
        <title>@yield('title') | {{ config('app.name', 'Laravel')}}</title>

        @vite(['resources/css/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        <x-header></x-header>
        <main>
            <div *ngIf="isSidebarVisible && !isDesktopView" [ngClass]="{'visible':isSidebarVisible}" class="overlay" (click)="toggleSidebar()"></div>
            <nav [ngClass]="{'hidden': !isSidebarVisible}" class="sidebar col-3">
                <ul class="sidenav-container">
                    <li class="nav-btn" [routerLink]="['/kanban']" routerLinkActive="active-link">
                        <img sizes="2rem" [src]="kanbanImagePath" alt="Kanban">
                    </li>
                    <li class="nav-btn" [routerLink]="['/calendar']" routerLinkActive="active-link">
                        <img [src]="calendarImagePath" alt="Calendar">
                    </li>
                </ul>
                <p class="anotation">
                    Demo project
                    authored by S. V., 2024
                </p>
            </nav>
            <article class="app-content">
                @yield('content')
            </article>
        </main>
        <footer>Page footer Here!!!</footer>
    </body>
</html>
