@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 py-5">
            Back dugme
        </div>
        <div class="col-9">
             <h2 class="text-center py-1">Sve Poruke</h2>
             <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Sender</th>
                        <th>Oglas</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($messages as $message)
                    <tr style="cursor: pointer; cursor: hand; text-decoration: none;" onclick="window.location='{{ route('showMessage', ['id'=>$message->id]) }}';" onmouseover="this.style.textDecoration='underline';" onmouseout="this.style.textDecoration='none';">
                        <td>{{ $message->sender->name }}</td>
                        <td>{{ $message->ad->title }}</td>
                        <td>{{ substr($message->text, 0, 20) }} {{ strlen($message->text) > 20 ? "..." : "" }}</td>
                        <td>{{ $message->created_at->format('m/d/Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
</div>
@endsection