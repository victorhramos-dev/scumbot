@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        @if($message['level'] == 'error')
            <div class="alert alert-danger fade show p-1" role="alert">
                {!! $message['message'] !!}
            </div>

        @elseif($message['level'] == 'success')
            <div class="alert alert-success fade show p-1" role="alert">
                {!! $message['message'] !!}
            </div>

        @elseif($message['level'] == 'warning')
            <div class="alert alert-warning fade show p-1" role="alert">
                {!! $message['message'] !!}
            </div>

        @else
            <div class="alert alert-primary fade show p-1" role="alert">
                {!! $message['message'] !!}
            </div>
        @endif
    @endif
@endforeach

{{ session()->forget('flash_notification') }}