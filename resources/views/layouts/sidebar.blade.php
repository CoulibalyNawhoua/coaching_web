<!-- ########## START: LEFT PANEL ########## -->
<div class="br-logo"><a href="#"><span>[</span>COACHING<span>]</span></a></div>
<div class="br-sideleft overflow-y-auto">
    <label class="sidebar-label pd-x-15 mg-t-20">Navigation</label>
    <div class="br-sideleft-menu">
        <a href="{{ route('dashboard') }}" class="br-menu-link {{ Request::is('dashboard') ? 'active': ''}}">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fa fa-home tx-20"></i>
                <span class="menu-item-label">Dashboard</span>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->

        <a href="javascript:void(0);" class="br-menu-link {{ Request::is('roles') || Request::is('users') ? 'active show-sub': ''}}">
            <div class="br-menu-item">
                <i class="menu-item-icon fa fa-users tx-20"></i>
                <span class="menu-item-label">Administrateurs</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('roles.index') }}" class="nav-link {{ Request::is('roles') ? 'active': ''}}">Rôles</a></li>
            <li class="nav-item"><a href="{{ route('users.index') }}" class="nav-link {{ Request::is('users') ? 'active': ''}}">Adminstrateurs</a></li>
        </ul>

        <a href="javascript:void(0);" class="br-menu-link {{ Request::is('categories_citations') || Request::is('citations/create') || Request::is('citations') ? 'active show-sub': ''}}">
            <div class="br-menu-item">
                <i class="menu-item-icon fa fa-quote-left tx-20"></i>
                <span class="menu-item-label">Gestion des Citations</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('categories_citations.index') }}" class="nav-link {{ Request::is('categories_citations') ? 'active': ''}}">Catégories-Citations</a></li>
            <li class="nav-item"><a href="{{ route('citations.create') }}" class="nav-link {{ Request::is('citations/create') ? 'active': ''}}">Ajouter-Citations</a></li>
            <li class="nav-item"><a href="{{ route('citations.index') }}" class="nav-link  {{ Request::is('citations') ? 'active': ''}}">Liste-Citations</a></li>
        </ul>

        <a href="javascript:void(0);" class="br-menu-link {{ Request::is('evenements/create') || Request::is('evenements') ? 'active show-sub': ''}}">
            <div class="br-menu-item">
                <i class="menu-item-icon fa fa-calendar tx-20"></i>
                <span class="menu-item-label">Gestion des évènements</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('evenements.create') }}" class="nav-link {{ Request::is('evenements/create') ? 'active': ''}}">Ajouter-Événement</a></li>
            <li class="nav-item"><a href="{{ route('evenements.index') }}" class="nav-link {{ Request::is('evenements') ? 'active': ''}}">Liste-Événement</a></li>

        </ul>

        <a href="javascript:void(0);" class="br-menu-link {{ Request::is('tickets') || Request::is('tickets/create') ? 'active show-sub': ''}}">
            <div class="br-menu-item">
                <i class="menu-item-icon fa fa-ticket tx-20"></i>
                <span class="menu-item-label">Gestion des Tickets</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('tickets.create') }}" class="nav-link {{ Request::is('tickets/create') ? 'active': ''}}">Créer-Tickets</a></li>
            <li class="nav-item"><a href="{{ route('tickets.index') }}" class="nav-link {{ Request::is('tickets') ? 'active': ''}}">Liste des tickets</a></li>
            {{-- <li class="nav-item"><a href="{{ route('categories_tickets.index') }}" class="nav-link">Catégories Tickets</a></li> --}}
                    
        </ul>

        <a href="javascript:void(0);" class="br-menu-link {{ Request::is('categories_abonnements') || Request::is('periodes_abonnements') || Request::is('offres_abonnements') || Request::is('abonnements/create') || Request::is('abonnements') ? 'active show-sub': ''}}">
            <div class="br-menu-item">
                <i class="menu-item-icon fa fa-bookmark tx-20"></i>
                <span class="menu-item-label">Abonnements</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('categories_abonnements.index') }}" class="nav-link {{ Request::is('categories_abonnements') ? 'active': ''}}">Types Abonnement</a></li>
            <li class="nav-item"><a href="{{ route('periodes_abonnements.index') }}" class="nav-link {{ Request::is('periodes_abonnements') ? 'active': ''}}">Périodes Abonnement</a></li>
            <li class="nav-item"><a href="{{ route('offres_abonnements.index') }}" class="nav-link {{ Request::is('offres_abonnements') ? 'active': ''}}">Offres Abonnement</a></li>
            <li class="nav-item"><a href="{{ route('abonnements.create') }}" class="nav-link {{ Request::is('abonnements/create') ? 'active': ''}}">Créer Abonnement</a></li>
            <li class="nav-item"><a href="{{ route('abonnements.index') }}" class="nav-link {{ Request::is('abonnements') ? 'active': ''}}">Liste Abonnements</a></li>
        </ul>
        <a href="{{ route('liste.inscrits') }}" class="br-menu-link {{ Request::is('liste-inscrits') ? 'active': ''}}">
            <div class="br-menu-item">
                <i class="menu-item-icon fa fa-bars tx-20"></i>
                <span class="menu-item-label">Liste des utilisateurs</span>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->

        <a href="{{ route('liste.abonnees') }}" class="br-menu-link {{ Request::is('liste-abonnees') ? 'active': ''}}">
            <div class="br-menu-item">
                <i class="menu-item-icon fa fa-bars tx-20"></i>
                <span class="menu-item-label">Liste des Abonnées</span>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->

        <a href="{{ route('liste.paiements') }}" class="br-menu-link {{ Request::is('liste-paiements') ? 'active': ''}}">
            <div class="br-menu-item">
                <i class="menu-item-icon fa fa-bars tx-20"></i>
                <span class="menu-item-label">Liste des Souscriptions</span>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->

        <a href="{{ route('liste.ticket.vendu') }}" class="br-menu-link {{ Request::is('liste-ticket-vendus') ? 'active': ''}}">
            <div class="br-menu-item">
                <i class="menu-item-icon fa fa-bars tx-20"></i>
                <span class="menu-item-label">Liste des tickets vendus</span>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->

    </div><!-- br-sideleft-menu -->


    <br>
</div><!-- br-sideleft -->
<!-- ########## END: LEFT PANEL ########## -->

<!-- ########## START: HEAD PANEL ########## -->
<div class="br-header">
    <div class="br-header-left">
        <div class="navicon-left hidden-md-down">
            <a id="btnLeftMenu" href="#">
                <i class="icon ion-navicon-round"></i>
            </a>
        </div>
        <div class="navicon-left hidden-lg-up">
            <a id="btnLeftMenuMobile" href="#">
                <i class="icon ion-navicon-round"></i>
            </a>
        </div>
                    
    </div><!-- br-header-left -->
    <div class="br-header-right">
        <nav class="nav">
            <div class="dropdown">
                <a href="#" class="nav-link nav-link-profile" data-toggle="dropdown">
                    <span class="logged-name hidden-md-down">{{ Auth::user()->last_name }}</span>
                    @if (auth()->user()->avatar_url)
                        <img class="wd-32 rounded-circle" src="{{ Storage::url(auth()->user()->avatar_url) }}"
                            alt="user" />
                    @else
                        <img class="wd-32 rounded-circle" src="{{ asset('assets/img/img1.jpg') }}" alt="#">
                    @endif
                    {{-- <img src="{{ asset('assets/img/img1.jpg') }}" class="wd-32 rounded-circle" alt=""> --}}
                    <span class="square-10 bg-success"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-header wd-200">
                    <ul class="list-unstyled user-profile-nav">
                        <li><a href="{{ route('profile.edit') }}"><i class="icon ion-ios-person"></i> Profil</a></li>
                        
                        {{-- <li><a href="#"><i class="icon ion-ios-gear"></i> Settings</a></li>
                        <li><a href="#"><i class="icon ion-ios-download"></i> Downloads</a></li>
                        <li><a href="#"><i class="icon ion-ios-star"></i> Favorites</a></li>
                        <li><a href="#"><i class="icon ion-ios-folder"></i> Collections</a></li> --}}
                        {{-- <li><a href="#"><i class="icon ion-power"></i> Sign Out</a></li> --}}

                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    this.closest('form').submit();"><i class="icon ion-power" data-feather="log-in"> </i> Déconnexion
                                </a>
                            </form>
                        </li>
                    </ul>
                </div><!-- dropdown-menu -->
            </div><!-- dropdown -->
        </nav>
        <div class="navicon-right">

        </div><!-- navicon-right -->
    </div><!-- br-header-right -->
</div><!-- br-header -->
