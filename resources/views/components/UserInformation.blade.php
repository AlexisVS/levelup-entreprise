{{-- /* -------------------------------------------------------------------------- */ --}}
        {{-- /*                              User information                              */ --}}
        <div class="container">
          <h3 class="mt-2 mb-5 ml-4 h4">User Information:</h3>
          <div class="row">
            <div class="col-12 col-xl-4 d-flex justify-center flex-column">
              {{-- /* -------------------------------------------------------------------------- */ --}}
              <h5 class="text-center">User</h5>
              <table class="table table-sm table-borderless table-dark bg-transparent h6 mx-auto">
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row" class="pr-xl-0">Email:</th>
                    <td class="text-break pl-xl-0">{{ $user->email }}</td>
                  </tr>
                  <tr>
                    <th scope="row" class="pr-xl-0" style="white-space: nowrap">User id:</th>
                    <td class=" pl-xl-0">{{ $user->id }}</td>
                  </tr>
                </tbody>
              </table>

            </div>
            <div class="col-12 col-xl-4 d-flex justify-center flex-column">
              {{-- /* -------------------------------------------------------------------------- */ --}}
              <h5 class="text-center">TVA</h5>
              <table class="table table-sm table-borderless table-dark bg-transparent h6 mx-auto">
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row" class="px-xl-0">Name:</th>
                    <td class=" pl-xl-0">{{ $user->tvas->name }}</td>
                  </tr>
                  <tr>
                    <th scope="row" class="px-xl-0">Activity:</th>
                    <td class=" pl-xl-0">{{ $user->tvas->activity }}</td>
                  </tr>
                  <tr>
                    <th scope="row" class="px-xl-0">Address:</th>
                    <td class=" pl-xl-0">{{ $user->tvas->address }}</td>
                  </tr>
                  <tr>
                    <th scope="row" class="px-xl-0">City:</th>
                    <td class=" pl-xl-0">{{ $user->tvas->city }}</td>
                  </tr>
                  <tr>
                    <th scope="row" class="px-xl-0">Country:</th>
                    <td class=" pl-xl-0">{{ $user->tvas->country }}</td>
                  </tr>
                  <tr>
                    <th scope="row" class="px-xl-0">Phone:</th>
                    <td class=" pl-xl-0">{{ $user->tvas->phone }}</td>
                  </tr>
                  <tr>
                    <th scope="row" class="px-xl-0">Zip code:</th>
                    <td class=" pl-xl-0">{{ $user->tvas->zip_code }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-12 col-xl-4 d-flex justify-center flex-column">
              {{-- /* -------------------------------------------------------------------------- */ --}}
              <h5 class="text-center">Contact</h5>
              <table class="table table-sm table-borderless table-dark bg-transparent h6 mx-auto>
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row" class="px-xl-0">Name:</th>
                    <td class="pl-xl-0">{{ $user->contacts->name }}</td>
                  </tr>
                  <tr>
                    <th scope="row" class="px-xl-0">Email:</th>
                    <td class="text-break pl-xl-0">{{ $user->contacts->email }}</td>
                  </tr>
                  <tr>
                    <th scope="row" class="px-xl-0">Phone:</th>
                    <td class="pl-xl-0">{{ $user->contacts->phone }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        {{-- /* -------------------------------------------------------------------------- */ --}}