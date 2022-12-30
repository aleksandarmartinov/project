<div class="btn btn-success btn-static form-control m-2" style="pointer-events: none;">Deposit {{ (Auth::user()->deposit) ? Auth::user()->deposit : 0 }} rsd</div>
<a href="{{ route('home') }}" class="btn btn-secondary form-control m-2">All Ads</a>
<a href="{{ route('home.addDeposit') }}" class="btn btn-secondary form-control m-2">Add Deposit</a>
<a href="{{ route('home.showMessages') }}" class="btn btn-secondary form-control m-2">Messages
<span>{{ Auth::user()->messages->count() }}</span> </a>
<a href="{{ route('home.adForm') }}" class="btn btn-primary form-control m-2">New Add</a>