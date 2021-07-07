<div class="list-group mb-2">
    <a href="{{ route('account.show') }}" class="list-group-item list-group-item-action @if(Route::currentRouteName() == 'account.show') active @endif" aria-current="true">
      Account
    </a>
    <a href="{{ route('transactions.index') }}" class="list-group-item list-group-item-action @if(Route::currentRouteName() == 'transactions.index') active @endif">
        My Order
    </a>
</div>