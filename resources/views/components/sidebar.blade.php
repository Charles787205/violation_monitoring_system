<aside class="aside is-placed-left is-expanded">
  <div class="aside-tools">
    <div>
      Traffic Violation Monitoring</b>
    </div>
  </div>
  <div class="menu is-menu-main">
    @if (!(Auth::check() && Auth::user()->role === 'client'))
    <p class="menu-label">General</p>
    <ul class="menu-list">
      <!-- Dashboard -->
      <li class="--set-active-index-html">
        <a href="/dashboard">
          <span class="icon"><span class="material-icons">dashboard</span></span>
          <span class="menu-item-label">Dashboard</span>
        </a>
      </li>
    </ul>
    @endif
    <p class="menu-label">Management</p>
    <ul class="menu-list">
      @if (Auth::check() && Auth::user()->role === 'admin')
      <!-- Vehicles -->
      <li>
        <a href="/vehicles">
          <span class="icon"><i class="mdi mdi-car"></i></span>
          <span class="menu-item-label">Vehicles</span>
        </a>
      </li>

      <!-- Violations -->
      <li>
        <a class="dropdown">
          <span class="icon"><i class="mdi mdi-alert-circle"></i></span>
          <span class="menu-item-label">Violations</span>
          <span class="icon"><i class="mdi mdi-plus"></i></span>
        </a>
        <ul>
          <li>
            <a href="{{ route('violations.index') }}">
              <span>All</span>
            </a>
          </li>
          <li>
            <a href="{{ route('violations.pending') }}">
              <span>Pending</span>
            </a>
          </li>
          <li>
            <a href="{{ route('violations.paid') }}">
              <span>Paid</span>
            </a>
          </li>
        </ul>
      </li>
      <li>
        <a href="{{ route('owner.approval') }}" class="sidebar-item">
          <span class="icon"><i class="mdi mdi-account-alert"></i></span>
          <span>Owner Approval</span>
        </a>
      </li>
      @elseif (Auth::check() && Auth::user()->role === 'client')
      <li>
        <a href="{{ route('client.my_vehicles') }}" class="sidebar-item">
          <span class="icon"><i class="mdi mdi-car"></i></span>
          <span>My Vehicles</span>
        </a>
      </li>
      <li>
        <a href="{{ route('client.my_violations') }}" class="sidebar-item">
          <span class="icon"><i class="mdi mdi-alert-circle"></i></span>
          <span>My Violations</span>
        </a>
      </li>
      @endif
    </ul>
  </div>
</aside>