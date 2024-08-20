<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ isset($title) ? $title . ' - ' . get_setting('title') : get_setting('title') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-5.2.2/css/bootstrap.min.css') }}" />
    <!-- //Global css  -->
    <link rel="stylesheet" href="{{ asset('assets/css/global.css') }}" />
    <!-- //Author css  -->
    <link rel="stylesheet" href="{{ asset('assets/css/myAccountGlobal.css') }}" />
    <!-- Buyer Make Offer add file for card  -->
    <link rel="stylesheet" href="{{ asset('assets/css/buyerMakeOffer.css') }}" />
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset(get_setting('favicon')) }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/v/bs5/dt-1.13.2/datatables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

    <style>
        .service-cards {
            border: 1px solid #e0e0e0;
        }

        .service-card {
            border: 1px solid #e0e0e0;
            border-left: 10px solid #e0e0e0;
            padding: 10px;
            display: flex;
            margin: 10px;
            align-items: center;
            justify-content: flex-start;
            cursor: pointer;
            border-radius: 4px;
        }

        .service-card.active,
        .service-card:hover {
            /* background-color: #006e9f; */
            /* color: #006e9f; */
            border-color: #006e9f;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5);
        }

        .service-card.active .icon {
            color: #006e9f;
        }

        .service-card .icon {
            margin-right: 20px;
            font-size: 24px;
            color: #CCC;
        }
        .qr-code svg{
            width:100% !important;
            height: 100% !important;
        }
    </style>
    @stack('styles')
    <style>
        .error {
            color: red;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>
    <!-- Header  -->
    @include('layouts.partials.header')
    <!-- End  -->



    @yield('content')



    <!-- Footer  -->
    <footer class="footer">
        <a href="{{ route('home') }}"><img src="{{ asset('assets/pictures/footerLogo.png') }}" alt="footerLogo" /></a>
        <div class="footerNav">
            <a href="#">About Us</a>
            <a href="{{ route('sellerWorks') }}">How it works Sellers</a>
            <a href="#">Contact Us</a>
            <a href="{{ route('faqs') }}">Faq's</a>
        </div>
        <div class="social">
            <a href=""><i class="fa-brands fa-facebook"></i></a>
            <a href=""><i class="fa-brands fa-twitter"></i></a>
            <a href=""><i class="fa-brands fa-instagram"></i></a>
            <a href=""><i class="fa-brands fa-youtube"></i></a>
        </div>
        <p class="text-light p-4">{{ get_setting('footer_text') }}</p>
    </footer>
    <div class="nav-footer-nav position-fixed bottom-0 container">
        <ul class=" d-flex align-items-center justify-content-between ps-0">
            <li>
                <a href="{{ route('sellerWorks') }}"> <i class="fa fa-home"></i> <span>Seller</span></a>
            </li>

            <li>
                <a href="{{ route('sellerWorksAgent') }}"> <i class="fa fa-home"></i><span> Seller’s Agent</span></a>
            </li>

            <li>
                <a href="{{ route('add-listing') }}" class="add-listing"><i class="fa fa-plus text-white"></i> </a>
            </li>

            <li>
                <a href="{{ route('buyerWorks') }}"> <i class="fa fa-home"></i><span>Buyer</span></a>
            </li>

            <li>
                <a href="{{ route('buyerWorksAgent') }}"> <i class="fa fa-home"></i><span>Buyer’s Agent</span></a>
            </li>
        </ul>
    </div>
    {{-- <script src="https://kit.fontawesome.com/d7dd5c0801.js" crossorigin="anonymous"></script> --}}
    <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/bootstrap-5.2.2/js/bootstrap.bundle.min.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- PopOver Script  -->
    <script>
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
        const popoverList = [...popoverTriggerList].map((popoverTriggerEl) => new bootstrap.Popover(popoverTriggerEl));
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.2/datatables.min.js"></script>

    <script>
        $(function() {
            $('.service-option').each(function(i, element) {
                $(element).after($(element).val());
                var v = $(element).val();
                if ($(element).is(':checked')) {
                    $(element).parent().addClass('active');
                    if (v == 'Other') {
                        $('.other-service').show();
                        $('.other-service-textarea').focus();
                    }
                } else {
                    $(element).parent().removeClass('active');
                    if (v == 'Other') {
                        $('.other-service').hide();
                        $('.other-service-textarea').val('');
                    }
                }
            });

            $('.service-option').change(function() {
                var v = $(this).val();
                if ($(this).is(':checked')) {
                    $(this).parent().addClass('active');
                    if (v == 'Other') {
                        $('.other-service').show();
                        $('.other-service-textarea').focus();
                    }
                } else {
                    $(this).parent().removeClass('active');
                    if (v == 'Other') {
                        $('.other-service').hide();
                        $('.other-service-textarea').val('');
                    }
                }
            });
        });
    </script>
    <script>
        $(function () {
            $('.data-table').dataTable({
                //
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
