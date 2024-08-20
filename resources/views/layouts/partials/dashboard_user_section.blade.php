@php
  $user = Auth::user();
  if ($user->user_type == 'buyer') {
      $user_type = 'Buyer';
  } elseif ($user->user_type == 'seller') {
      $user_type = 'Seller';
  } elseif ($user->user_type == 'agent') {
      $user_type = 'Real Estate Agent';
  } elseif ($user->user_type == 'admin') {
      $user_type = 'Admin';
  } else {
      $user_type = '';
  }
@endphp
<div class="card">
  <div class="card-body">
    <!-- Review  -->
    <div class="review container">
      <div class="card-body d-flex align-items-center justify-content-between flex-wrap">
        <a href="{{ route('author', $user) }}">
          <div class="left d-flex align-items-center flex-wrap">
            <div class="position-relative image">
              <img src="{{ $user->avatar ? $user->avatar : 'https://ppt1080.b-cdn.net/images/avatar/none.png' }}"
                alt="" />
            </div>
            <div class="ms-2">
              <p class="mb-2">
                <span><b>{{ auth()->user()->name }}</b></span>
                <span class="star opacity-50" data-bs-container="body" tabindex="0" data-bs-toggle="popover"
                  data-bs-trigger="hover focus" data-bs-placement="top" data-bs-content="0 stars based on 0 reviews.">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </span>
              </p>
              <span class="mb-0 opacity-50 text-sm-center sm">{{ $user_type }} • {{ auth()->user()->email }}</span>
            </div>
          </div>
        </a>
        <div class="right text-center">
          @if (auth()->user() && auth()->user()->user_type == 'buyer')
            <a href="{{ route('buyer.add-auction') }}"><button class="btn btn-lg">Hire Buyer's Agent</button></a>
          @elseif(auth()->user() && auth()->user()->user_type == 'landlord')
            <a href="{{ route('landlord.hire.agent.auction') }}"><button class="btn btn-lg">Hire Landlord's
                Agent</button></a>
          @elseif(auth()->user() && auth()->user()->user_type == 'tenant')
            <a href="{{ route('tenant.hire.agent.auction') }}"><button class="btn btn-lg">Hire Tenant's
                Agent</button></a>
          @elseif(auth()->user() && auth()->user()->user_type == 'seller')
            <a href="{{ route('sellerAgentHireAuction') }}"><button class="btn btn-lg">Hire Seller's Agent</button></a>
          @elseif(auth()->user() && auth()->user()->user_type == 'agent')
            <span class="dropdown">
              <button class="btn btn-lg" type="btn" data-bs-toggle="dropdown" aria-expanded="false"> Add Listing <i
                  class="fa fa-angle-down"></i></button>
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
                  <a style="color: #333;" class="dropdown-item" href="{{ route('buyer_agent.auction.add') }}">Add Buyer
                    Criteria Listing</a>
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
                        <a style="color: #333;" class="dropdown-item" href="{{ route('agent.service.auction.add') }}">Add Service Auction</a>
                    </li> --}}
              </ul>
            </span>
            {{-- <a href="{{route('add-listing')}}"><button class="btn btn-lg">Add Property Listing</button></a>
            <a href="{{route('add-listing')}}"><button class="btn btn-lg">Add Buyer Criteria</button></a>
            <a href="{{route('add-listing')}}"><button class="btn btn-lg">Add Service Auction</button></a> --}}
          @endif

          <button class="btn btn-lg" onclick="window.location = '{{ route('logout') }}';">Logout</button>
        </div>
      </div>
    </div>
    <!-- End  -->
  </div>
</div>
