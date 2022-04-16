@extends('templates.public')

@section('content-area')
    <section class="cart container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h2 class="text-uppercase">Addresses</h2>
                <a class="signout-btn mt-3 mb-5" href="{{ url('user/addressform') }}">Add address</a>

                @foreach ($addresses as $address)
                    <div class="address-item mb-5">
                        <div class="w-75">
                            <h4>{{ $address->name }}</h4>
                            <span class="street">{{ $address->address }}</span><br>
                            <span>{{ $address->district }}</span><br>
                            <span>{{ $address->post_code . ' ' . $address->town }}</span><br>
                            <span>{{ $address->province }}</span><br>
                            <span>{{ $address->region }}</span><br>
                            <span>{{ $address->phone }}</span><br>
                        </div>
                        <div class="address-action">
                            <div role="button" onclick="showsub(event, this)"><i class="fas fa-ellipsis-h"></i></div>
                            <div class="actions d-none">
                                <a href="{{ url('user/addressform/' . $address->id) }}" class="actions-item">Edit</a>
                                <div role="button" class="actions-item">Delete</div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <script>
        function showsub(ev, e) {
            $(e).siblings('.actions').toggleClass('d-none d-block');
            ev.stopPropagation();
        }
        $(document).click(() => {
            $('.actions.d-block').toggleClass('d-block d-none');
        })
    </script>
@endsection
