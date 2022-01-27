<div class="accordion" id="accordionExample{{ $user->id }}">
  <div class="card">
    <div class="card-header border-0" id="headingOne{{ $user->id }}">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne{{ $user->id }}" aria-expanded="true" aria-controls="collapseOne{{ $user->id }}">
          {{ $user->contacts->name }}
        </button>
      </h2>
    </div>

    <div id="collapseOne{{ $user->id }}" class="collapse" aria-labelledby="headingOne{{ $user->id }}" data-parent="#accordionExample{{ $user->id }}">
      <div class="card-body p-0">
        <x-UserInformation :user="$user"></x-UserInformation>
        <table class="table table-borderless table-dark bg-transparent">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Message</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            {{-- {{ $users }} --}}
            @foreach ($user->todos as $todo )

            <tr class="{{ $todo->status == 'done' ? 'bg-success' : null}}" style="border-bottom: 2px solid #343A40">
              <th scope="row">{{ $loop->iteration }}</th>
              <td class="text-break">{{ $todo->text }}</td>
              <td>{{ $todo->status }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <form class="form-inline w-100 mt-5 mb-3" action="/todos/{{ $user->id }}" method="POST">
          @csrf
          @method('POST')
          <div class="form-group mx-sm-3 mb-2 w-100 mx-auto d-flex justify-content-center">
            <input type="text" class="form-control" name="text" placeholder="Add a todo" style="width: 78%">
            <button type="submit" class="btn btn-primary ml-2">
              <i class="fas fa-tasks"></i>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
