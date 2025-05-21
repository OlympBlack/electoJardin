<div id="notifications">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <!-- Compteur - Alertes -->
        <span class="badge badge-danger badge-counter">
            @if(count(Auth::user()->unreadNotifications) > 5)
                <span data-count="5" class="count">5+</span>
            @else 
                <span class="count" data-count="{{ count(Auth::user()->unreadNotifications) }}">{{ count(Auth::user()->unreadNotifications) }}</span>
            @endif
        </span>
    </a>
    <!-- Menu déroulant - Alertes -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header">
            Centre de notifications
        </h6>
        @foreach(Auth::user()->unreadNotifications as $notification)
            <a class="dropdown-item d-flex align-items-center" target="_blank" href="{{ route('admin.notification', $notification->id) }}">
                <div class="mr-3">
                    <div class="icon-circle bg-primary">
                        <i class="fas {{ $notification->data['fas'] }} text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">{{ $notification->created_at->format('d F Y h:i A') }}</div>
                    <span class="@if($notification->unread()) font-weight-bold @else small text-gray-500 @endif">{{ $notification->data['title'] }}</span>
                </div>
            </a>
            @if($loop->index + 1 == 5)
                @php 
                    break;
                @endphp
            @endif
        @endforeach

        <a class="dropdown-item text-center small text-gray-500" href="{{ route('all.notification') }}">Voir toutes les notifications</a>
    </div>
</div>
