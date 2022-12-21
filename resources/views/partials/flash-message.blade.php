@if ($message = Session::get('error'))
<div class="alert alert-warning">	
        <strong>{{ $message }}</strong>
</div>
@endif


