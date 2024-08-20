<style>
  .social {
    display: flex;
    align-items: center;

  }

  .dropdown-toggle::after {
    display: none;
  }

  .btn-apna {
    background: transparent
  }

  .btn-apna i.fa-bell {
    font-size: 16px !important;
    color: #049399;
    padding-top: 5px
  }

  @keyframes bellAnimation {
    0% {
      transform: rotate(-10deg) scale(1);
    }

    50% {
      transform: rotate(10deg) scale(1.3);
    }

    100% {
      transform: rotate(-10deg) scale(1);
    }
  }

  .bell-icon {
    transition: transform 0.2s ease-in-out;
  }

  .bell-icon.bell-animation {
    animation: bellAnimation 0.8s;
    animation-iteration-count: 1;
    color: red;
    /* Change the color of the bell icon to make it more visible */
  }

  .badge12 {
    position: absolute;
    top: -10px;
    right: -10px;
    background-color: red;
    color: white;
    padding: 4px 8px;
    border-radius: 50%;
    font-size: 12px;
    margin-right: 15px;
  }
</style>
<div class="header">
  <!-- <div class="container"> -->
  <div class="subHeader">
    <div class="container d-flex justify-content-between">
      <div class="left">
        <a href="{{ route('sellerWorks') }}">How it works for Sellers</a>
        <a href="{{ route('sellerWorksAgent') }}">How it works for Seller’s Agents</a>
        <a href="{{ route('buyerWorks') }}">How it works for Buyer’s</a>
      </div>
      <div class="right d-flex">
        @if (auth()->user())
          {{-- <a class="a" href="{{ route('logout') }}">Sign Out </a> --}}
          <div class="dropdown dropdown-bubble">
            <a class="a" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i
                class="fa-solid fa-user-large text-black"></i> {{ auth()->user()->name }} <i
                class="fa fa-angle-down"></i></a>
            <ul class="dropdown-menu">
              <li>
                <a class="dropdown-item"
                  href="{{ auth()->user()->user_type == 'admin' ? route('admin.dashboard') : route('dashboard') }}"><i
                    class="fa-solid fa-house-user me-2 text-black"></i> Dashboard</a>
              </li>
              <li>
                @if (auth()->user()->user_type != 'admin')
                  <a class="dropdown-item" href="{{ route('settings') }}"><i
                      class="fa-solid fa-user-tie me-2 text-black"></i> Profile Settings</a>
                @endif
                <a class="dropdown-item" href="{{ route('password.change') }}"><i
                    class="fa-solid fa-key me-2 text-black"></i> Change Password</a>
              </li>
              <li>
                <hr class="dropdown-divider" />
              </li>
              <li><a class="dropdown-item" href="{{ route('logout') }}"><i
                    class="fa-solid fa-right-from-bracket me-2 text-black"></i> Sign Out</a></li>

            </ul>
          </div>
        @else
          <a class="a" href="{{ route('login') }}">Sign In </a>
          <a class="a" href="{{ route('register') }}">Register </a>
        @endif

        <div class="social">
          @if (auth()->user())
            {{-- INtegrate --}}
            <div class="dropdown" id="notification_show">
              <button class="btn btn-apna dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fa-solid fa-bell bell-icon">
                  <span class="badge12">0</span>
                </i>
              </button>
              <div class="dropdown-menu" id="notfication_content"
                style="height: 200px;
                            width: 250px;
                            text-align: center;
                            position: absolute;
                            transform: translate3d(0px, 40px, 0px);
                            top: 0px;
                            left: 0px;
                            will-change: transform;
                            overflow: scroll;
                            overflow-x: hidden;"
                aria-labelledby="dropdownMenuButton">
                <p
                  style="    position: fixed;
                            top: 48px;
                            font-size: 12px;
                            left: 25px;">
                  No Notification Available</p>
              </div>
            </div>
          @endif
          <a href=""><i class="fa-brands fa-facebook"></i></a>
          <a href=""><i class="fa-brands fa-twitter"></i></a>
          <a href=""><i class="fa-brands fa-instagram"></i></a>
          <a href=""><i class="fa-brands fa-youtube"></i></a>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar desktop-navbar">
    <div class="container d-flex justify-content-between">
      <div class="logo">
        <a href="{{ route('home') }}">
          <img src="{{ asset(get_setting('logo')) }}" alt="" />
        </a>
      </div>
      <nav>
        <a class="item" href="{{ route('home') }}">Home</a>
        <span class="dropdown">
          <span class="item" type="span" data-bs-toggle="dropdown" aria-expanded="false"> Seller
          </span>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item" href="{{ route('sellerWorks') }}"><i class="fa fa-angle-right"></i> How it works
                for Sellers</a>
            </li>
            <li>
              <a class="dropdown-item" href="#"><i class="fa fa-angle-right"></i> List
                Property</a>
            </li>
          </ul>
        </span>
        <span class="dropdown">
          <span class="item" type="span" data-bs-toggle="dropdown" aria-expanded="false"> Buyer
          </span>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item" href="{{ route('buyerWorks') }}"><i class="fa fa-angle-right"></i> How it works
                for Buyers</a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('searchListing') }}"><i class="fa fa-angle-right"></i> Make an
                Offer on a Property</a>
            </li>
          </ul>
        </span>
        <span class="dropdown">
          <span class="item" type="span" data-bs-toggle="dropdown" aria-expanded="false"> Agents
          </span>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item" href="{{ route('sellerWorksAgent') }}"><i class="fa fa-angle-right"></i> How it
                works for Seller’s Agents</a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('buyerWorksAgent') }}"><i class="fa fa-angle-right"></i> How it
                works for Buyer’s Agent</a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('searchListing') }}"><i class="fa fa-angle-right"></i> Bid on
                a Property For a Buyer</a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('searchListing') }}"><i class="fa fa-angle-right"></i> List a
                Property For a Seller</a>
            </li>
          </ul>
        </span>
        <a class="item" href="{{ route('search.agents') }}">Search Agents</a>
        <a class="item" href="{{ route('searchListing') }}">Search Listings</a>
        <a class="item" href="{{ route('faqs') }}">FAQ</a>

        @if (auth()->user() && in_array(auth()->user()->user_type, ['agent']))
          <span class="dropdown">
            <button class="btn" type="btn" data-bs-toggle="dropdown" aria-expanded="false"> Add
              Listing</button>
            <ul class="dropdown-menu" style="margin-top:0px;">
              <li>
                <a style="color: #333;" class="dropdown-item" href="{{ route('agent.landlord.auction.add') }}">Add
                  Property Listing (Rental)</a>
              </li>
              <li>
                <a style="color: #333;" class="dropdown-item" href="{{ route('add-listing') }}">Add Property Listing
                  (Sale)</a>
              </li>
              <li>
                <a style="color: #333;" class="dropdown-item" href="{{ route('buyer_agent.auction.add') }}">Add
                  Buyer Criteria Listing</a>
              </li>
              <li>
                <a style="color: #333;" class="dropdown-item"
                  href="{{ route('agent.tenant.criteria.auction.add') }}">Add Tenant Criteria Listing</a>
              </li>
              <li>
                <a style="color: #333;" class="dropdown-item" href="{{ route('agent.service.auction.add') }}">Add
                  Service Auction</a>
              </li>

              {{-- <li>
                            <a style="color: #333;" class="dropdown-item" href="{{ route('agent.referral.auction.add') }}">Add Referral Auction</a>
                        </li> --}}
            </ul>
          </span>
        @endif
        @if (auth()->user() && auth()->user()->user_type == 'seller')
          <a class="item" href="{{ route('sellerAgentHireAuction') }}"><button class="btn">Hire Seller's
              Agent</button></a>
        @elseif (auth()->user() && auth()->user()->user_type == 'buyer')
          <a class="item" href="{{ route('buyer.add-auction') }}"><button class="btn">Hire Buyer's
              Agent</button></a>
        @elseif (auth()->user() && auth()->user()->user_type == 'landlord')
          <a class="item" href="{{ route('landlord.hire.agent.auction') }}"><button class="btn">Hire Landlord's
              Agent</button></a>
        @elseif (auth()->user() && auth()->user()->user_type == 'tenant')
          <a class="item" href="{{ route('tenant.hire.agent.auction') }}"><button class="btn">Hire Tenant's
              Agent</button></a>
        @endif
      </nav>
    </div>
  </div>
  <!-- Mobile Navbar -->
  <nav class="navbar mobile-navbar bg-light fixed-top">
    <div class="container-fluid p-0">
      <a class="logo" href="{{ route('home') }}"><img src="{{ asset('assets/pictures/logo.png') }}"
          alt="" /></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
        aria-controls="offcanvasNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end w-100" tabindex="-1" id="offcanvasNavbar"
        aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <a class="logo" href="{{ route('home') }}">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><img width="25%"
                src="{{ asset('assets/pictures/logo.png') }}" alt="" /></h5>
          </a>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li>
              <span class="dropdown">
                <span type="span" data-bs-toggle="dropdown" aria-expanded="false"> Seller
                </span>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item" href="{{ route('sellerWorks') }}"><i class="fa fa-angle-right"></i> How
                      it works for Sellers</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#"><i class="fa fa-angle-right"></i>
                      List Property</a>
                  </li>
                </ul>
              </span>
            </li>
            <li>
              <span class="dropdown">
                <span type="span" data-bs-toggle="dropdown" aria-expanded="false"> Buyer
                </span>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item" href="{{ route('buyerWorks') }}"><i class="fa fa-angle-right"></i> How
                      it works for Buyers</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('searchListing') }}"><i class="fa fa-angle-right"></i>
                      Make an Offer on a Property</a>
                  </li>
                </ul>
              </span>
            </li>
            <li>
              <span class="dropdown">
                <span type="span" data-bs-toggle="dropdown" aria-expanded="false"> Agents
                </span>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item" href="{{ route('sellerWorksAgent') }}"><i
                        class="fa fa-angle-right"></i> How it works for Seller’s Agents</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('buyerWorksAgent') }}"><i class="fa fa-angle-right"></i>
                      How it works for Buyer’s Agent</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('searchListing') }}"><i class="fa fa-angle-right"></i>
                      Bid on a Property For a Buyer</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('searchListing') }}"><i class="fa fa-angle-right"></i>
                      List a Property For a Seller</a>
                  </li>
                </ul>
              </span>
            </li>
            <li>
              <a href="{{ route('searchListing') }}">Search Listings</a>
            </li>
            <li><a href="{{ route('faqs') }}">FAQ</a></li>
            <li>
              <a href="{{ route('add-listing') }}"><button class="btn">Add a
                  Listing</button></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- </div> -->
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
  integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
  integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
  integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
  $(document).ready(function() {
    var $badge = $('.bell-icon .badge12');
    var $notificationContent = $('#notfication_content');

    // Set initial CSS properties for the notification container
    $notificationContent.css({
      height: '139px',
      width: '187px',
      textAlign: 'center',
      position: 'absolute',
      transform: 'translate3d(0px, 40px, 0px)',
      top: '-3px',
      left: '0px',
      willChange: 'transform',
      overflow: 'hidden scroll'
    });

    setInterval(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        url: '/notification',
        method: 'POST',
        data: {
          id: 1,
          type: 'seller-property'
        },
        success: function(res) {
          // Handle the successful response
          console.log(res.message);

          // Check if count is greater than 0
          if (res.count > 0) {
            // Update the CSS properties for the notification container
            $notificationContent.css({
              height: '200px',
              width: '250px',
              textAlign: 'center',
              position: 'absolute',
              transform: 'translate3d(0px, 40px, 0px)',
              top: '0px',
              left: '0px',
              willChange: 'transform',
              overflow: 'scroll',
              overflowX: 'hidden'
            });

            // Set notification content without <p> tag
            $notificationContent.html(res.html);

            // Add animation class to the bell icon
            $('.bell-icon').addClass('bell-animation');
            setTimeout(function() {
              // Remove animation class after 0.5 seconds
              $('.bell-icon').removeClass('bell-animation');
            }, 500);
            var countExpiredProperties = $('#count_data').val();

            // Update the badge count
            $badge.text(countExpiredProperties);
            $('.bell-icon .badge12').on('click', function() {
              $(this).hide();
            });

            // Show or hide the badge based on count
            if (res.count > 0) {
              $badge.show();
            } else {
              $badge.hide();
            }
          } else {
            // Count is not greater than 0, reset the notification container CSS
            $notificationContent.css({
              height: '139px',
              width: '187px',
              textAlign: 'center',
              position: 'absolute',
              transform: 'translate3d(0px, 40px, 0px)',
              top: '-3px',
              left: '0px',
              willChange: 'transform',
              overflow: 'hidden scroll'
            });

            // Update the badge count
            $badge.text(countExpiredProperties);
          }
        },
        error: function(xhr, status, error) {
          // Handle the error
          console.log(error);
        }
      });

    }, 10000); // 10000 milliseconds = 10 seconds

    // Remove badge on click
    $('.bell-icon').click(function() {
      $badge.hide();
    });
  });
</script>
