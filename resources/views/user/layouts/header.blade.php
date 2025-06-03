<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

  <!-- Bouton de bascule de la barre latérale (Topbar) -->
  <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
    <i class="fa fa-bars text-dark"></i>
  </button>

  <!-- Barre de recherche supérieure -->
  <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    <div class="input-group">
      <input type="text" class="form-control bg-light border-0 small" placeholder="Rechercher..." aria-label="Recherche" aria-describedby="basic-addon2">
      <div class="input-group-append">
        <button class="btn btn-dark" type="button">
          <i class="fas fa-search fa-sm"></i>
        </button>
      </div>
    </div>
  </form>

  <!-- Barre de navigation supérieure -->
  <ul class="navbar-nav ml-auto">

    <!-- Élément - Recherche déroulante (visible uniquement sur petits écrans) -->
    <li class="nav-item dropdown no-arrow d-sm-none">
      <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-search fa-fw"></i>
      </a>
      <!-- Menu déroulant - Messages -->
      <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
        <form class="form-inline mr-auto w-100 navbar-search">
          <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Rechercher..." aria-label="Recherche" aria-describedby="basic-addon2">
            <div class="input-group-append">
              <button class="btn btn-primary" type="button">
                <i class="fas fa-search fa-sm"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </li>

    {{-- Page d'accueil --}}
    <li class="nav-item dropdown no-arrow mx-1">
      <a class="nav-link dropdown-toggle" href="{{route('home')}}" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Accueil" role="button">
        <i class="fas fa-home text-dark fa-fw"></i>
      </a>
    </li>

    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Élément - Informations utilisateur -->
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-dark small">{{Auth()->user()->name}}</span>
        @if(Auth()->user()->photo)
          <img class="img-profile rounded-circle" src="{{Auth()->user()->photo}}">
        @else
          <img class="img-profile rounded-circle" src="{{asset('backend/img/avatar.png')}}">
        @endif
      </a>
      <!-- Menu déroulant - Informations utilisateur -->
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="{{route('user-profile')}}">
          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
          Profil
        </a>
        <a class="dropdown-item" href="{{route('user.change.password.form')}}">
          <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
          Modifier le mot de passe
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> {{ __('Déconnexion') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </div>
    </li>

  </ul>

</nav>
