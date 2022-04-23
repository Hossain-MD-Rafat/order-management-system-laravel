@extends('templates.public')

@section('content-area')
    <!-- banner -->
    <section class="banner container-fluid text-center">
        <div class="content-area">
            <h2 class="banner-text">
                <span class="highlighted-text">Search</span> Cart.
            </h2>
            <form action="{{ url('producturl') }}" method="post">
                @csrf
                <div class="form-group">
                    <div class="input">
                        <input type="text" class="form-control" name="product_url" placeholder="product url.." />
                    </div>
                    @if (session('error'))
                        <span class="text-danger">{{ session('error') }}</span>
                    @endif
                </div>
            </form>
            <div class="banner-bottom-text mt-5">
                search with url. taobao, waidien and more cart them and shipping.
            </div>
        </div>
    </section>

    <!-- order process -->
    <section class="order-porcess">
        <div class="wrapper">
            <div class="center-line">
                <a href="#" class="scroll-icon"><i class="fas fa-caret-up"></i></a>
            </div>
            <div class="row row-1">
                <section>
                    <i class="icon fas fa-search"></i>
                    <div class="details">
                        <span class="title">Search Product</span>
                    </div>
                    <p>
                        You can serach product from weidian and taobao through the product
                        url. To search a product just copy the product url and then search
                        the product through the search bar.
                    </p>
                </section>
            </div>
            <div class="row row-2">
                <section>
                    <i class="icon fas fa-list"></i>
                    <div class="details">
                        <span class="title">Select Product Options</span>
                    </div>
                    <p>
                        After searching the product url you will be taken to product
                        details page. On the product details page you can choose product
                        size, product color and quantity.
                    </p>
                </section>
            </div>
            <div class="row row-1">
                <section>
                    <i class="icon fas fa-cart-plus"></i>
                    <div class="details">
                        <span class="title">Add to Cart</span>
                    </div>
                    <p>
                        After selecting options then you can add the product to your cart.
                        You can add as many products as you want to the cart. You can see
                        your total price on cart page.
                    </p>
                </section>
            </div>
            <div class="row row-2">
                <section>
                    <i class="icon fas fa-map-marker"></i>
                    <div class="details">
                        <span class="title">Send Purchased Order</span>
                    </div>
                    <p>
                        To proceed the order you have to provide the shipping address. You
                        can save some addresses on your profile or you can also put new
                        address here.
                    </p>
                </section>
            </div>
            <div class="row row-1">
                <section>
                    <i class="icon fas fa-stream"></i>
                    <div class="details">
                        <span class="title">Product Status</span>
                    </div>
                    <p>
                        After providing shipping address our admin will assess your order
                        and add shipping cost to the order. When the status will be
                        <b>Purchase Order Payment</b> then you can pay and complete the
                        order.
                    </p>
                </section>
            </div>
            <div class="row row-2">
                <section>
                    <i class="icon fas fa-paper-plane"></i>
                    <div class="details">
                        <span class="title">Get Delivered</span>
                    </div>
                    <p>
                        You can see your products' status. When the products will arrive to our wirehouse, you will be
                        notified and you can see the product image also if we find any defects on the products then will
                        apply for replacement. After checking products we will shipp to your given address.
                    </p>
                </section>
            </div>
        </div>
    </section>

    <!-- client's feedback -->
    <section class="counter-up">
        <div class="content">
            <div class="box">
                <div class="icon"><i class="fas fa-gift"></i></div>
                <div class="counter">580</div>
                <div class="text">Total Orders</div>
            </div>
            <div class="box">
                <div class="icon"><i class="fas fa-users"></i></div>
                <div class="counter">1257</div>
                <div class="text">Total Users</div>
            </div>
            <div class="box">
                <div class="icon"><i class="icon fas fa-paper-plane"></i></div>
                <div class="counter">520</div>
                <div class="text">Successfully Delivered</div>
            </div>
            <div class="box">
                <div class="icon"><i class="fas fa-rocket"></i></div>
                <div class="counter">85</div>
                <div class="text">International Deliveries</div>
            </div>
    </section>

    <!-- what we offer -->
    <section class="what-we-offer container">
        <div class="row">
            <div class="section-header">
                <span class="back-text">Specialities</span>
                <h2>What we offer</h2>
                <span class="line"></span>
            </div>
            <div class="col-md-3 offer-item">
                <div><i class="fas fa-shipping-fast"></i></div>
                <h4>Fast Shipping</h4>
                <span>We offer the fast shipping for the client without any hastle</span>
            </div>
            <div class="col-md-3 offer-item">
                <div><i class="fas fa-shipping-fast"></i></div>
                <h4>Fast Shipping</h4>
                <span>We offer the fast shipping for the client without any hastle</span>
            </div>
            <div class="col-md-3 offer-item">
                <div><i class="fas fa-shipping-fast"></i></div>
                <h4>Fast Shipping</h4>
                <span>We offer the fast shipping for the client without any hastle</span>
            </div>
            <div class="col-md-3 offer-item">
                <div><i class="fas fa-shipping-fast"></i></div>
                <h4>Fast Shipping</h4>
                <span>We offer the fast shipping for the client without any hastle</span>
            </div>
        </div>
    </section>

    <!-- faq -->
    <section class="faq container-fluid">
        <div class="col-md-8 offset-2 p-4">
            <div class="faq-item" onclick="faq(this)">
                <div class="question">How to use the website?</div>
                <p class="answer d-none">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Earum
                    tempora culpa minima odit ad saepe.
                </p>
                <div class="faq-icon">
                    <i class="fas fa-chevron-down"></i>
                    <i class="fas fa-chevron-up d-none"></i>
                </div>
            </div>
            <div class="faq-item" onclick="faq(this)">
                <div class="question">How to use the website?</div>
                <p class="answer d-none">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Earum
                    tempora culpa minima odit ad saepe.
                </p>
                <div class="faq-icon">
                    <i class="fas fa-chevron-down"></i>
                    <i class="fas fa-chevron-up d-none"></i>
                </div>
            </div>
            <div class="faq-item" onclick="faq(this)">
                <div class="question">How to use the website?</div>
                <p class="answer d-none">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Earum
                    tempora culpa minima odit ad saepe.
                </p>
                <div class="faq-icon">
                    <i class="fas fa-chevron-down"></i>
                    <i class="fas fa-chevron-up d-none"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- section contact -->
    <section id="contact" class="with-line">
        <div class="container">
            <!-- section header -->
            <div class="section-header">
                <span class="back-text">Contact</span>
                <h2>Get In Touch</h2>
                <span class="line"></span>
            </div>
            <div class="row">
                <!-- column with offset -->
                <div class="col-md-6 offset-md-3">
                    <!-- Contact Form -->
                    <div id="contact-msg"></div>
                    <form id="contact-form" class="contact-form" method="post" onsubmit="sendquery(this)">
                        <div class="messages"></div>

                        <!-- Name input -->
                        <div class="form-group">
                            <input type="text" class="form-control" name="InputName" id="InputName"
                                placeholder="Your name" required="required" data-error="Name is required.">
                            <div class="help-block with-errors"></div>
                        </div>

                        <!-- Email input -->
                        <div class="form-group">
                            <input type="email" class="form-control" id="InputEmail" name="InputEmail"
                                placeholder="Email address" required="required" data-error="Email is required.">
                            <div class="help-block with-errors"></div>
                        </div>

                        <!-- Subject input -->
                        <div class="form-group">
                            <input type="text" class="form-control" id="InputSubject" name="InputSubject"
                                placeholder="Subject" required="required" data-error="Subject is required.">
                            <div class="help-block with-errors"></div>
                        </div>

                        <!-- Message textarea -->
                        <div class="form-group">
                            <textarea name="InputMessage" id="InputMessage" class="form-control" rows="7" placeholder="Message"
                                required="required" data-error="Message is required."></textarea>
                            <div class="help-block with-errors"></div>
                        </div>

                        <button type="submit" name="submit" id="submit" value="Submit"
                            class="signout-btn w-100">Send</button><!-- Send Button -->

                    </form>
                    <!-- Contact Form end -->

                </div>
                <!-- end column -->
            </div>
        </div>
    </section>
    <script>
        function faq(ctx) {
            let p = ctx.querySelector('p');
            ctx.querySelector('.faq-icon .fa-chevron-down').classList.toggle('d-none');
            ctx.querySelector('.faq-icon .fa-chevron-up').classList.toggle('d-none');
            $(p).toggleClass('d-none');
        }

        function sendquery(e) {
            event.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('sendcustomerquery') }}",
                method: 'POST',
                cache: false,
                data: {
                    'sendquery': true,
                    'name': $('#InputName').val(),
                    'email': $('#InputEmail').val(),
                    'subject': $('#InputSubject').val(),
                    'message': $('#InputMessage').val()
                },
                success: function(res) {
                    if (res.status == 200) {
                        $('#contact-msg').html(
                            '<span class="text-success mb-2 d-block">Your query has been sent successfully. We will get back to you soon.</span>'
                        );
                    } else {
                        $('#contact-msg').html(
                            '<span class="text-danger mb-2 d-block">Failed to send! Please try again.</span>'
                        );
                    }
                },
                error: function() {
                    $('#contact-msg').html(
                        '<span class="text-danger mb-2 d-block">Failed to send! Please try again.</span>'
                    );
                }
            });
        }
    </script>
@endsection
