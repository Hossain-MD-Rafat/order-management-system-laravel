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
                                <div role="button" data-bs-toggle="modal" data-bs-target="#address-delete"
                                    onclick="deleteAdress(this, {{ $address->id }})" class="actions-item">
                                    Delete</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="address-delete" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Confirmation Message</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="padding: 0px 10px;">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure to delete the address!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Back</button>
                        <button type="button" id="confirm" class="btn btn-danger" data-bs-dismiss="modal">Yes, Go!</button>
                    </div>
                </div>
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

        function deleteAdress(e, id) {
            $('#confirm').click(() => {
                let item = e.parentNode.parentNode.parentNode;
                item.style.display = 'none';

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    url: "{{ url('user/addressdelete') }}",
                    data: {
                        delete: true,
                        id: id
                    },
                    cache: false,
                    success: function(response) {
                        if (response.status === 200) {
                            item.remove();
                        } else {
                            item.style.display = 'block';
                        }
                    },
                    error: function(response) {
                        item.style.display = 'block';
                    }
                });
            });
        }
    </script>
@endsection
