<div>
  
  @foreach($users as $user)
  
  <div class="accordion" id="accordionExample{{ $user->id }}">
    <div class="card">
      <div class="card-header border-0" id="headingOne{{ $user->id }}">
        <h2 class="mb-0">
          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne{{ $user->id }}" aria-expanded="true" aria-controls="collapseOne{{ $user->id }}">
            {{ $user->contacts->name }}
          </button>
        </h2>
      </div>

      <div id="collapseOne{{ $user->id }}" class="collapse show" aria-labelledby="headingOne{{ $user->id }}" data-parent="#accordionExample{{ $user->id }}">
        <div class="card-body p-0">
        <x-UserInformation :user="$user"></x-UserInformation>
        <h3 class=" text-center">Messages</h3>
        <hr style="width: 75%; background-color: #ddd;">
        @foreach($user->messages as $message)
        @if($user->messages->count() == 0)
        <h1 class="text-center display-4">You have no message in this discussion</h1>
        @elseif ($message->author_messsage_user_id == $message->user_id)
        {{-- admin --}}
        <div class="d-flex align-items-start flex-column my-1">
          <p class="max-w-75 bg-light text-primary pl-3 pr-5 py-2" style="border-top-right-radius: 999px; border-bottom-right-radius: 999px">
            {!! $message->message !!}
          </div>
          @else
          {{-- // user --}}
          <div class="d-flex align-items-end flex-column my-1">
            <p class="max-w-75 bg-primary text-white pr-3 pl-5 py-2" style="border-top-left-radius: 999px; border-bottom-left-radius: 999px">
              {!! $message->message !!}
            </p>
          </div>
          @endif
          @endforeach
          <form class="form-inline w-100 mt-5 mb-3" action="/messages/{{ $user->id }}" method="POST">
            @csrf
            @method('POST')
            <div class="form-group mx-sm-3 mb-2 w-100 mx-auto d-flex justify-content-center">
              <input type="text" class="form-control" name="message" placeholder="Write a message" style="width: 78%">
              <button type="submit" class="btn btn-primary ml-2">
                <i class="fas fa-paper-plane"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    {{-- <script>
      console.log(window);
      Echo.channel(`messages`)
      .listen('SendMessageEvent', (e) => {
        console.log(['bonjour broadcasdt', e]);
      });
      
    </script> --}}
  </div>


  @endforeach
  
</div>