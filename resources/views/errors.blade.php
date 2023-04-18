<div class="container">
    @if ($message = Session::get('error'))
    <div class="alert alert-danger">	
            <strong>{{ $message }}</strong>
    </div>
    @endif
    
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
            <strong>{{ $message }}</strong>
    </div>
    @endif
    
    
    @if ($message = Session::get('warning'))
    <div class="alert alert-warning">
        <strong>{{ $message }}</strong>
    </div>
    @endif
    
    
    @if ($message = Session::get('info'))
    <div class="alert alert-info" role="alert">
            <strong>{{ $message }}</strong>
    </div>
    @endif
</div>

