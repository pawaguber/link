@extends('layout')

@section('content')

    <div class="container-fluid col-md-12 d-flex justify-content-center text-center mt-5">
        <div>
            <p class="fs-4 fw-bold pe-5">Створенно:</p>
            <p>{{auth()->user()->links()->count()}} посилання</p>
        </div>
        <div>
            <p class="fs-4 fw-bold ps-5">Всього переходів:</p>
            <p>{{auth()->user()->links->sum('visitors')}}</p>
        </div>
    </div>


    <div class="container w-50">
        <div class="row align-items-center justify-content-center">
            <button type="button" class="btn btn-primary w-25" data-bs-toggle="modal" data-bs-target="#exampleModal"
                    data-bs-whatever="@getbootstrap">Створити посилання
            </button>
            @foreach(auth()->user()->links as $link)
                <div class="block mt-5 bg-light border-4 pt-2">
                    <p>Повне посилання: <a href="{{$link->link}}">{{$link->link}}</a></p>
                    <p>Скорочене посилання: <a href="http://127.0.0.1:8000/link/{{$link->short_link}}">http://127.0.0.1:8000/link/{{$link->short_link}}</a>
                    </p>
                    <p>Всього переходів: {{$link->visitors}}
                        <button type="button" class="ms-5 btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop{{$link->id}}">
                            Видалити
                        </button>
                    </p>
                </div>

                <div class="modal fade" id="staticBackdrop{{$link->id}}" data-bs-backdrop="static" data-bs-keyboard="false"
                     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Видалити</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('link.destroy', $link->short_link) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-body">
                                    Ви дійсно хочете видалити посилання?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ні</button>
                                    <button type="SUBMIT" class="btn btn-danger">Так</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Створити посилання</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="text" name="link" id="link" class="form-control shadow-lg" placeholder="https://"
                               aria-describedby="basic-addon3">
                    </form>

                    <div class="error w-100">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрити</button>
                    <button type="button" class="btn btn-primary button">Створити</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".button").click(function (e) {
            e.preventDefault();
            var link = $("input[name=link]").val();

            $.ajax({
                type: 'POST',
                url: "{{ route('link.store') }}",
                data: {link: link},
                success: function (data) {
                    if (data.response == 'bad') {
                        $('.error').text('Сайт або посилання не робоче!');
                    } else {
                        $('#link').val('http://127.0.0.1:8000/link/' + data.response);
                        $('.error').text('Ваше посилання готове!');
                    }
                },
                error: function (data) {
                    $('.error').text('Посилання не правильне (https://)');
                }
            });
        });

    </script>

@endsection
