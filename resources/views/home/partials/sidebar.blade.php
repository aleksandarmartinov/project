<a href="{{ route('home') }}" class="btn btn-dark form-control m-2">Svi Vasi Oglasi</a>
<a href="{{ route('home.addDeposit') }}" class="btn btn-secondary form-control m-2">
    Dodajte Deposit <span class="badge bg-success">{{ (Auth::user()->deposit) ? Auth::user()->deposit : 0 }} rsd</span>
</a>
<a href="{{ route('home.messages') }}" class="btn btn-info form-control m-2">Messages
<span>{{ Auth::user()->receivedMessages->count() }}</span> </a>
<a href="{{ route('home.adForm') }}" class="btn btn-primary form-control m-2">New Add</a>
