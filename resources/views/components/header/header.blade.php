<header>
    <img class="brand-logo" src="/assets/shs_logo.png" alt="logo" aria-hidden="true" [routerLink]="['/']" />
    <nav>
        <ul class="nav-container">
            <li class="nav-btn" [routerLink]="['/kanban']" routerLinkActive="active-link">
                link 1
            </li>
            <li class="nav-btn" [routerLink]="['/calendar']" routerLinkActive="active-link">
                link 2
            </li>
        </ul>
    </nav>
    <div [ngClass]="{'hidden' : isDesktopView}" id="menu-btn-container" (click)="toggleSidebar()">
        <img [src]="moreButtonImagePath" alt="Menu">
    </div>
</header>
