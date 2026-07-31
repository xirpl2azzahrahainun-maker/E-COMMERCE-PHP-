<style>
    .sidebar {
        width: 240px;
        height: 100vh;
        background: #1e40af; 
        color: white;
        position: fixed;
        top: 0;
        left: 0;
        padding: 25px 15px;
        box-shadow: 4px 0 10px rgba(0, 0, 0, 0.05);
        z-index: 1000;
        display: flex;
        flex-direction: column;
    }

    .sidebar-header {
        text-align: left;
        margin-bottom: 35px;
        padding: 0 10px;
    }

    .sidebar-header h4 {
        margin: 0;
        font-weight: 700;
        font-size: 1.5rem;
    }

    .sidebar-header hr {
        border-color: rgba(255, 255, 255, 0.1);
        margin-top: 15px;
    }

    .nav-menu {
        list-style: none;
        padding: 0;
        margin: 0;
        flex-grow: 1;
    }

    .nav-item {
        margin-bottom: 8px;
    }

    .nav-link {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px 20px;
        color: #ffffff;
        text-decoration: none;
        border-radius: 12px;
        transition: all 0.3s ease;
        font-weight: 500;
        font-size: 1.1rem;
    }

    .nav-link i {
        font-size: 1.3rem;
    }

    .nav-link:hover, 
    .nav-link.active {
        background: rgba(255, 255, 255, 0.15); 
        color: white;
    }

    .user-section-sidebar {
        padding-top: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: auto;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        background: #3b82f6;
        border-radius: 10px;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        flex-shrink: 0;
    }

    .logout-btn {
        background: #ef4444;
        border: none;
        padding: 3px 10px;
        color: white;
        border-radius: 6px;
        font-size: 0.75rem;
        cursor: pointer;
        font-weight: 600;
    }
</style>

<div class="sidebar">
    <div class="sidebar-header">
        <h4>Admin Panel</h4>
        <hr>
    </div>
    
    <ul class="nav-menu">
        <li class="nav-item">
            <a href="{{ route('Admin.dashboard') }}" class="nav-link {{ request()->routeIs('Admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a href="{{ route('product.index') }}" class="nav-link {{ request()->routeIs('product.*') ? 'active' : '' }}">
                <i class="bi bi-bag-check"></i>
                <span>Products</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a href="{{ route('Admin.Orders.index') }}" class="nav-link {{ request()->routeIs('Admin.Orders.index') ? 'active' : '' }}">
                <i class="bi bi-cart"></i>
                <span>Orders</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a href="{{ route('Admin.sales') }}" class="nav-link {{ request()->routeIs('Admin.sales') ? 'active' : '' }}">
                <i class="bi bi-receipt"></i>
                <span>Sales Reports</span>
            </a>
        </li>
    </ul>

    <div class="user-section-sidebar">
        <div class="user-avatar">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
        <div>
            <strong style="display: block; font-size: 13px; color: white;">{{ Auth::user()->name }}</strong>
            <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>
</div>