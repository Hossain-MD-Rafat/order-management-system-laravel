@extends('templates.public')

@section('content-area')
    <section class="banner container text-center">
        <h2 class="banner-text"><span class="highlighted-text">Search by</span> probuct’s URL</h2>
        <form action="{{ url('producturl') }}" method="post">
            @csrf
            <div class="form-group">
                <div class="input">
                    <input type="text" class="form-control" name="product_url" placeholder="product url..">
                </div>
                @if (session('error'))
                    <span class="text-danger">{{ session('error') }}</span>
                @endif
            </div>
        </form>
        <div class="banner-bottom-text mt-5">WinRAR is a trialware file archiver utility for Windows, developed by Eugene
            Roshal <br>of win.rar GmbH. It can
            create and view archives in RAR</div>
    </section>
    <section class="faq section-bg">
        <div class="col-md-8 offset-2 p-4">
            <div class="faq-item" onclick="faq(this)">
                <div class="question">How to use the website?</div>
                <p class="answer d-none">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Earum tempora culpa minima odit ad saepe.
                </p>
            </div>
            <div class="faq-item" onclick="faq(this)">
                <div class="question">How to use the website?</div>
                <p class="answer d-none">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Earum tempora culpa minima odit ad saepe.
                </p>
            </div>
            <div class="faq-item" onclick="faq(this)">
                <div class="question">How to use the website?</div>
                <p class="answer d-none">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Earum tempora culpa minima odit ad saepe.
                </p>
            </div>
        </div>
    </section>
@endsection

<script>
    function faq(ctx) {
        let p = ctx.querySelector('p');
        $(p).toggleClass('d-none');
    }
</script>
