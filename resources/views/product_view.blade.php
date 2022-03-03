@extends('templates.public')

@section('content-area')
    <section class="banner container text-center">
        <h2><span class="text-success">Search by</span> probuct’s URL</h2>
        <form action="{{ url('producturl') }}" method="post">
            @csrf
            <select name="destination_site" id="">
                <option value="1">Weidian</option>
                <option value="2">Taobao</option>
            </select>
            <input type="text" class="form-control" name="product_url">
        </form>
        <h4>WinRAR is a trialware file archiver utility for Windows, developed by Eugene Roshal <br>of win.rar GmbH. It can
            create and view archives in RAR</h4>
    </section>
    <section class="faq">
        <div class="col-md-8 offset-2 p-4">
            <div class="faq-item" onclick="faq(this)">
                <h4>How to use the website?</h4>
                <p class="d-none">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Earum tempora culpa minima odit ad saepe.
                </p>
            </div>
            <div class="faq-item" onclick="faq(this)">
                <h4>How to use the website?</h4>
                <p class="d-none">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Earum tempora culpa minima odit ad saepe.
                </p>
            </div>
            <div class="faq-item" onclick="faq(this)">
                <h4>How to use the website?</h4>
                <p class="d-none">
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
