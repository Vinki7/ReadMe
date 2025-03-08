<header class="vw-100 p-4 d-flex justify-content-between align-items-center">
    <div class="p-3">
        <img src="{{ asset('images/logo.png') }}" alt="Logo"/>
    </div>
    <nav class="d-none d-lg-block">
        <ul class="navr">
            <li class="nav-item" [routerLink]="['/kanban']" routerLinkActive="active-link">
                link 1
            </li>
            <li class="nav-item" [routerLink]="['/calendar']" routerLinkActive="active-link">
                link 2
            </li>
        </ul>
    </nav>
    <x-chevron-button-component class="d-block d-lg-none" direction="right" onClick="toggleNavigation()"/>
</header>
<nav class="navigation d-none d-flex flex-column align-items-center">
    <ul class="nav d-flex flex-column align-items-center p-2">
        <li class="nav-item p-4" [routerLink]="['/kanban']" routerLinkActive="active-link">
            navigation 1
        </li>
        <li class="nav-item p-4" [routerLink]="['/calendar']" routerLinkActive="active-link">
            navigation 2
        </li>
    </ul>
</nav>
<script>
    function toggleNavigation() {
        const navigation = document.querySelector('.navigation');
        navigation.classList.toggle('d-none');
    }
</script>
