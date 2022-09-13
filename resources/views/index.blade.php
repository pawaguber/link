@extends('layout')

@section('content')
    <style>
        body {
            background: #12c2e9; /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #f64f59, #c471ed, #12c2e9); /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #f64f59, #c471ed, #12c2e9); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            font-family: 'Raleway', sans-serif;
        }
    </style>

    <div class="container-fluid col-md-12 d-flex justify-content-center vh-100">
        <div class="row align-items-center justify-content-center">

            <div>
                <div class="lh-1 text-center text-white pb-5">
                    <p style="font-size: 80px" class="h1 fw-bold">ShortLink</p>
                    <p class="">зроби своє посилання в 10 раз коротшою</p>
                </div>

                <form class="row justify-content-between pt-5 w-100">
                    <div class="col-9">
                        <div class="input-group-lg mb-3">
                            <input type="text" name="link" id="link" class="form-control shadow-lg" placeholder="https://"
                                   aria-describedby="basic-addon3">
                        </div>
                    </div>

                    <div class="col-3">
                        <button type="SUMBIT" class="btn-lg button border-0 text-white shadow-lg fw-bold">Створити</button>
                    </div>
                </form>
                <div class="error w-100">
                </div>

                <div class="text-center justify-content-center">
                    <div class="col-12 fw-bold fs-4 text-white">
                        Всього посилань: {{$links->count()}}
                    </div>

                    <div class="col-12 fw-bold fs-5 text-white">
                        Всього переходів: {{$links->sum('visitors')}}
                    </div>
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
