<div class="list-group mb-2">
    <a href="{{ route('account.show') }}" class="list-group-item list-group-item-action @if(Route::currentRouteName() == 'account.show') active @endif" aria-current="true">
      Akun Saya
    </a>
    <a href="{{ route('transactions.index') }}" class="list-group-item list-group-item-action @if(Route::currentRouteName() == 'transactions.index' || Route::currentRouteName() == 'transactions.show') active @endif">
        Pesanan
    </a>
    <a href="{{ route('logout') }}" class="list-group-item list-group-item-action" onclick="event.preventDefault(); confirm('Apakah yakin ingin keluar?');
    document.getElementById('logout-form').submit();">
      Logout
    </a>
    <form method="post" action="{{ route('logout') }}" class="d-none" id="logout-form">
      @csrf
    </form>
</div>