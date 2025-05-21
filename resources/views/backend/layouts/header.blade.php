<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 shadow">

    <!-- Bouton pour afficher/masquer la barre latérale -->
    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Bouton : Lien de stockage -->
    <a href="{{ route('storage.link') }}" class="btn btn-outline-warning btn-sm mr-3">
        Lien de stockage
    </a>

    <!-- Bouton : Vider le cache -->
    <a href="{{ route('cache.clear') }}" class="btn btn-outline-danger btn-sm mr-3">
        Vider le cache
    </a>

    <!-- Menu supérieur -->
    <ul class="navbar-nav ml-auto">

        <!-- Recherche (visible uniquement sur petit écran) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Formulaire de recherche -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Rechercher..."
                            aria-label="Recherche" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Lien vers la page d'accueil -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="{{ route('home') }}" target="_blank" data-toggle="tooltip"
                data-placement="bottom" title="Accueil" role="button">
                <i class="fas fa-home fa-fw"></i>
            </a>
        </li>

        <!-- Notifications -->
        <li class="nav-item dropdown no-arrow mx-1">
            @include('backend.notification.show')
        </li>

        <!-- Messages -->
        <li class="nav-item dropdown no-arrow mx-1" id="messageT" data-url="{{ route('messages.five') }}">
            @include('backend.message.message')
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Informations de l'utilisateur -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth()->user()->name }}</span>
                @if(Auth()->user()->photo)
                    <img class="img-profile rounded-circle" src="{{ Auth()->user()->photo }}">
                @else
                    <img class="img-profile rounded-circle" src="{{ asset('backend/img/avatar.png') }}">
                @endif
            </a>
            <!-- Menu déroulant de l'utilisateur -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('admin-profile') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profil
                </a>
                <a class="dropdown-item" href="{{ route('change.password.form') }}">
                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                    Modifier le mot de passe
                </a>
                <a class="dropdown-item" href="{{ route('settings') }}">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Paramètres
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Se déconnecter
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>

    </ul>

</nav>
