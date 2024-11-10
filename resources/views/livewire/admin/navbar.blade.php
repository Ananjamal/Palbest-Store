<nav class="flex-row p-0 navbar default-layout-navbar col-lg-12 col-12 fixed-top d-flex">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <a class="navbar-brand brand-logo" href="{{ route('/') }}">
            <img src="{{ asset('assets/website/img/logo.png') }}" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('/') }}">
            <img src="{{ asset('assets/admin/images/logo-mini.svg') }}" alt="logo" />
        </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <div class="search-field d-none d-md-block">
            <form class="d-flex align-items-center h-100" wire:submit.prevent="loadProducts">
                <div class="input-group">
                    <div class="bg-transparent input-group-prepend">
                        <i class="border-0 input-group-text mdi mdi-magnify"></i>
                    </div>
                    <input type="text" class="bg-transparent border-0 form-control"
                           placeholder="Search Products"
                           wire:model="searchTerm"
                           wire:keyup="loadProducts">
                </div>
            </form>
            {{-- <ul class="mt-2 list-group" style="position: absolute; z-index: 1000;">
                @forelse($results as $result)
                    <li class="list-group-item">
                        {{ $result->name }}
                    </li>
                @empty
                    @if(trim($searchTerm) !== '')
                        <li class="list-group-item text-muted">No results found</li>
                    @endif
                @endforelse
            </ul> --}}
        </div>

        <ul class="navbar-nav navbar-nav-right">

            <li class="nav-item d-none d-lg-block full-screen-link">
                <a class="nav-link">
                    <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-email-outline"></i>
                    <span class="count-symbol bg-warning"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                    <h6 class="p-3 mb-0 text-dark">Messages</h6>
                    <div class="dropdown-divider"></div>
                
                    {{-- Loop through contacts and display messages --}}
                    @foreach ($contacts as $contact)
                        <a href="{{route('admin.messages')}}"  class="py-3 dropdown-item preview-item d-flex align-items-center">
                            <div class="preview-thumbnail me-3">
                                {{-- Use the user's profile picture, or a default image if not available --}}
                               @if (!$contact->user->image)
                               <img src="{{ asset('assets/admin/images/face.png') }}" 
                                    alt="image" class="profile-pic rounded-circle">
                               @else
                               <img src="{{ asset(Storage::url($contact->user->image) ) }}" 
                                    alt="image" class="profile-pic rounded-circle">
                               @endif
                                
                            </div>
                            <div class="preview-item-content d-flex flex-column">
                                <h6 class="mb-1 preview-subject font-weight-semibold text-dark">{{ $contact->name }} sent you a message</h6>
                                <p class="mb-0 text-muted small">{{ $contact->created_at->diffForHumans() }}</p>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                    @endforeach
                
                    {{-- Footer --}}
                    <h6 class="p-3 mb-0 text-center text-muted small">{{ $contacts->count() }} new messages</h6>
                </div>
                
            </li>
            {{-- <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                    data-bs-toggle="dropdown">
                    <i class="mdi mdi-bell-outline"></i>
                    <span class="count-symbol bg-danger"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list"
                    aria-labelledby="notificationDropdown">
                    <h6 class="p-3 mb-0">Notifications</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-success">
                                <i class="mdi mdi-calendar"></i>
                            </div>
                        </div>
                        <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                            <h6 class="mb-1 preview-subject font-weight-normal">Event today</h6>
                            <p class="mb-0 text-gray ellipsis"> Just a reminder that you have an event today </p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-warning">
                                <i class="mdi mdi-cog"></i>
                            </div>
                        </div>
                        <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                            <h6 class="mb-1 preview-subject font-weight-normal">Settings</h6>
                            <p class="mb-0 text-gray ellipsis"> Update dashboard </p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-info">
                                <i class="mdi mdi-link-variant"></i>
                            </div>
                        </div>
                        <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                            <h6 class="mb-1 preview-subject font-weight-normal">Launch Admin</h6>
                            <p class="mb-0 text-gray ellipsis"> New admin wow! </p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <h6 class="p-3 mb-0 text-center">See all notifications</h6>
                </div>
            </li> --}}
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <div class="nav-profile-img">
                        <img src="{{ Storage::url($user->image) }}" alt="image">
                        <span class="availability-status online"></span>
                    </div>
                    <div class="nav-profile-text">
                        <p class="mb-1 text-black">{{$user->name}}</p>
                    </div>
                </a>
                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="mdi mdi-cached me-2 text-success"></i> Profile </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                this.closest('form').submit();">
                            <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
                    </form>
                </div>
            </li>
            {{-- <li class="nav-item nav-logout d-none d-lg-block">
                <a class="nav-link" href="#">
                    <i class="mdi mdi-power"></i>
                </a>
            </li>
            <li class="nav-item nav-settings d-none d-lg-block">
                <a class="nav-link" href="#">
                    <i class="mdi mdi-format-line-spacing"></i>
                </a>
            </li> --}}
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
