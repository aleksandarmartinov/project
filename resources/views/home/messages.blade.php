@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-2 py-5">
            <a href="{{ route('home') }}" class="btn btn-dark form-control py-2">Back to your profile</a>
        </div>
        <div class="col-10">
             <h2 class="text-center">Sve Poruke</h2>
             @if(count($messages) > 0)
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
                        <td>
                            <form action="{{ route('deleteMessage', ['id'=>$message->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-small btn-danger float-end" onclick="return confirm('Are you sure you want to delete this message?')">Obrisi</button>
                        </form>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="alert alert-info">
                You don't have any messages.
            </div>
            @endif
        </div>
    </div>
</div>
@endsection