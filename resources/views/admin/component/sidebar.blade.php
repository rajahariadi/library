<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Amdash</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li class="menu-label">Data</li>
        <li>
            <a href="{{ route('kategori.index') }}" class="">
                <div class="parent-icon"><i class='bx bx-category'></i>
                </div>
                <div class="menu-title">Kategori</div>
            </a>
        </li>
        <li>
            <a href="{{ route('penerbit.index') }}" class="">
                <div class="parent-icon"><i class='bx bx-buildings'></i>
                </div>
                <div class="menu-title">Penerbit</div>
            </a>
        </li>
        <li>
            <a href="{{ route('rak.index') }}" class="">
                <div class="parent-icon"><i class='bx bx-cabinet'></i>
                </div>
                <div class="menu-title">Rak</div>
            </a>
        </li>
        <li>
            <a href="{{ route('member.index') }}" class="">
                <div class="parent-icon"><i class='bx bx-group'></i>
                </div>
                <div class="menu-title">Member</div>
            </a>
        </li>
        <li class="menu-label">Data Buku</li>
        <li>
            <a href="#" class="">
                <div class="parent-icon"><i class='bx bx-book'></i>
                </div>
                <div class="menu-title">Buku</div>
            </a>
        </li>
        <li>
            <a href="#" class="">
                <div class="parent-icon"><i class='bx bx-transfer'></i>
                </div>
                <div class="menu-title">Peminjaman</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
