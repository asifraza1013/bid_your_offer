@extends('layouts.main')
@push('styles')
  {{-- @dd("ok"); --}}
  {{-- @dd($auction); --}}
  <!-- //Listing Description css  -->

  <!-- Toastr CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

  <link rel="stylesheet" href="{{ asset('assets/css/listingDescription.css') }}" />


  <style>
    #float-button {
      position: fixed;
      bottom: 20px;
      right: 20px;
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 4px;
      box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);
      font-size: 16px;
      z-index: 9999;
    }

    #float-button1 {
      position: fixed;
      bottom: 100px;
      right: 20px;
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 4px;
      box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);
      font-size: 16px;
      z-index: 9999;
    }


    #inbox {
      position: fixed;
      bottom: 80px;
      right: 20px;
      width: 300px;
      height: 400px;
      background-color: #fff;
      box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);
      display: none;
      padding: 20px;
      border-radius: 4px;
      z-index: 9999;
    }

    #inbox.visible {
      display: block;
    }

    #close-button {
      position: absolute;
      top: 10px;
      right: 10px;
      padding: 5px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 4px;
      font-size: 14px;
      cursor: pointer;
    }

    #close-button:hover {
      background-color: #0062cc;
    }

    #message-box {
      display: flex;
      flex-direction: column;
      margin-top: 20px;
    }

    #message-input {
      flex-grow: 1;
      border: 1px solid #ccc;
      border-radius: 4px;
      padding: 10px;
      margin-bottom: 10px;
      resize: none;
      outline: none;
    }

    #send-button {
      align-self: flex-end;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 4px;
      padding: 5px 10px;
      cursor: pointer;
    }

    #send-button i {
      font-size: 18px;
    }

    #send-button:hover {
      background-color: #0062cc;
    }

    .custom-toast {
      width: 400px !important;
      opacity: 1 !important;
    }
  </style>
  <style>

  </style>
  <style>
    .chat-toggle-btn {
      position: fixed;
      bottom: 20px;
      right: 20px;
      padding: 10px 20px;
      background-color: #333;
      color: #fff;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      z-index: 9999;
    }

    .chat-container {
      position: fixed;
      bottom: 20px;
      right: 20px;
      width: 300px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      border-radius: 5px;
      overflow: hidden;
      z-index: 9999;
      display: none;
    }

    .chat-header {
      padding: 10px;
      background-color: #333;
      color: #fff;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .chat-header h3 {
      margin: 0;
    }

    .chat-close-btn {
      background: none;
      border: none;
      color: #fff;
      font-size: 18px;
      cursor: pointer;
    }

    .chat-messages {
      padding: 10px;
      max-height: 300px;
      overflow-y: auto;
    }

    .message {
      margin-bottom: 10px;
      padding: 8px;
      border-radius: 5px;
    }

    .incoming {
      background-color: #ebebeb;
    }

    .outgoing {
      background-color: #f1f1f1;
      text-align: right;
    }

    .chat-input {
      display: flex;
      align-items: center;
      padding: 10px;
    }

    #messageInput {
      flex-grow: 1;
      padding: 8px;
      border: none;
      border-radius: 5px;
      margin-right: 10px;
    }

    .send-message-btn {
      background-color: #333;
      color: #fff;
      border: none;
      padding: 8px 16px;
      border-radius: 5px;
      cursor: pointer;
    }
  </style>
  <style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }

    .fa-dollar {
      padding: 0 20px;
      background: #facd34;
      color: #fff;
      border: 0;
      font-weight: 700 !important;
      line-height: 39px !important;
      margin-right: -5px;
      z-index: 1;
      border-radius: 3px 0 0 3px;
    }

    .form-control,
    .form-select {
      border-radius: 0.25rem;
      box-shadow: inset 0 1px 2px 0 rgb(66 71 112 / 12%);
      border-radius: 0.25rem;
      background-color: #fafafb;
      margin-bottom: 15px;
    }

    .loader {
      width: 40px;
      height: 40px;
      margin: 0 auto;
      border: 4px solid #f3f3f3;
      border-top: 4px solid #3498db;
      border-radius: 50%;
      animation: spin 1s infinite linear;
    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }

    .removeBold {
      font-weight: normal;
    }

    .biddingOperations {
      gap: 14px;
    }

    /* .listingDescription .right button,
                                                                                                                                                                                                                                                  .listingDescription .rightCol button {
                                                                                                                                                                                                                                                    background: normal !important;
                                                                                                                                                                                                                                                  } */

    /* Counter Bid  */
    .box {
      position: relative;
      border-radius: 3px;
      background: #ffffff;
      border-top: 3px solid #d2d6de;
      margin-bottom: 20px;
      width: 100%;
      box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
    }

    .box.box-primary {
      border-top-color: #3c8dbc;
    }

    .box.box-info {
      border-top-color: #00c0ef;
    }

    .box.box-danger {
      border-top-color: #dd4b39;
    }

    .box.box-warning {
      border-top-color: #f39c12;
    }

    .box.box-success {
      border-top-color: #00a65a;
    }

    .box.box-default {
      border-top-color: #d2d6de;
    }

    .box.collapsed-box .box-body,
    .box.collapsed-box .box-footer {
      display: none;
    }

    .box .nav-stacked>li {
      border-bottom: 1px solid #f4f4f4;
      margin: 0;
    }

    .box .nav-stacked>li:last-of-type {
      border-bottom: none;
    }

    .box.height-control .box-body {
      max-height: 300px;
      overflow: auto;
    }

    .box .border-right {
      border-right: 1px solid #f4f4f4;
    }

    .box .border-left {
      border-left: 1px solid #f4f4f4;
    }

    .box.box-solid {
      border-top: 0;
    }

    .box.box-solid>.box-header .btn.btn-default {
      background: transparent;
    }

    .box.box-solid>.box-header .btn:hover,
    .box.box-solid>.box-header a:hover {
      background: rgba(0, 0, 0, 0.1);
    }

    .box.box-solid.box-default {
      border: 1px solid #d2d6de;
    }

    .box.box-solid.box-default>.box-header {
      color: #444;
      background: #d2d6de;
      background-color: #d2d6de;
    }

    .box.box-solid.box-default>.box-header a,
    .box.box-solid.box-default>.box-header .btn {
      color: #444;
    }

    .box.box-solid.box-primary {
      border: 1px solid #3c8dbc;
    }

    .box.box-solid.box-primary>.box-header {
      color: #fff;
      background: #3c8dbc;
      background-color: #3c8dbc;
    }

    .box.box-solid.box-primary>.box-header a,
    .box.box-solid.box-primary>.box-header .btn {
      color: #fff;
    }

    .box.box-solid.box-info {
      border: 1px solid #00c0ef;
    }

    .box.box-solid.box-info>.box-header {
      color: #fff;
      background: #00c0ef;
      background-color: #00c0ef;
    }

    .box.box-solid.box-info>.box-header a,
    .box.box-solid.box-info>.box-header .btn {
      color: #fff;
    }

    .box.box-solid.box-danger {
      border: 1px solid #dd4b39;
    }

    .box.box-solid.box-danger>.box-header {
      color: #fff;
      background: #dd4b39;
      background-color: #dd4b39;
    }

    .box.box-solid.box-danger>.box-header a,
    .box.box-solid.box-danger>.box-header .btn {
      color: #fff;
    }

    .box.box-solid.box-warning {
      border: 1px solid #f39c12;
    }

    .box.box-solid.box-warning>.box-header {
      color: #fff;
      background: #f39c12;
      background-color: #f39c12;
    }

    .box.box-solid.box-warning>.box-header a,
    .box.box-solid.box-warning>.box-header .btn {
      color: #fff;
    }

    .box.box-solid.box-success {
      border: 1px solid #00a65a;
    }

    .box.box-solid.box-success>.box-header {
      color: #fff;
      background: #00a65a;
      background-color: #00a65a;
    }

    .box.box-solid.box-success>.box-header a,
    .box.box-solid.box-success>.box-header .btn {
      color: #fff;
    }

    .box.box-solid>.box-header>.box-tools .btn {
      border: 0;
      box-shadow: none;
    }

    .box.box-solid[class*='bg']>.box-header {
      color: #fff;
    }

    .box .box-group>.box {
      margin-bottom: 5px;
    }

    .box .knob-label {
      text-align: center;
      color: #333;
      font-weight: 100;
      font-size: 12px;
      margin-bottom: 0.3em;
    }

    .box>.overlay,
    .overlay-wrapper>.overlay,
    .box>.loading-img,
    .overlay-wrapper>.loading-img {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%
    }

    .box .overlay,
    .overlay-wrapper .overlay {
      z-index: 50;
      background: rgba(255, 255, 255, 0.7);
      border-radius: 3px;
    }

    .box .overlay>.fa,
    .overlay-wrapper .overlay>.fa {
      position: absolute;
      top: 50%;
      left: 50%;
      margin-left: -15px;
      margin-top: -15px;
      color: #000;
      font-size: 30px;
    }

    .box .overlay.dark,
    .overlay-wrapper .overlay.dark {
      background: rgba(0, 0, 0, 0.5);
    }

    .box-header:before,
    .box-body:before,
    .box-footer:before,
    .box-header:after,
    .box-body:after,
    .box-footer:after {
      content: " ";
      display: table;
    }

    .box-header:after,
    .box-body:after,
    .box-footer:after {
      clear: both;
    }

    .box-header {
      color: #444;
      display: block;
      padding: 10px;
      position: relative;
    }

    .box-header.with-border {
      border-bottom: 1px solid #f4f4f4;
    }

    .collapsed-box .box-header.with-border {
      border-bottom: none;
    }

    .box-header>.fa,
    .box-header>.glyphicon,
    .box-header>.ion,
    .box-header .box-title {
      display: inline-block;
      font-size: 18px;
      margin: 0;
      line-height: 1;
    }

    .box-header>.fa,
    .box-header>.glyphicon,
    .box-header>.ion {
      margin-right: 5px;
    }

    .box-header>.box-tools {
      position: absolute;
      right: 10px;
      top: 5px;
    }

    .box-header>.box-tools [data-toggle="tooltip"] {
      position: relative;
    }

    .box-header>.box-tools.pull-right .dropdown-menu {
      right: 0;
      left: auto;
    }

    .btn-box-tool {
      padding: 5px;
      font-size: 12px;
      background: transparent;
      color: #97a0b3;
    }

    .open .btn-box-tool,
    .btn-box-tool:hover {
      color: #606c84;
    }

    .btn-box-tool.btn:active {
      box-shadow: none;
    }

    .box-body {
      border-top-left-radius: 0;
      border-top-right-radius: 0;
      border-bottom-right-radius: 3px;
      border-bottom-left-radius: 3px;
      padding: 10px;
    }

    .no-header .box-body {
      border-top-right-radius: 3px;
      border-top-left-radius: 3px;
    }

    .box-body>.table {
      margin-bottom: 0;
    }

    .box-body .fc {
      margin-top: 5px;
    }

    .box-body .full-width-chart {
      margin: -19px;
    }

    .box-body.no-padding .full-width-chart {
      margin: -9px;
    }

    .box-body .box-pane {
      border-top-left-radius: 0;
      border-top-right-radius: 0;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 3px;
    }

    .box-body .box-pane-right {
      border-top-left-radius: 0;
      border-top-right-radius: 0;
      border-bottom-right-radius: 3px;
      border-bottom-left-radius: 0;
    }

    .box-footer {
      border-top-left-radius: 0;
      border-top-right-radius: 0;
      border-bottom-right-radius: 3px;
      border-bottom-left-radius: 3px;
      border-top: 1px solid #f4f4f4;
      padding: 10px;
      background-color: #fff;
    }

    .direct-chat .box-body {
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
      position: relative;
      overflow-x: hidden;
      padding: 0;
    }

    .direct-chat.chat-pane-open .direct-chat-contacts {
      -webkit-transform: translate(0, 0);
      -ms-transform: translate(0, 0);
      -o-transform: translate(0, 0);
      transform: translate(0, 0);
    }

    .direct-chat-messages {
      -webkit-transform: translate(0, 0);
      -ms-transform: translate(0, 0);
      -o-transform: translate(0, 0);
      transform: translate(0, 0);
      padding: 10px;
      height: 250px;
      overflow: auto;
    }

    .direct-chat-msg,
    .direct-chat-text {
      display: block;
    }

    .direct-chat-msg {
      margin-bottom: 10px;
    }

    .direct-chat-msg:before,
    .direct-chat-msg:after {
      content: " ";
      display: table;
    }

    .direct-chat-msg:after {
      clear: both;
    }

    .direct-chat-messages,
    .direct-chat-contacts {
      -webkit-transition: -webkit-transform .5s ease-in-out;
      -moz-transition: -moz-transform .5s ease-in-out;
      -o-transition: -o-transform .5s ease-in-out;
      transition: transform .5s ease-in-out;
    }

    .direct-chat-text {
      border-radius: 5px;
      position: relative;
      padding: 5px 10px;
      background: #d2d6de;
      border: 1px solid #d2d6de;
      margin: 5px 0 0 50px;
      color: #444;
    }

    .direct-chat-text:after,
    .direct-chat-text:before {
      position: absolute;
      right: 100%;
      top: 15px;
      border: solid transparent;
      border-right-color: #d2d6de;
      content: ' ';
      height: 0;
      width: 0;
      pointer-events: none;
    }

    .direct-chat-text:after {
      border-width: 5px;
      margin-top: -5px;
    }

    .direct-chat-text:before {
      border-width: 6px;
      margin-top: -6px;
    }

    .right .direct-chat-text {
      margin-right: 50px;
      margin-left: 0;
    }

    .right .direct-chat-text:after,
    .right .direct-chat-text:before {
      right: auto;
      left: 100%;
      border-right-color: transparent;
      border-left-color: #d2d6de;
    }

    .direct-chat-img {
      border-radius: 50%;
      float: left;
      width: 40px;
      height: 40px;
    }

    .right .direct-chat-img {
      float: right;
    }

    .direct-chat-info {
      display: block;
      margin-bottom: 2px;
      font-size: 12px;
    }

    .direct-chat-name {
      font-weight: 600;
    }

    .direct-chat-timestamp {
      color: #999;
    }

    .direct-chat-contacts-open .direct-chat-contacts {
      -webkit-transform: translate(0, 0);
      -ms-transform: translate(0, 0);
      -o-transform: translate(0, 0);
      transform: translate(0, 0);
    }

    .direct-chat-contacts {
      -webkit-transform: translate(101%, 0);
      -ms-transform: translate(101%, 0);
      -o-transform: translate(101%, 0);
      transform: translate(101%, 0);
      position: absolute;
      top: 0;
      bottom: 0;
      height: 250px;
      width: 100%;
      background: #222d32;
      color: #fff;
      overflow: auto;
    }

    .contacts-list>li {
      border-bottom: 1px solid rgba(0, 0, 0, 0.2);
      padding: 10px;
      margin: 0;
    }

    .contacts-list>li:before,
    .contacts-list>li:after {
      content: " ";
      display: table;
    }

    .contacts-list>li:after {
      clear: both;
    }

    .contacts-list>li:last-of-type {
      border-bottom: none;
    }

    .contacts-list-img {
      border-radius: 50%;
      width: 40px;
      float: left;
    }

    .contacts-list-info {
      margin-left: 45px;
      color: #fff;
    }

    .contacts-list-name,
    .contacts-list-status {
      display: block;
    }

    .contacts-list-name {
      font-weight: 600;
    }

    .contacts-list-status {
      font-size: 12px;
    }

    .contacts-list-date {
      color: #aaa;
      font-weight: normal;
    }

    .contacts-list-msg {
      color: #999;
    }

    .direct-chat-danger .right>.direct-chat-text {
      background: #dd4b39;
      border-color: #dd4b39;
      color: #fff;
    }

    .direct-chat-danger .right>.direct-chat-text:after,
    .direct-chat-danger .right>.direct-chat-text:before {
      border-left-color: #dd4b39;
    }

    .direct-chat-primary .right>.direct-chat-text {
      background: #3c8dbc;
      border-color: #3c8dbc;
      color: #fff;
    }

    .direct-chat-primary .right>.direct-chat-text:after,
    .direct-chat-primary .right>.direct-chat-text:before {
      border-left-color: #3c8dbc;
    }

    .direct-chat-warning .right>.direct-chat-text {
      background: #f39c12;
      border-color: #f39c12;
      color: #fff;
    }

    .direct-chat-warning .right>.direct-chat-text:after,
    .direct-chat-warning .right>.direct-chat-text:before {
      border-left-color: #f39c12;
    }

    .direct-chat-info .right>.direct-chat-text {
      background: #00c0ef;
      border-color: #00c0ef;
      color: #fff;
    }

    .direct-chat-info .right>.direct-chat-text:after,
    .direct-chat-info .right>.direct-chat-text:before {
      border-left-color: #00c0ef;
    }

    .direct-chat-success .right>.direct-chat-text {
      background: #00a65a;
      border-color: #00a65a;
      color: #fff;
    }

    .direct-chat-success .right>.direct-chat-text:after,
    .direct-chat-success .right>.direct-chat-text:before {
      border-left-color: #00a65a;
    }

    table.table.counterAction button {
      padding: 0;
      margin: 0;
      width: auto;
    }
  </style>
@endpush


@section('content')
  @php
    $auth_id = auth()->user() ? auth()->user()->id : 0;
  @endphp
  <!-- Gallery Start Here  -->
  <div class="container listingDescription">
    <div class="row">
      <div class="col-sm-12 col-md-8 col-lg-8 leftCol">
        <!-- Galery Start Here  -->
        <div class="row d-flex flex-wrap" data-toggle="modal" data-target="#lightbox">
          <!-- Main Video Baner  -->
          @php
            $i_sr = 0;
            $mediaImage = url('auction/images/noimage.png');
            if (gettype(@$auction->get->photos) == 'array') {
                $photos = @$auction->get->photos;
                $mediaImage = url(current($photos));
            }
          @endphp
          <div class="col-sm-12 col-md-6 col-lg-8">
            <img class="w-100" src="{{ asset(@$mediaImage) }}" data-target="#indicators"
              data-slide-to="{{ $i_sr }}" alt="" />
          </div>
          <!-- Small Images  -->
          <div class="col-sm-12 col-md-4 col-lg-4">
            <div class="row">
              {{-- @dd(@$auction->get) --}}
              @if (@$auction->get->photos)
                @foreach (@$auction->get->photos as $image)
                  <div class="col-sm-4 col-md-6 col-lg-6 p-2">
                    <img class="w-100" src="{{ asset($image) }}" data-target="#indicators"
                      data-slide-to="{{ $i_sr++ }}" alt="" />
                  </div>
                @endforeach
              @else
                <div class="col-sm-4 col-md-6 col-lg-6 p-2">
                  <img class="w-100" src="{{ asset($mediaImage) }}" data-target="#indicators"
                    data-slide-to="{{ $i_sr++ }}" alt="" />
                </div>
              @endif
            </div>
          </div>

        </div>
        <!-- Modal -->
        @if (@$auction->get->photos)
          <div class="modal fade" id="lightbox" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <button type="button" class="close text-right p-2" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <div id="indicators" class="carousel slide" data-interval="false">
                  <ol class="carousel-indicators">
                    @foreach (@$auction->get->photos as $image)
                      <li data-target="#indicators" data-slide-to="{{ $loop->iteration }}" class="active">
                      </li>
                    @endforeach
                  </ol>
                  <div class="carousel-inner">
                    @php
                      $i = 1;
                    @endphp
                    @foreach (@$auction->get->photos as $image)
                      <div class="carousel-item {{ $i++ == 1 ? 'active' : '' }}">
                        <img class="d-block w-100" src="{{ asset($image) }}" alt="First slide">
                      </div>
                    @endforeach

                  </div>
                  <a class="carousel-control-prev" href="#indicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#indicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>

              </div>
            </div>
          </div>
        @endif
        <!-- End  -->
        <!-- Description Box  -->
        <div class="card description">
          <div class="card-header">
            <h5>Description</h5>
          </div>
          <div class="card-body">
            <p class="card-text">{{ @$auction->get->description }}</p>
            <hr />
            <h4>Features</h4>
            <div class="row" style="flex-wrap: wrap;">
              <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                Address: <span class="removeBold">{{ @$auction->get->address }}</span> </div>
              <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> City:
                <span class="removeBold">{{ @$auction->get->city }} </span>
              </div>
              <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                County: <span class="removeBold">{{ @$auction->get->county }} </span></div>
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                  State: <span class="removeBold">{{ @$auction->get->state }} </span></div>
                @if (@$auction->get->listing_date != null)
                  <div class="col-md-12 col-12 pt-2 fw-bold"><i class="fa-regular fa-check-square"></i> Listing Date:
                    <span class="removeBold">{{ date('Y-m-d', strtotime($auction->get->listing_date)) }}
                    </span>
                  </div>
                @endif
                @if (@$auction->get->expiration_date != null)
                  <div class="col-md-12 col-12 pt-2 fw-bold"><i class="fa-regular fa-check-square"></i> Expiration Date:
                    <span class="removeBold"> {{ date('Y-m-d', strtotime($auction->get->expiration_date)) }}
                    </span>
                  </div>
                @endif
                @if (@$auction->get->service_type != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Listing Service Type: <span class="removeBold">{{ @$auction->get->service_type }}</span> </div>
                @endif
                @if (@$auction->get->representation != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Representation: <span class="removeBold">{{ @$auction->get->representation }}</span> </div>
                @endif
                @if (@$auction->get->auction_type != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Listing Type: <span class="removeBold">{{ @$auction->get->auction_type }}</span> </div>
                @endif
                @if (@$auction->get->property_type != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Property Style: <span class="removeBold"> {{ @$auction->get->property_type }} </span></div>
                @endif
                @if (@$auction->get->prop_condition != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Property Condition: <span class="removeBold"> {{ @$auction->get->prop_condition }} </span></div>
                  @endif
                  @if (@$auction->get->special_sale != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Special Sale Provision: <span class="removeBold">{{ @$auction->get->special_sale }} </span></div>
                @endif
            
            <hr>
            <h4>Price and Terms:</h4>
            <hr>
            <div class="d-flex" style="flex-wrap: wrap;">
                  
                @if(@$auction->get->auction_type =='Traditional (No Timer)')
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Traditional Listings:</div>
                <div class="mx-4">
                  @if (@$auction->get->price != null)
                    <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Price: <span class="removeBold"> {{ @$auction->get->price }} </span></div>
                  @endif
                  @if (@$auction->get->escrow_amount2 != null)
                    <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Acceptable Escrow Deposit: <span class="removeBold"> {{ @$auction->get->escrow_amount2 }} </span></div>
                  @endif
                  @if (@$auction->get->closing_days2 != null)
                    <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Number of Days the Seller Will Accept For Closing: <span class="removeBold"> {{ @$auction->get->closing_days2 }} </span></div>
                  @endif
                  @if (@$auction->get->contigencies_accepted_by_seller != null)
                    <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Acceptable Contingencies: <span class="removeBold"> {{ @$auction->get->contigencies_accepted_by_seller }} </span></div>
                  @endif
                  @if (@$auction->get->inspection != null)
                    <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Inspection contingency (days): <span class="removeBold"> {{ @$auction->get->inspection }} </span></div>
                  @endif
                  @if (@$auction->get->appraisal != null)
                    <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Appraisal contingency (days): <span class="removeBold"> {{ @$auction->get->appraisal }} </span></div>
                  @endif
                  @if (@$auction->get->finance != null)
                    <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Finance contingency (days): <span class="removeBold"> {{ @$auction->get->finance }} </span></div>
                  @endif
                  @if (@$auction->get->saleContingency != null)
                    <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Sale of a property contingency (days): <span class="removeBold"> {{ @$auction->get->saleContingency }} </span></div>
                  @endif
                  @if (@$auction->get->acceptable != null)
                    <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Acceptable contingency: <span class="removeBold"> {{ @$auction->get->acceptable }} </span></div>
                  @endif
                  @if (@$auction->get->timeFrame != null)
                    <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Time Frame Allocated to Respond Offers:<span class="removeBold"> {{ @$auction->get->timeFrame }} </span></div>
                  @endif
                  @if (@$auction->get->timeFrame != null)
                    <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Time Frame Allocated to Respond to Multiple Offers:<span class="removeBold"> {{ @$auction->get->timeFrame }} </span></div>
                  @endif
                </div>
              @endif
              @if(@$auction->get->auction_type =='Auction (Timer)')
                <h5>Price and Terms:</h5>
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Auction Listings (Under Seller’s Terms):</div>
                <div class="mx-4">
                  @if (@$auction->get->buy_now_price != null)
                    <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Buy Now Price: <span class="removeBold"> ${{ @$auction->get->buy_now_price }} </span></div>
                  @endif
                  @if (@$auction->get->starting_price != null)
                    <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Starting Price: <span class="removeBold"> ${{ @$auction->get->starting_price }} </span></div>
                  @endif
                  @if (@$auction->get->reserve_price != null)
                    <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Reserve Price: <span class="removeBold"> ${{ @$auction->get->reserve_price }} </span></div>
                  @endif
                  @if (@$auction->get->escrow_amount != null)
                    <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Acceptable Escrow Deposit: <span class="removeBold"> ${{ @$auction->get->escrow_amount }} </span></div>
                  @endif
                  @if (@$auction->get->closing_days != null)
                    <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Number of Days the Seller Will Accept For Closing: <span class="removeBold"> {{ @$auction->get->closing_days }} </span></div>
                  @endif
                  @if (@$auction->get->contigencies_accepted_by_seller != null)
                    <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Acceptable Contingencies: <span class="removeBold"> {{ @$auction->get->contigencies_accepted_by_seller }} </span></div>
                  @endif
                  @if (@$auction->get->inspection != null)
                    <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Inspection contingency (days): <span class="removeBold"> {{ @$auction->get->inspection }} </span></div>
                  @endif
                  @if (@$auction->get->appraisal != null)
                    <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Appraisal contingency (days): <span class="removeBold"> {{ @$auction->get->appraisal }} </span></div>
                  @endif
                  @if (@$auction->get->finance != null)
                    <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Finance contingency (days): <span class="removeBold"> {{ @$auction->get->finance }} </span></div>
                  @endif
                  @if (@$auction->get->saleContingency != null)
                    <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Sale of a property contingency (days): <span class="removeBold"> {{ @$auction->get->saleContingency }} </span></div>
                  @endif
                  @if (@$auction->get->acceptable != null)
                    <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Acceptable contingency: <span class="removeBold"> {{ @$auction->get->acceptable }} </span></div>
                  @endif
                  @if (@$auction->get->sellerOffer != null)
                    <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Is the seller offering a credit to the buyer at closing?<span class="removeBold"> {{ @$auction->get->sellerOffer }} </span></div>
                  @endif
                </div>
              @endif
                @if (@$auction->get->bedrooms != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Bedrooms:
                    <span
                      class="removeBold">{{ @$auction->get->bedrooms != 'Other' ? @$auction->get->bedrooms : @$auction->get->custom_bedrooms }}</span>
                  </div>
                @endif
                @if (@$auction->get->bathrooms != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Bathrooms:
                    <span
                      class="removeBold">{{ @$auction->get->bathrooms != 'Other' ? @$auction->get->bathrooms : @$auction->get->custom_bathrooms }}</span>
                  </div>
                @endif
            
                @if (@$auction->get->financings != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Acceptable Currency/ Financing:
                    @if (gettype(@$auction->get->financings) == 'array')
                      @foreach (@$auction->get->financings as $item)
                        <span class="badge bg-secondary removeBold">
                          <{{ $item }}< /span>
                      @endforeach
                    @endif
                  </div>
                @endif
                @if (@$auction->get->heated_sqft != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Heated sqft: <span class="removeBold"> {{ @$auction->get->heated_sqft }}</span> </div>
                @endif
                @if (@$auction->get->total_sqft != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Total Sqft: <span class="removeBold"> {{ @$auction->get->total_sqft }}</span> </div>
                @endif
                @if (@$auction->get->heated_source != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Heated Sqft Source: <span class="removeBold"> {{ @$auction->get->heated_source }}</span> </div>
                @endif
                @if (@$auction->get->total_aceage != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Total Acreage: <span class="removeBold"> {{ @$auction->get->total_aceage }}</span> </div>
                @endif
                @if (@$auction->get->lot_size != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Lot Size Square Footage: <span class="removeBold"> {{ @$auction->get->lot_size }}</span> </div>
                @endif
                @if (@$auction->get->year_built != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Year
                    Built: <span class="removeBold"> {{ @$auction->get->year_built }}</span> </div>
                @endif
                @if (@$auction->get->has_furnishing != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Are there any furnishings included in the purchase? <span class="removeBold"> {{ @$auction->get->has_furnishing }}</span> </div>
                @endif
                @if (@$auction->get->interior_features != null && @$auction->get->interior_features != 'null')
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Interior Features:
                    @if (gettype(@$auction->get->interior_features) == 'array')
                      @foreach (@$auction->get->interior_features as $item)
                        @if($item != 'Other')
                          <span class="badge bg-secondary removeBold"> {{ $item }}</span>
                        @endif
                        @if($item == 'Other')
                          <span class="badge bg-secondary removeBold"> {{ @$auction->get->otherInterior }}</span>
                        @endif
                      @endforeach
                    @endif
                  </div>
                @endif
                @if (@$auction->get->additionalRooms != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Additional Rooms: <span class="removeBold"> {{ @$auction->get->additionalRooms }}</span> </div>
                @endif
                @if (@$auction->get->approximate_room_dimensions != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Approximate Room Dimensions: <span class="removeBold"> {{ @$auction->get->approximate_room_dimensions }}</span> </div>
                @endif
                @if (@$auction->get->room_type != null && @$auction->get->room_type != 'null')
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Room Type:
                    @if (gettype(@$auction->get->room_type) == 'array')
                      @foreach (@$auction->get->room_type as $item)
                        <span class="badge bg-secondary removeBold"> {{ $item }}</span>
                      @endforeach
                    @endif
                  </div>
                @endif
                @if (@$auction->get->room_level != null && @$auction->get->room_level != 'null')
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Room Level:
                    @if (gettype(@$auction->get->room_level) == 'array')
                      @foreach (@$auction->get->room_level as $item)
                        <span class="badge bg-secondary removeBold"> {{ $item }}</span>
                      @endforeach
                    @endif
                  </div>
                @endif
                @if (@$auction->get->bed_room_closest_type != null && @$auction->get->bed_room_closest_type != 'null')
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Bedroom Closet Type:
                    @if (gettype(@$auction->get->bed_room_closest_type) == 'array')
                      @foreach (@$auction->get->bed_room_closest_type as $item)
                        <span class="badge bg-secondary removeBold"> {{ $item }}</span>
                      @endforeach
                    @endif
                  </div>
                @endif
                @if (@$auction->get->room_primary_floor_covering != null && @$auction->get->room_primary_floor_covering != 'null')
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Room Primary Covering:
                    @if (gettype(@$auction->get->room_primary_floor_covering) == 'array')
                      @foreach (@$auction->get->room_primary_floor_covering as $item)
                        <span class="badge bg-secondary removeBold"> {{ $item }}</span>
                      @endforeach
                    @endif
                  </div>
                @endif
                @if (@$auction->get->room_feature != null && @$auction->get->room_feature != 'null')
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Room Features:
                    @if (gettype(@$auction->get->room_feature) == 'array')
                      @foreach (@$auction->get->room_feature as $item)
                      @if($item != 'Other')
                        <span class="badge bg-secondary removeBold"> {{ $item }}</span>
                      @endif
                      @if($item == 'Other')
                        <span class="badge bg-secondary removeBold"> {{ @$auction->get->custom_room_features }}</span>
                      @endif
                      @endforeach
                    @endif
                  </div>
                @endif
                @if (@$auction->get->number_of_buildings != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Number of Floors in the Property: <span class="removeBold"> {{ @$auction->get->number_of_buildings }}</span> </div>
                @endif
                @if (@$auction->get->floors_in_unit != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Floor Number: <span class="removeBold"> {{ @$auction->get->floors_in_unit }} </span></div>
                @endif
                @if (@$auction->get->total_floors != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Number of Floors in the Entire Building: <span class="removeBold"> {{ @$auction->get->total_floors }} </span></div>
                @endif
                @if (@$auction->get->building_elevator != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Building Elevator: <span class="removeBold"> {{ @$auction->get->building_elevator }} </span></div>
                @endif
                @if (@$auction->get->floor_covering != null && @$auction->get->floor_covering != 'null')
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                  Floor Covering:
                  @if (gettype(@$auction->get->floor_covering) == 'array')
                    @foreach (@$auction->get->floor_covering as $item)
                      @if($item != 'Other')
                      <span class="badge bg-secondary removeBold"> {{ $item }}</span>
                      @endif
                      @if($item == 'Other')
                      <span class="badge bg-secondary removeBold"> {{ @$auction->get->otherFloorCovering }}</span>
                      @endif
                    @endforeach
                  @endif
                </div>
                @endif
                @if (@$auction->get->front_exposure != null)
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                  Front Exposure: <span class="removeBold"> {{ @$auction->get->front_exposure }} </span></div>
                @endif
                @if (@$auction->get->foundation != null && @$auction->get->foundation != 'null')
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Foundation:
                    @if (gettype(@$auction->get->foundation) == 'array')
                      @foreach (@$auction->get->foundation as $item)
                        @if($item != 'Other')
                        <span class="badge bg-secondary removeBold"> {{ $item }}</span>
                        @endif
                        @if($item == 'Other')
                        <span class="badge bg-secondary removeBold"> {{ @$auction->get->otherFoundation }}</span>
                        @endif
                      @endforeach
                    @endif
                  </div>
                @endif
                @if (@$auction->get->exterior_construction != null && @$auction->get->exterior_construction != 'null')
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Exterior Construction:
                    @if (gettype(@$auction->get->exterior_construction) == 'array')
                      @foreach (@$auction->get->exterior_construction as $item)
                        @if($item != 'Other')
                        <span class="badge bg-secondary removeBold"> {{ $item }}</span>
                        @endif
                        @if($item == 'Other')
                        <span class="badge bg-secondary removeBold"> {{ @$auction->get->otherConstruction }}</span>
                        @endif
                      @endforeach
                    @endif
                  </div>
                @endif
                @if (@$auction->get->exterior_feature != null && @$auction->get->exterior_feature != 'null')
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Exterior Features:
                    @if (gettype(@$auction->get->exterior_feature) == 'array')
                      @foreach (@$auction->get->exterior_feature as $item)
                        @if($item != 'Other')
                        <span class="badge bg-secondary removeBold"> {{ $item }}</span>
                        @endif
                        @if($item == 'Other')
                        <span class="badge bg-secondary removeBold"> {{ @$auction->get->otherExterior }}</span>
                        @endif
                      @endforeach
                    @endif
                  </div>
                @endif
                @if (@$auction->get->lot_features != null && @$auction->get->lot_features != 'null')
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Lot Features:
                    @if (gettype(@$auction->get->lot_features) == 'array')
                      @foreach (@$auction->get->lot_features as $item)
                        @if($item != 'Other')
                        <span class="badge bg-secondary removeBold"> {{ $item }}</span>
                        @endif
                        @if($item == 'Other')
                        <span class="badge bg-secondary removeBold"> {{ @$auction->get->otherLotFeature }}</span>
                        @endif
                      @endforeach
                    @endif
                  </div>
                @endif
                @if (@$auction->get->otherStructureOpt != null && @$auction->get->otherStructureOpt != 'null')
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Other Structures:
                    @if(@$auction->get->otherStructureOpt == 'Yes' && @$auction->get->otherStructureOpt != 'Other')
                      <span class="badge bg-secondary removeBold"> {{ @$auction->get->otherStruct }}</span>
                    @endif
                    @if(@$auction->get->otherStruct == 'Other')
                      <span class="badge bg-secondary removeBold"> {{ @$auction->get->otherStructure  }}</span>
                    @endif
                  </div>
                @endif
                @if (@$auction->get->roof != null && @$auction->get->roof != 'null')
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Roof:
                    @if (gettype(@$auction->get->roof) == 'array')
                      @foreach (@$auction->get->roof as $item)
                        @if($item != 'Other')
                        <span class="badge bg-secondary removeBold"> {{ $item }}</span>
                        @endif
                        @if($item == 'Other')
                        <span class="badge bg-secondary removeBold"> {{ @$auction->get->otherRoof }}</span>
                        @endif
                      @endforeach
                    @endif
                  </div>
                @endif
                @if (@$auction->get->road_surface_type != null && @$auction->get->road_surface_type != 'null')
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Road Surface Type:
                    @if (gettype(@$auction->get->road_surface_type) == 'array')
                      @foreach (@$auction->get->road_surface_type as $item)
                        @if($item != 'Other')
                        <span class="badge bg-secondary removeBold"> {{ $item }}</span>
                        @endif
                        @if($item == 'Other')
                        <span class="badge bg-secondary removeBold"> {{ @$auction->get->otherSurface }}</span>
                        @endif
                      @endforeach
                    @endif
                  </div>
                @endif
                @if (@$auction->get->garage != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Garage: <span class="removeBold"> {{ @$auction->get->garage }}</span> </div>
                @endif
                @if (@$auction->get->garage_spaces != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Garage Spaces: <span class="removeBold"> {{ @$auction->get->garage_spaces }}</span> </div>
                @endif
                @if (@$auction->get->carport != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                  Carport: <span class="removeBold"> {{ @$auction->get->carport }}</span> </div>
                @endif
                @if (@$auction->get->carport_spaces != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Carport Spaces: <span class="removeBold"> {{ @$auction->get->carport_spaces }}</span> </div>
                @endif
                @if (@$auction->get->pool != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Pool: <span class="removeBold">{{@$auction->get->pool != 'Yes'? @$auction->get->pool:''}}
                      @if(@$auction->get->pool == 'Yes')
                        {{@$auction->get->poolOpt}}
                        @endif
                    </span> </div>
                @endif
                @if (@$auction->get->pool_type != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Pool: <span class="removeBold"> {{ @$auction->get->pool_type }}</span> </div>
                @endif
                @if (@$auction->get->has_water_view != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Water View: <span class="removeBold">{{@$auction->get->has_water_view !='Yes'?'No':''}}
                      @if(@$auction->get->has_water_view == 'Yes')
                        @if (gettype(@$auction->get->water_view) == 'array')
                          @foreach (@$auction->get->water_view as $item)
                            <span class="badge bg-secondary removeBold"> {{ $item }}</span>
                          @endforeach
                        @endif
                      </span> </div>
                      @endif
                @endif
                @if (@$auction->get->has_water_extra != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Water Extras: <span class="removeBold">{{@$auction->get->has_water_extra != 'Yes' ? 'No' : ''}}
                      @if(@$auction->get->has_water_extra == 'Yes')
                        @if (gettype(@$auction->get->water_extras) == 'array')
                          @foreach (@$auction->get->water_extras as $item)
                            <span class="badge bg-secondary removeBold"> {{ $item }}</span>
                          @endforeach
                        @endif
                      </span> </div>
                      @endif
                @endif
                @if (@$auction->get->has_water_fontage != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Water Frontage: <span class="removeBold">{{@$auction->get->has_water_fontage !='Yes'?'No':''}}
                      @if(@$auction->get->has_water_fontage == 'Yes')
                        @if (gettype(@$auction->get->water_frontage) == 'array')
                          @foreach (@$auction->get->water_frontage as $item)
                            <span class="badge bg-secondary removeBold"> {{ $item }}</span>
                          @endforeach
                        @endif
                        @endif
                      </span> 
                  </div>
                @endif
                @if (@$auction->get->viewOpt != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    View: <span class="removeBold">{{@$auction->get->viewOpt !='Yes'?'No':''}}
                      @if(@$auction->get->viewOpt == 'Yes')
                        @if (gettype(@$auction->get->view) == 'array')
                          @foreach (@$auction->get->view as $item)
                            <span class="badge bg-secondary removeBold"> {{ $item !='Other'?$item: @$auction->get->otherView}}</span>
                          @endforeach
                        @endif
                      @endif
                      </span> </div>
                @endif
                @if (@$auction->get->utilities != null && @$auction->get->utilities != 'null')
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Utilities:
                    @if (gettype(@$auction->get->utilities) == 'array')
                      @foreach (@$auction->get->utilities as $item)
                        @if($item != 'Other')
                        <span class="badge bg-secondary removeBold"> {{ $item }}</span>
                        @endif
                        @if($item == 'Other')
                        <span class="badge bg-secondary removeBold"> {{ @$auction->get->otherUtilitise }}</span>
                        @endif
                      @endforeach
                    @endif
                  </div>
                @endif
                @if (@$auction->get->water != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Water: <span class="removeBold">
                        {{@$auction->get->water != 'Other'? @$auction->get->water:(@$auction->get->water == 'Other'?@$auction->get->otherWater:'')}}
                    </span> </div>
                @endif
                @if (@$auction->get->air_conditioning != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Air Conditioning: <span class="removeBold"> {{@$auction->get->air_conditioning !='Other' ? @$auction->get->air_conditioning:(@$auction->get->air_conditioning =='Other' ? @$auction->get->otherAirCondition:'')  }}</span> </div>
                @endif
                @if (@$auction->get->heating_and_fuel != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Heating/Cooling: <span class="removeBold"> {{@$auction->get->heating_and_fuel !='Other' ? @$auction->get->heating_and_fuel:(@$auction->get->heating_and_fuel =='Other' ? @$auction->get->otherHeatingFuel:'')  }}</span> </div>
                @endif
                @if (@$auction->get->ptesAllowed != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Pets Allowed:
                  </div>
                  @if (@$auction->get->acceptablePet != null)
                    <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                      Acceptable Pet Types: <span class="removeBold"> {{ @$auction->get->acceptablePet }}
                      </span>
                    </div>
                    @endif
                    @if (@$auction->get->total_pets_allowed != null)
                      <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                        Number of Pets Allowed: <span class="removeBold"> {{ @$auction->get->total_pets_allowed !='Other' ? @$auction->get->total_pets_allowed: @$auction->get->custom_pets_allowed }}
                        </span>
                      </div>
                    @endif
                @endif
              @if (@$auction->get->max_pet_weight != null)
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Max Pet Weight: <span class="removeBold"> {{ @$auction->get->max_pet_weight }} </span> </div>
              @endif
                @if (@$auction->get->water_view != null && @$auction->get->water_view != 'null')
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Water View:
                    @if (gettype(@$auction->get->water_view) == 'array')
                      @foreach (@$auction->get->water_view as $item)
                        <span class="badge bg-secondary removeBold"> {{ $item }}</span>
                      @endforeach
                    @endif
                  </div>
                @endif
                @if (@$auction->get->has_water_extra != null && @$auction->get->has_water_extra != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Water Extra: <span class="removeBold"> {{ @$auction->get->has_water_extra }}</span> </div>
                @endif
                @if (@$auction->get->water_extras != null && @$auction->get->water_extras != 'null')
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Water Extras:
                    @if (gettype(@$auction->get->water_extras) == 'array')
                      @foreach (@$auction->get->water_extras as $item)
                        <span class="badge bg-secondary removeBold">{{ $item }}</span>
                      @endforeach
                    @endif
                  </div>
                @endif
                @if (@$auction->get->occupant_type != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Occupant Type: 
                    <span class="removeBold"> 
                      @if( @$auction->get->occupant_type != 'Tenant')
                      {{ @$auction->get->occupant_type }}
                      @endif
                      @if( @$auction->get->occupant_type == 'Tenant')
                        @if(@$auction->get->exiting_lease_or_tenant =='Yes, Existing Lease')
                          {{@$auction->get->end_of_lease_date}}
                        @endif
                        @if(@$auction->get->exiting_lease_or_tenant =='Yes, Month to Month')
                          {{@$auction->get->monthToMonth}}
                        @endif
                      @endif
                    </span> 
                  </div>
                @endif
                @if (@$auction->get->has_leasing != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Can the property be leased? <span class="removeBold"> {{ @$auction->get->has_leasing !='Yes' ? @$auction->get->has_leasing: @$auction->get->has_lease_restriction }}
                    </span>
                  </div>
                @endif
                @if (@$auction->get->is_in_flood_zone != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Is the property in a flood zone? <span class="removeBold"> {{ @$auction->get->is_in_flood_zone !='Yes' ? @$auction->get->is_in_flood_zone: @$auction->get->flood_zone_code }}
                    </span>
                  </div>
                @endif
                @if (@$auction->get->has_hoa != null)
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                  Does the property have an HOA, condo association, master association, and/or community fee? <span class="removeBold"> {{ @$auction->get->has_hoa !='Yes'?'No':'' }}
                    @if (gettype(@$auction->get->community_feature) == 'array')
                    @foreach (@$auction->get->community_feature as $item)
                    <span class="badge bg-secondary removeBold">{{ $item }}</span>
                    @endforeach
                    @endif
                  </span>
                </div>
                @endif
                @if (@$auction->get->tax_id != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Tax ID (Parcel Number):<span class="removeBold"> {{ @$auction->get->tax_id }}
                    </span>
                  </div>
                @endif
                @if (@$auction->get->tax_year != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Tax Year: <span class="removeBold"> {{ @$auction->get->tax_year }}
                    </span>
                  </div>
                @endif
                @if (@$auction->get->taxes_annual_amount != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Taxes (Annual Amount): <span class="removeBold"> {{ @$auction->get->taxes_annual_amount }}
                    </span>
                  </div>
                @endif
                @if (@$auction->get->has_homestead != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Additional Parcels: <span class="removeBold"> {{ @$auction->get->has_homestead }}
                    </span>
                  </div>
                @endif
                @if (@$auction->get->total_number_of_parcels != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Total Number of Parcels: <span class="removeBold"> {{ @$auction->get->total_number_of_parcels }}
                    </span>
                  </div>
                @endif
                @if (@$auction->get->additional_tax_id != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Additional Tax ID’s: <span class="removeBold"> {{ @$auction->get->additional_tax_id }}
                    </span>
                  </div>
                @endif
                @if (@$auction->get->zoning != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Zoning: <span class="removeBold"> {{ @$auction->get->zoning }}
                    </span>
                  </div>
                @endif
                @if (@$auction->get->legal_description != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Legal Description: <span class="removeBold"> {{ @$auction->get->legal_description }}
                    </span>
                  </div>
                @endif
                @if (@$auction->get->has_homestead != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Homestead: <span class="removeBold"> {{ @$auction->get->has_homestead }}
                    </span>
                  </div>
                @endif
                @if (@$auction->get->description != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Description: <span class="removeBold"> {{ @$auction->get->description }}
                    </span>
                  </div>
                @endif
                @if (@$auction->get->disclamer != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Legal Disclaimers: <span class="removeBold"> {{ @$auction->get->disclamer }}
                    </span>
                  </div>
                @endif
                @if (@$auction->get->driving_directions != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Driving Directions: <span class="removeBold"> {{ @$auction->get->driving_directions }}
                    </span>
                  </div>
                @endif
                @if (@$auction->get->looking_other_property != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Is the Seller actively seeking to purchase another property? <span class="removeBold"> {{ @$auction->get->looking_other_property !='Yes'? @$auction->get->listing_link:'' }}
                    </span>
                  </div>
                @endif
                @if (@$auction->get->appliances != null && @$auction->get->appliances != 'null')
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Appliances Included:
                    @if (gettype(@$auction->get->appliances) == 'array')
                      @foreach (@$auction->get->appliances as $item)
                        <span class="badge bg-secondary removeBold">
                          @if($item !='Other')
                            {{ $item }}
                          @endif
                          @if($item =='Other')
                            {{ @$auction->get->otherAppliances }}
                          @endif
                        </span>
                      @endforeach
                    @endif
                  </div>
                @endif
                @if (@$auction->get->hoa_community != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    HOA/Community Association: <span class="removeBold"> {{ @$auction->get->hoa_community }}
                    </span>
                  </div>
                @endif
                @if (@$auction->get->hoa_contact != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Contact information for the Association Manager: <span class="removeBold">
                      {{ @$auction->get->hoa_contact }} </span> </div>
                @endif
                @if (@$auction->get->hoa_fee_requirement != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> HOA
                    Fee Requirement: <span class="removeBold"> {{ @$auction->get->hoa_fee_requirement }} </span>
                  </div>
                @endif
                @if (@$auction->get->hoa_fee != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> HOA
                    Fee: <span class="removeBold"> {{ @$auction->get->hoa_fee }} </span> </div>
                @endif
                @if (@$auction->get->hoa_payment_schedule != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> HOA
                    payment schedule: <span class="removeBold"> {{ @$auction->get->hoa_payment_schedule }} </span>
                  </div>
                @endif
                @if (@$auction->get->condo_fee != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Condo Fee: <span class="removeBold"> {{ @$auction->get->condo_fee }} </span> </div>
                @endif
                @if (@$auction->get->condo_payment_schedule != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Condo payment schedule: <span class="removeBold"> {{ @$auction->get->condo_payment_schedule }}
                    </span>
                  </div>
                @endif
                @if (@$auction->get->fee_includes != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Fee Includes:
                    @if (gettype(@$auction->get->fee_includes) == 'array')
                      @foreach (@$auction->get->fee_includes as $item)
                        <span class="badge bg-secondary">{{ $item }}</span>
                      @endforeach
                    @endif
                  </div>
                @endif
                @if (@$auction->get->old_persons_community != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> 55+
                    over community: <span class="removeBold"> {{ @$auction->get->old_persons_community }} </span>
                  </div>
                @endif
                @if (@$auction->get->has_rental_restrictions != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Rental Restrictions: <span class="removeBold"> {{ @$auction->get->has_rental_restrictions }}
                    </span>
                  </div>
                @endif
                @if (@$auction->get->rental_restrictions != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> If
                    Rental Restrictions list: <span class="removeBold"> {{ @$auction->get->rental_restrictions }}
                    </span>
                  </div>
                @endif
                @if (@$auction->get->mls_id != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> MLS
                    ID: <span class="removeBold"> {{ @$auction->get->mls_id }}</span> </div>
                @endif
            </div>
        <hr>
        <h4>Income/commercial property Information</h4>
        <div class="d-flex" style="flex-wrap: wrap;">
          @if (@$auction->get->commercial_total_buildings != null)
            <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
              Total number of buildings: <span class="removeBold"> {{ @$auction->get->commercial_total_buildings }}
              </span></div>
          @endif
          @if (@$auction->get->commercial_total_units != null)
            <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
              Total number of units: <span class="removeBold"> {{ @$auction->get->commercial_total_units }} </span>
            </div>
          @endif
          @if (@$auction->get->commercial_unit_sqft != null)
            <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
              Sqft heated for each unit: <span class="removeBold"> {{ @$auction->get->commercial_unit_sqft }}</span>
          @endif
          @if (@$auction->get->commercial_occupied_or_vacant != null)
            <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Are
              units occupied or vacant? <span class="removeBold">
                {{ @$auction->get->commercial_occupied_or_vacant }}</span>
          @endif
          @if (@$auction->get->commercial_rental_amount != null)
            <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
              Current rental amount: <span class="removeBold"> {{ @$auction->get->commercial_rental_amount }}</span>
          @endif
          @if (@$auction->get->commercial_expected_rental_amount != null)
            <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
              Expected rental amount: <span class="removeBold">
                {{ @$auction->get->commercial_expected_rental_amount }}</span>
          @endif
          @if (@$auction->get->commercial_annual_gross_income != null)
            <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
              Annual gross income: <span class="removeBold">
                {{ @$auction->get->commercial_annual_gross_income }}</span>
          @endif
          @if (@$auction->get->commercial_annual_expenses != null)
            <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
              Annual expenses: <span class="removeBold"> {{ @$auction->get->commercial_annual_expenses }}</span>
          @endif
          @if (@$auction->get->commercial_annual_net_income != null)
            <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
              Annual net income: <span class="removeBold"> {{ @$auction->get->commercial_annual_net_income }}</span>
          @endif
          @if (@$auction->get->commercial_monthly_rent != null)
            <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
              Total monthly rent: <span class="removeBold"> {{ @$auction->get->commercial_monthly_rent }}</span>
          @endif
          @if (@$auction->get->commercial_lease_terms != null)
            <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
              Lease terms: <span class="removeBold"> {{ @$auction->get->commercial_lease_terms }}</span>
          @endif
          @if (@$auction->get->commercial_tenant_pays != null)
            <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
              Tenant pays: <span class="removeBold"> {{ @$auction->get->commercial_tenant_pays }}</span>
          @endif
          @if (@$auction->get->commercial_landlord_pays != null)
            <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
              Landlord pays: <span class="removeBold"> {{ @$auction->get->commercial_landlord_pays }}</span>
          @endif
        </div>
            </div>
            @if (@$auction->get->title_company_name != null)
            <hr>
            <h4>Company Info </h4>
            <div class="d-flex" style="flex-wrap: wrap;">
                @if (@$auction->get->title_company_name != null)
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Name:<span class="removeBold"> {{ @$auction->get->title_company_name }}
                    </span>
                  </div>
                @endif
                @if (@$auction->get->title_company_address != null)
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Address:<span class="removeBold"> {{ @$auction->get->title_company_address }}
                    </span>
                  </div>
                @endif
                @if (@$auction->get->title_company_phone != null)
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                  Phone Number:<span class="removeBold"> {{ @$auction->get->title_company_phone }}
                    </span>
                  </div>
                @endif
                @if (@$auction->get->title_company_email != null)
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Email:<span class="removeBold"> {{ @$auction->get->title_company_email }}
                    </span>
                  </div>
                @endif
              </div>
              @endif
            <hr>
            <h4>Seller’s Agent Info</h4>
            <div class="d-flex" style="flex-wrap: wrap;">
              @if (@$auction->get->agent_first_name != null)
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                  First Name: <span class="removeBold"> {{ @$auction->get->agent_first_name }}</span> </span></div>
              @endif
              @if (@$auction->get->agent_last_name != null)
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                  Last Name: <span class="removeBold"> {{ @$auction->get->agent_last_name }}</span> </span></div>
              @endif
              @if (@$auction->get->agent_phone != null)
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                  Phone Number: <span class="removeBold"> {{ @$auction->get->agent_phone }}</span> </span></div>
              @endif
              @if (@$auction->get->agent_email != null)
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                  Email: <span class="removeBold"> {{ @$auction->get->agent_email }}</span> </span></div>
              @endif
              @if (@$auction->get->agent_brokerage != null)
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                  Brokerage: <span class="removeBold"> {{ @$auction->get->agent_brokerage }}</span> </div>
              @endif
              @if (@$auction->get->agent_license_no != null)
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                  Real Estate License #: <span class="removeBold"> {{ @$auction->get->agent_license_no }}</span> </div>
              @endif
              @if (@$auction->get->agent_mls_id != null)
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> NAR Member ID (NRDS ID): <span class="removeBold"> {{ @$auction->get->agent_mls_id }}</span> </div>
              @endif
              @if (@$auction->get->realEstateAgent != null)
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Listed By: Real Estate Agent: <span class="removeBold"> {{ @$auction->get->realEstateAgent }}</span> </div>
              @endif
            </div>
            <div class="row">
              @if ($auction->get->video != null)
              <div class="col-md-6 col-6 pt-2 fw-bold">Video:
                  <span class="removeBold">
                      <video src="{{ asset($auction->get->video) }}" style="width:100%;height:29vh;"
                          controls autoplay></video>

                      </span>
                  </div>
                  @endif
                  @if ($auction->get->photo != null)
                <div class="col-md-6 col-6 pt-2 fw-bold">Photo:
                  <span class="removeBold">
                    <img src="{{ asset($auction->get->photo) }}" style="width:100%;height:29vh;" />
                  </span>
                </div>
              @endif
          </div>


            <hr>
            <h4>Auction Terms</h4>
            <div class="d-flex" style="flex-wrap: wrap;">
              @if (@$auction->get->price != null)
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                  Price: <span class="removeBold"> {{ @$auction->get->price }}</span> </div>
              @endif
              @if (@$auction->get->term_financings != null)
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                  Acceptable Currency/ Financing:
                  @if (gettype(@$auction->get->term_financings) == 'array')
                    @foreach (@$auction->get->term_financings as $item)
                      <span class="badge bg-secondary removeBold">{{ $item }}</span>
                    @endforeach
                  @endif
                </div>
              @endif
              @if (@$auction->get->escrow_amount != null)
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                  Escrow Amount: <span class="removeBold"> {{ @$auction->get->escrow_amount }} </span></div>
              @endif
              <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                Inspection Period: <span
                  class="removeBold">{{ $bid->inspection_period ?? ($counterView->get->inspection_period ?? '') }}</span>
              </div>
              @if (@$auction->get->closing_days != null)
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                  Number of days seller will accept for closing: <span class="removeBold">
                    {{ @$auction->get->closing_days }} </span></div>
              @endif
              @if (@$auction->get->buyer_agent_commission != null)
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                  Buyer's Agent Commission: <span class="removeBold"> {{ @$auction->get->buyer_agent_commission }}
                  </span></div>
              @endif
              @if (@$auction->get->buyer_premium != null)
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                  Buyer's Premium: <span class="removeBold"> {{ @$auction->get->buyer_premium }} </span></div>
              @endif
              <div class="d-none">
                @if (@$auction->get->seller_premium != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Seller's Premium: <span class="removeBold"> {{ @$auction->get->seller_premium }} </span></div>
                @endif
                @if (@$auction->get->wholesaler_fee != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Wholesaler fee: <span class="removeBold"> {{ @$auction->get->wholesaler_fee }} </span></div>
                @endif
                @if (@$auction->get->builder_fee != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Builder fees to Buyer: <span class="removeBold"> {{ @$auction->get->builder_fee }} </span></div>
                @endif
                @if (@$auction->get->builder_incentives != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Builder Incentives: <span class="removeBold"> {{ @$auction->get->builder_incentives }} </span></div>
                @endif
                @if (@$auction->get->attorney_fee != null)
                  <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                    Attorney Fee to Buyer for contract reviewal: <span class="removeBold">
                      {{ @$auction->get->attorney_fee }} </span></div>
                @endif
              </div>
            </div>
            <div class="d-flex" style="flex-wrap: wrap;">
              @if (@$auction->get->prop_condition != null)
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                  Property condition: <span class="removeBold">{{ @$auction->get->prop_condition }}</span>
                </div>
              @endif
              @if (@$auction->get->known_repairs != null)
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                  Known Repairs that need to be done: <span class="removeBold">
                    {{ @$auction->get->known_repairs }}</span> </div>
              @endif
              @if (@$auction->get->arv != null)
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                  ARV: <span class="removeBold"> {{ @$auction->get->arv }}</span> </div>
              @endif
              @if (@$auction->get->contingencies != null)
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                  Contingencies Seller will accept: <span class="removeBold"> {{ @$auction->get->contingencies }}</span>
                </div>
              @endif
              @if (@$auction->get->title_company != null)
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                  Title Company: <span class="removeBold"> {{ @$auction->get->title_company }}</span> </div>
              @endif
              @if (@$auction->get->title_agent_name != null)
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                  Title Agent Name: <span class="removeBold"> {{ @$auction->get->title_agent_name }}</span> </div>
              @endif
              @if (@$auction->get->title_company_phone != null)
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                  Title Company Phone #: <span class="removeBold"> {{ @$auction->get->title_company_phone }}</span>
                </div>
              @endif
              @if (@$auction->get->title_company_email != null)
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                  Title Company Email: <span class="removeBold"> {{ @$auction->get->title_company_email }}</span> </div>
              @endif
              @if (@$auction->get->looking_other_property != null)
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i> Is
                  Seller looking to purchase another property? <span class="removeBold">
                    {{ @$auction->get->looking_other_property }}</span>
                </div>
              @endif
              @if (@$auction->get->listing_link != null)
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                  Link to listing for Seller’s ad on the Buyer’s auction: <a href="{{ @$auction->get->listing_link }}"
                    target="_blank" rel="noopener noreferrer"><span class="removeBold">
                      {{ @$auction->get->listing_link }}</span></a> </div>
              @endif
              @if (@$auction->get->video_url != '')
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                  Property Video: <a href="{{ @$auction->get->video_url }}" target="_blank"
                    rel="noopener noreferrer"><span class="removeBold"> {{ @$auction->get->video_url }}</span></a>
                </div>
              @endif
              @if (@$auction->get->three_d_tour != '')
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                  3D Tour: <a href="{{ @$auction->get->three_d_tour }}" target="_blank"
                    rel="noopener noreferrer"><span class="removeBold"> {{ @$auction->get->three_d_tour }}</span></a>
                </div>
              @endif
              @if (@$auction->get->explaining_video != '')
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                  Video from agent or seller explaining the property: <a href="{{ @$auction->get->explaining_video }}"
                    target="_blank" rel="noopener noreferrer"><span class="removeBold">
                      {{ @$auction->get->explaining_video }}</span></a> </div>
              @endif
              @if (@$auction->get->note != '')
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1"><i class="fa-regular fa-check-square"></i>
                  Floor plan: <a href="{{ url(@$auction->get->note) }}" target="_blank"
                    class="btn btn-secondary btn-sm">Download Floor Plan</a> </div>
              @endif
              @if (@$auction->get->audio != '')
                <div class="col-md-12 col-12 fw-bold mt-1 mb-1">
                  <audio controls>
                    <source src="{{ url(@$auction->get->audio) }}" type="audio/ogg">
                    Your browser does not support the audio tag.
                  </audio>
                </div>
              @endif
            </div>

          </div>
        </div>
        <!-- End  -->
        <!-- Location Box  -->
        <div class="card location d-none">
          <div class="card-header">
            <h5>Location</h5>
          </div>
          <div class="card-body">
            <div class="locationMap position-relative">
              <img class="w-100" src="https://bidyouroffer.com/wp-content/uploads/2022/09/map-placeholder.jpg"
                alt="">
              <div class="right position-absolute">
                <button class="btn btn-sm"><i class="fa fa-map-marker"></i> View Map</button>
                <button class="btn btn-sm">Get Direction</button>

              </div>
            </div>
            <br>
            <p><b>534 Pinellas Bayway S</b></p>
          </div>
        </div>
        <!-- End  -->
        <!-- Review  -->
        <div class="card review">
          <div class="card-body d-flex align-items-center">
            <div class="left d-flex align-items-center">
              <img class="w-25" src="https://ppt1080.b-cdn.net/images/avatar/none.png" alt="">
              <div>
                <p class="mb-0"><a href="{{ route('author', [@$auction->user_id]) }}"><b>Seller's
                      Agent
                      Details</b></a><span></span>
                  <span class="start opacity-50">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                  </span>
                </p>
                <p class="mb-0">...</p>
                <p class="mb-0 opacity-50">AbbyS1 • last online 5 days ago.</p>
              </div>
            </div>
            <div class="right text-center">
              <a href="author.html"><button class="btn">Message</button></a>
              <a href="author.html"><button class="btn">View Profile</button></a>

            </div>
          </div>
        </div>
        <!-- End  -->
      </div>
      <div class="col-sm-12 col-md-4 col-lg-4 rightCol">
        <h1>{{ @$auction->get->address }}</h1>
        <hr>
        @inject('carbon', 'Carbon\Carbon')
        @php
          if (@$data->get->expiration_date) {
              $start = $carbon::now();
              $end = $carbon::parse($data->get->expiration_date);

              // Check the values of $start and $end for debugging

              $diff = $end->diffInDays($start);
              // Output the difference for debugging purposes
          }
        @endphp
        @if (@$data->get->expiration_date)
          @php
            $diff_d = $diff;
            $diff_H = $start->diff($end)->format('%H');
            $diff_I = $start->diff($end)->format('%I');
            $diff_S = $start->diff($end)->format('%S');
          @endphp
          <div class="time d-flex justify-content-between text-center flex-wrap pb-2">
            <div>
              <h5><b class="timer-d"> {{ $diff_d }} </b></h5>
              <h6 class="opacity-50">Days</h6>
            </div>
            <div>
              <h5><b class="timer-h"> {{ $diff_H }} </b></h5>
              <h6 class="opacity-50">Hrs</h6>
            </div>
            <div>
              <h5><b class="timer-m"> {{ $diff_I }} </b></h5>
              <h6 class="opacity-50">Mins</h6>
            </div>
            <div>
              <h5><b class="timer-s"> {{ $diff_S }} </b></h5>
              <h6 class="opacity-50">Secs</h6>
            </div>
          </div>
        @endif
        @php
          $highest_bid_price = @$auction->get->starting_price;
          $highest_bidder = @$auction->bids->where('price', $highest_bid_price)->first();
          $my_bid = @$auction->bids->where('user_id', $auth_id)->first();
        @endphp
        @if (@$auction->user_id != $auth_id)
          <a href="{{ route('auction-chat', ['seller-property', $auction->id]) }}" class="btn btn-success w-100"> <i
              class="fa-solid fa-paper-plane"></i> Send Message</a>
          <button id="float-button" data-id="{{ $auction->id }}" class="">AI Chat</button>


          {{-- Integrating Pop Up chat --}}

          <div id="chatContainer" class="chat-container" style="width: 629px;">
            <div class="chat-header">
              <h3 style="font-size: 20px;">Chat Support</h3>
              <button id="chatCloseBtn" style="width: 41px;margin-left: 90px!;" class="chat-close-btn">&times;</button>
            </div>

            <div class="chat-input">
              <input type="text" id="messageInput" placeholder="Type your message">
              <button id="sendMessageBtn" class="send-message-btn">Send</button>
            </div>
          </div>
        @endif

        @if ($auth_id)
          @if (in_array(auth()->user()->user_type, ['admin', 'agent']))
            <button class="btn w-100"
              onclick="javascript:window.location='{{ route('seller_property_add_bid', @$auction->id) }}';"
              {{ @$auction->user_id == $auth_id || (@$auction->sold == 1 && $auction->sold_date != null) ? 'disabled' : '' }}>
              <span class="bid">Bid Now </span>
              <span
                class="badge bg-light float-end text-dark">${{ number_format($highest_bid_price, 2, '.', ',') }}</span>
              @if (@$auction->sold)
                <span class="badge bg-danger">Sold</span>
              @endif
            </button>
          @endif
        @else
          <a href="{{ route('login') }}">
            <button class="btn w-100">
              <span class="bid">Login for Bid </span>
              <span
                class="badge bg-light float-end text-dark">${{ number_format($highest_bid_price, 2, '.', ',') }}</span>
            </button>
          </a>
        @endif
        <!-- Highest Bider   -->
        <div class="card higestBider">
          <div class="card-body">
            @if ($highest_bidder)
              <p><b>{{ $highest_bidder->user->name ?? '' }}</b> is the highest bidder.</p>
            @else
              <p>No one has bid on this auction.</p>
            @endif

            <div class="accordion" id="accordionExample">
              @php
                $counterBid = App\Models\PropertyAuctionBid::all();
              @endphp
              {{-- @dd($bids); --}}
              @foreach ($bids as $key => $bid)
                {{-- @if ($loop->last)
                  @dd($bid->get->financing)
                @endif --}}
                @if ($bid->counter_id == null)
                  <div class="accordion-item border-0">
                    <div class="accordion" type="button" data-bs-toggle="collapse"
                      data-bs-target="#item{{ $key + 1 }}" aria-expanded="false"
                      aria-controls="item{{ $key + 1 }}">
                      <div class="d-flex small accordion mr-0 text-center">
                        <div class="col-1">
                          <span class="badge">{{ $loop->iteration }}</span>
                        </div>
                        <div class="col-4">
                          {{ $bid->user->name ?? '' }}
                        </div>
                        @if ($bid->accepted == 'rejected')
                          <div class="col-4 text-right position-relative">
                            ${{ number_format($bid->price, 2, '.', ',') }}
                            <span
                              style="position: absolute; width:65px; margin-left: 54px; right: 0; top: 50%; transform: translateY(-50%); border-top: 2px solid red; z-index: 1;"></span>
                          </div>
                          <div class="col-2 position-relative">
                            <span
                              style="position: absolute; left: 0; right: 0; top: 50%; transform: translateY(-50%); border-top: 2px solid red; z-index: 1;"></span>
                            <span style="position: relative; z-index: 2;">Terms↓</span>
                          </div>
                        @else
                          <div class="col-4 text-right">
                            ${{ number_format($bid->price, 2, '.', ',') }}
                          </div>
                          <div class="col-2">
                            Terms↓
                          </div>
                        @endif

                      </div>
                    </div>
                    <div id="item{{ $key + 1 }}" class="accordion-collapse collapse"
                      aria-labelledby="heading{{ $key + 1 }}" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                        <div id="bidding_history_data">
                          <div>
                            @if ($bid->price)
                              <p class="d-flex justify-content-between small fw-bold">Price:
                                <span class="removeBold">{{ $bid->price }}</span>
                              </p>
                            @endif
                            @php
                              $counterView = App\Models\PropertyAuctionBid::with('meta')->latest('id')->first();
                            @endphp
                            <p class="d-flex justify-content-between small fw-bold">Currency/Financing:
                              <span
                                class="removeBold">{{ $bid->financing ?? ($counterView->get->financing ?? '') }}</span>
                            </p>
                            @if ($bid->escrow_amount)
                              <p class="d-flex justify-content-between small fw-bold">Escrow Amount:
                                <span class="removeBold">{{ $bid->escrow_amount }}</span>
                              </p>
                            @endif
                            @if ($bid->closing_date)
                              <p class="d-flex justify-content-between small fw-bold">Closing Date:
                                <span class="removeBold">{{ $bid->closing_date }}</span>
                              </p>
                            @endif
                            <p class="d-flex justify-content-between small fw-bold">Inspection Period:
                              <span
                                class="removeBold">{{ $bid->inspection_period ?? ($counterView->get->inspection_period ?? '') }}</span>
                            </p>
                            @if ($bid->contingencies != null || $bid->custom_contingencies)
                              <p class="d-flex justify-content-between small fw-bold">Contingencies:
                                <span
                                  class="removeBold">{{ $bid->contingencies == '' ? $bid->get->custom_contingencies : $bid->contingencies }}</span>
                              </p>
                            @endif
                            @if ($bid->seller_premium)
                              <p class="d-flex justify-content-between small fw-bold">Seller Premium:
                                <span class="removeBold">{{ $bid->seller_premium }}</span>
                              </p>
                            @endif

                            @if ($bid->buyer_premium)
                              <p class="d-flex justify-content-between small fw-bold">Buyer Premium:
                                <span class="removeBold">{{ $bid->buyer_premium }}</span>
                              </p>
                            @endif

                            @if ($auction->user_id == $auth_id)
                              @if (optional($bid->get)->video_url)
                                <p>
                                  <a href="{{ $bid->video_url ?? ($counterView->get->video_url ?? '') }}"
                                    class="btn btn-sm btn-primary" target="_blank">View
                                    Video</a>
                                </p>
                              @endif

                              @if (optional($bid->get)->note)
                                <p>
                                  <a href="{{ url($bid->get->note) }}" class="btn btn-sm btn-primary"
                                    target="_blank">Proof
                                    of funds/pre-approval letter</a>
                                </p>
                              @endif
                              @if (optional($bid->get)->card)
                                <p>
                                  <a href="{{ asset($bid->get->card) }}" target="_blank">
                                    <img src="{{ asset($bid->get->card) }}" alt="" style="width: 150px;">
                                  </a>
                                </p>
                              @endif

                              @if (optional($bid->get)->audio)
                                <p>
                                  <audio class="audio-fluid" controls style="width: 100%;">
                                    <source src="{{ asset($bid->get->audio) }}" type="audio/mp3">
                                    Your browser does not support the audio tag.
                                  </audio>
                                </p>
                              @endif
                            @endif
                            @if ($bid->accepted == 'rejected')
                              <div class="bg-danger p-2 borderless row justify-content-center text-white rounded">
                                Rejected</div>
                            @elseif ($bid->accepted != 'rejected')
                              <div class="form-group d-flex justify-content-space gap-1">
                                <div style="flex-grow: 1;">
                                  @if ($auction->user_id == $auth_id && !$auction->sold)
                                    <form action="{{ route('acceptPABid') }}" method="post">
                                      @csrf
                                      <input type="hidden" name="auction_id" value="{{ $auction->id }}">
                                      <input type="hidden" name="bid_id" value="{{ $bid->id }}">
                                      <input type="hidden" name="counterPrice" value="{{ $bid->price }}">
                                      <button type="submit" class="btn btn-success">Accept</button>
                                    </form>
                                  @endif
                                </div>
                                <div>
                                  @if ($auction->user_id == $auth_id && !$auction->sold)
                                    <form id="deleteForm" method="post" action="{{ route('rejectPABid') }}">
                                      @csrf
                                      <input type="hidden" name="auction_id" value="{{ $auction->id }}">
                                      <input type="hidden" name="bid_id" value="{{ $bid->id }}">
                                      <button type="button" style="background-color:#da2a43" class="btn btn-danger"
                                        onclick="showToast()">Reject</button>
                                    </form>
                                  @endif
                                </div>
                              </div>

                              {{-- @dd($auction); --}}
                              {{-- @if (auth()->user()->id == $bid->user->id || (auth()->user()->user_type == 'agent' || auth()->user()->user_type == 'admin'))
                              @auth --}}
                              @auth
                                @if (auth()->user()->id == $bid->user->id ||
                                        (auth()->user()->user_type == 'agent' || auth()->user()->user_type == 'admin'))
                                  <div class="form-group biddingOperations">
                                    @if (!$auction->sold)
                                      <form action="{{ route('counterBiding') }}" method="Post">
                                        @csrf
                                        <input type="hidden" name="auction_id" value="{{ $auction->id }}">
                                        <input type="hidden" name="bid_id" value="{{ $bid->id }}">
                                        <input type="number" name="counterAmount" class="form-control" required>
                                        <div class="d-flex gap-1">
                                          <button type="submit" class="btn btn-primary">
                                            Counter Bid
                                          </button>
                                          <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal-{{ isset($bid->id) ? $bid->id : '' }}">
                                            Counter Terms
                                          </button>
                                        </div>
                                      </form>
                                    @endif
                                    @php
                                      $allBids = App\Models\PropertyAuctionBid::where('counter_id', $bid->id)
                                          ->orderByDesc('created_at')
                                          ->get();
                                    @endphp
                                    <div class="form-group">
                                      @foreach ($allBids as $key => $countBid)
                                        <form action="{{ route('acceptPABid') }}" method="post">
                                          @csrf
                                          <input type="hidden" name="auction_id" value="{{ $auction->id }}">
                                          <input type="hidden" name="bid_id" value="{{ $bid->id }}">
                                        </form>
                                      @endforeach
                                    </div>
                                    <div class="form-group">
                                      @if (!$auction->sold)
                                        <table class="table counterAction border-2">
                                          <tbody>
                                            @foreach ($allBids as $key => $countBid)
                                              <tr>
                                                <td>
                                                  <p style="font-size: 15px;">{{ $bid->user->name }}</p>
                                                </td>
                                                <td>
                                                  <p style="font-size: 15px;">{{ $countBid->price }}</p>
                                                </td>
                                                <td>
                                                  <form action="{{ route('acceptPABid') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="auction_id"
                                                      value="{{ $auction->id }}">
                                                    <input type="hidden" name="bid_id" value="{{ $bid->id }}">
                                                    <input type="hidden" name="counterPrice"
                                                      value="{{ $countBid->price }}">
                                                    @if (auth()->user()->user_type == 'agent' || auth()->user()->user_type == 'admin')
                                                      <button type="submit"
                                                        class="badge bg-success p-2 borderless">Accept</button>
                                                    @endif
                                                  </form>
                                                </td>
                                                <td>
                                                  {{-- @if ($auction->user_id == $auth_id && !$auction->sold) --}}
                                                  <form action="{{ route('destroyCounter', $countBid->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @if (auth()->user()->user_type == 'agent' || auth()->user()->user_type == 'admin')
                                                      <button type="submit"
                                                        class="badge bg-danger p-2 borderless">Reject</button>
                                                    @endif
                                                    {{-- @endif --}}
                                                </td>
                                              </tr>
                                            @endforeach
                                          </tbody>
                                        </table>
                                      @endif
                                    </div>
                                  </div>
                                @endauth
                              @endif
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endif
              @endforeach

            </div>
          </div>

        </div>
        <button class="btn w-100 mt-0">
          <span class="bid m-0"><i class="fa fa-user"></i> </span>
        </button>
        <!-- End  -->
        <!-- Details Of Items -->
        <!-- End -->
        <!-- Social Details  -->
        <div class="p-4 card">
          <p class="text-600">Share this link via</p>
          <div class="qr-code" style="width: 100%; height:200px;">
            {{ qr_code(route('view-pl', @$auction->id), 200) }}
          </div>
          <div class="card-social">
            <ul class="icons">
              <a href="">
                <i class="fab fa-facebook-f"></i>
              </a>

              <a href="">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="">
                <i class="fab fa-instagram"></i>
              </a>
              <a href="">
                <i class="fab fa-pinterest"></i>
              </a>
              <a href="">
                <i class="fab fa-linkedin"></i>
              </a>
            </ul>
            <p class="small opacity-8">Or copy link</p>
            <div class="field">
              <i class="fa fa-link"></i>
              <input type="text" readonly="" id="copylink"
                value="https://bidyouroffer.com/listing/534-pinellas-bayway-s-204-tierra-verde-fl-33715-4/">
              <button class="btn-primary btn-sm text-600 js-copy-link text-center border-0"
                style="min-width:60px;">Copy</button>
            </div>

          </div>
        </div>
        <!-- End  -->
      </div>
    </div>
  </div>
  <hr>
  <!-- Recommmended Section  -->
  <div class="container buyerOfferContentDetails">
    <h3 class="text-600 mb-4">Recommended For You</h3>
    <div class="cardsDetails row  justify-content-start">
      <!-- Card 1 -->
      <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
        <div class="card ">
          <img src="https://bidyouroffer.com/wp-content/uploads/2022/10/165522238955562a8b07535346697508007-300x200.jpg"
            class="card-img-top" alt="...">
          <div class="card-body pb-2 pt-2">
            <h5 class="card-title"><a href="">1199 Randall Way, Brownsburg, IN 46112 </a></h5>
            <div class="houseDetails mb-1">
              <span>
                <span class="d-inline-flex justify-content-center align-items-center gap-1"><img
                    src="{{ asset('assets/fontawesome/svgs/thin/bed-front.svg') }}" alt="bed icon" width="15"><b>
                    4</b></span>
                <span class="d-inline-flex justify-content-center align-items-center gap-1"><img
                    src="{{ asset('assets/fontawesome/svgs/thin/bath.svg') }}" alt="bed icon" width="15"><b>
                    2</b></span>
                <span class="d-inline-flex justify-content-center align-items-center gap-1"><img
                    src="{{ asset('assets/fontawesome/svgs/thin/ruler-triangle.svg') }}" alt="bed icon"
                    width="15"><b> 1,643 </b>Sq Ft</span>
              </span>
              - House for sale
            </div>
            <p class="card-text mb-1"><span class="badge bg-secondary">land/lots</span> <span
                class="float-end"><span><b>MLS ID</b></span> <span>#12345</span></p>
            <p class="m-0"><svg xmlns="http://www.w3.org/2000/svg" class="clock" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg><b>28d 03:15:29</b></p>
          </div>
          <div class="card-footer bg-light">
            <div class="row">
              <div class="col-6 left">
                <!-- Barcode  -->
                <svg data-bs-container="body" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"
                  data-bs-placement="top" data-bs-content="Scan Qr Code" xmlns="http://www.w3.org/2000/svg"
                  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z">
                  </path>
                </svg>
                <svg data-bs-container="body" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"
                  data-bs-placement="top" data-bs-content="Send Message" xmlns="http://www.w3.org/2000/svg"
                  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                  </path>
                </svg>
                <!-- FAvourite  -->
                <svg data-bs-container="body" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"
                  data-bs-placement="top" data-bs-content="Add Favorites" xmlns="http://www.w3.org/2000/svg"
                  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                  </path>
                </svg>
              </div>
              <div class="col-6 right text-end">
                <b>$1,000</b>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Card 2 -->
      <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
        <div class="card ">
          <img src="https://bidyouroffer.com/wp-content/uploads/2022/10/165522238955562a8b07535346697508007-300x200.jpg"
            class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title"><a href="">1199 Randall Way, Brownsburg, IN 46112 </a></h5>
            <div class="houseDetails">
              <span>
                <span><b>4</b> bds</span>
                <span><b>2</b> ba</span>
                <span><b>1,643</b> sqft</span>
              </span>
              - House for sale
            </div>
            <p class="card-text"><span class="badge bg-secondary">land/lots</span> <span class="float-end"><span><b>MLS
                    ID</b></span> <span>#12345</span></p>
          </div>
          <div class="card-footer bg-light">
            <div class="row">
              <div class="col-6 left">
                <!-- Barcode  -->
                <svg data-bs-container="body" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"
                  data-bs-placement="top" data-bs-content="Scan Qr Code" xmlns="http://www.w3.org/2000/svg"
                  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z">
                  </path>
                </svg>
                <!-- Message  -->
                <svg data-bs-container="body" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"
                  data-bs-placement="top" data-bs-content="Send Message" xmlns="http://www.w3.org/2000/svg"
                  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                  </path>
                </svg>
                <!-- FAvourite  -->
                <svg data-bs-container="body" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"
                  data-bs-placement="top" data-bs-content="Add Favorites" xmlns="http://www.w3.org/2000/svg"
                  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                  </path>
                </svg>
              </div>
              <div class="col-6 right text-end">
                <b>$1,000</b>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  @foreach ($bids as $key => $bid)
    <!-- Modal -->
    <div class="row">
      <div class="col-12">
        <div class="modal fade" id="exampleModal-{{ isset($bid->id) ? $bid->id : '' }}" tabindex="-1"
          aria-labelledby="exampleModalLabel" aria-hidden="true" style="--bs-modal-width:70% !important;"
          aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Counter Terms</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <table class="table">
                  {{-- @php $counterTerms=$bids->where('id', isset($bid->id))->get(); @endphp --}}
                  {{-- @if (isset($counterTerms)) --}}
                  {{-- @if ($counterTerms->id != null)
                      <tr>
                        <th>ID#</th>
                        <td>{{ $counterTerms->id }}</td>
                      </tr>
                    @endif --}}
                  @if (isset($bid->price))
                    <tr>
                      <th>Price:</th>
                      <td>{{ $bid->price }}</td>
                    </tr>
                  @endif
                  @if (isset($bid->get->financing))
                    <tr>
                      <th>Currency/Financing:</th>
                      <td>{{ $bid->get->financing }}</td>
                    </tr>
                  @endif
                  @if (isset($bid->get->escrow_amount))
                    <tr>
                      <th>Offered Escrow Amount(Reserve Terms):</th>
                      <td>{{ $bid->get->escrow_amount }}</td>
                    </tr>
                  @endif
                  @if (isset($bid->get->escrow_amount2))
                    <tr>
                      <th>Offered Escrow Amount(Buy Now Terms):</th>
                      <td>{{ $bid->get->escrow_amount2 }}</td>
                    </tr>
                  @endif
                  @if (isset($bid->get->inspection_period))
                    <tr>
                      <th>Inspection Period(Reserve Terms):</th>
                      <td>{{ $bid->get->inspection_period }}</td>
                    </tr>
                  @endif
                  @if (isset($bid->get->inspection_period2))
                    <tr>
                      <th>Inspection Period(Buy Now Terms):</th>
                      <td>{{ $bid->get->inspection_period2 }}</td>
                    </tr>
                  @endif
                  @if (isset($bid->get->closing_days))
                    <tr>
                      <th>Offered Closing Days(Reserve Terms):</th>
                      <td>{{ $bid->get->closing_days }}</td>
                    </tr>
                  @endif
                  @if (isset($bid->get->closing_days2))
                    <tr>
                      <th>Offered Closing Days(Buy Now Terms):</th>
                      <td>{{ $bid->get->closing_days2 }}</td>
                    </tr>
                  @endif
                  @if (isset($bid->get->desired_days))
                    <tr>
                      <th>Days to Complete the Closing Process:</th>
                      <td>{{ $bid->get->desired_days }}</td>
                    </tr>
                  @endif
                  @if (isset($bid->get->contingencies))
                    <tr>
                      <th>Contingencies:</th>
                      <td>{{ $bid->get->contingencies }}</td>
                    </tr>
                  @endif
                  @if (isset($bid->get->inspection))
                    <tr>
                      <th>Inspection :</th>
                      <td>{{ $bid->get->inspection }}</td>
                    </tr>
                  @endif
                  @if (isset($bid->get->creditForm))
                    <tr>
                      <th>Is the buyer requesting a credit form the seller at closing?</th>
                      <td>{{ $bid->get->creditForm }}</td>
                    </tr>
                  @endif
                  @if (isset($bid->get->offerCredit))
                    <tr>
                      <th>Is the buyer offering a credit to the seller at closing?</th>
                      <td>{{ $bid->get->offerCredit }}</td>
                    </tr>
                  @endif
                  @if (isset($bid->get->buyer_id))
                    <tr>
                      <th>Buyer ID:</th>
                      <td>{{ $bid->get->buyer_id }}</td>
                    </tr>
                  @endif
                  @if (isset($bid->get->video_url))
                    <tr>
                      <th>Personal Video to the Seller:</th>
                      <td>{{ $bid->get->video_url }}</td>
                    </tr>
                  @endif
                  @if (isset($bid->get->proof_of_fund_url))
                    <tr>
                      <th>Proof of funds/Pre-approval letter:</th>
                      <td>{{ $bid->get->proof_of_fund_url }}</td>
                    </tr>
                  @endif
                  {{-- @endif --}}
                </table>
              </div>
              <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- Modal --}}
  @endforeach
@endsection

@push('scripts')
  <!-- jQuery -->
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Toastr JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


  <script>
    // Toastr Options
    toastr.options = {
      "closeButton": true,
      "positionClass": "toast-top-center",
      "preventDuplicates": true,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": 0,
      "extendedTimeOut": 0,
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut",
      "toastClass": "custom-toast"
    };

    // Function to display the Toastr toast notification and confirm before form submission
    function showToast() {
      // Define custom HTML content for the toast message with "Yes" and "No" buttons
      var toastContent =
        '<div><span>Are you sure you want to reject this bid?</span><br><br>' +
        '<div class="d-flex justify-content-between"><button type="button" class="btn btn-danger rounded" onclick="rejectBid()">Confirm</button>' +
        '<button type="button" class="btn btn-secondary border-radius-3" onclick="toastr.clear()">Cancel</button></div></div>';

      // Display custom Toastr notification with HTML content
      toastr.clear(); // Clear any existing toastr notifications
      toastr.info(toastContent, '', {
        closeButton: true,
        timeOut: 0,
        extendedTimeOut: 0
      });
    }

    // Function to handle "Yes" button click
    function rejectBid() {
      // Submit the form or perform any other action
      $('#deleteForm').submit();
    }
  </script>


  <script>
    $("#chatForm").submit(function(e) {

      e.preventDefault(); // avoid to execute the actual submit of the form.

      var form = $(this);
      var actionUrl = form.attr('action');
      var userId = $('#userId').val();
      $.ajax({
        type: "POST",
        url: "{{ route('counterBiding') }}",
        data: {
          _token: "{{ csrf_token() }}",
          id: userId,
          formData: form.serialize() // Serialize the form's elements.
        },
        success: function(response) {
          //   alert(response.success); // show response from the php script.
        }
      });

    });





    var floatButton = document.getElementById("float-button");
    var inbox = document.getElementById("chatContainer");
    var closeButton = document.getElementById("close-button");

    floatButton.addEventListener("click", function() {
      var auction_id = $("#float-button").data("id");
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        url: '/chat_gpt',
        method: 'POST',
        data: {
          auction_id: auction_id,
        },
        success: function(res) {
          // Handle the successful response
          $('#chatContainer').fadeToggle();
          if ($('#chatContainer').find('ul.chat-messages').length > 0) {
            // The chatContainer contains the ul.chat-messages element
            console.log('chatContainer contains ul.chat-messages');
          } else {
            $('#chatContainer').empty();
            $('#chatContainer').append(res.html);
          }

          id = res.id;
        },
        error: function(xhr, status, error) {
          // Handle the error
          console.log(error);
        }
      });

    });
    closeButton.addEventListener("click", function() {
      inbox.classList.remove("visible");
    });
  </script>
  {{-- Message Blade Code --}}

  <script>
    $(document).ready(function() {
      function newMessage() {
        question = $(".message-input").val();
        if ($.trim(question) == '') {
          return false;
        }
        // var sent =
        //     `<li class="sent"><!--<img src="http://emilcarlsson.se/assets/mikeross.png" alt="" / style="background:red;"> --><p>${message}</p></li>`;
        // var reply = `<li class="replies"><p>${message}</p></li>`;

        var sent = `
                <div class="d-flex" style="justify-content:flex-end;">

    <li class="send12" style="border-radius: 10px; background: #184f49; display: inline-block; white-space: normal; padding: 5px; padding-top: 7px; padding-right: 16px; padding-bottom: 11px; max-width: 450px;">
        <span class="ms-2 question_listing" style="font-size: 11px; margin-top: 10px;color:white;">
            ${question}
        </span>
    </li>
</div>
`;

        $('.message-input').val(null);
        $('.chat-messages').append(sent);
        scroll_bottom();
        chat_reply(question);
      };

      function chat_reply(question) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        // Show loader
        var loader = '<div class="loader"></div>';
        $('.chat-messages').append(loader);
        $('.message-input').prop('disabled', true);
        $('#submit12').prop('disabled', true);

        $.ajax({
          type: "POST",
          url: '/chat_gpt_reply',
          data: {
            question: question,
            id: id,
          },
          dataType: "json",
          success: function(response) {
            setTimeout(() => {
              var reply = `
                    <div class="align-items-end" style="display: flex; justify-content: flex-start;">
                        <li class="replies" style="background:#3b5461; display: inline-block; border-radius: 10px; padding: 5px; padding-top: 7px; padding-right: 16px; padding-bottom: 11px; max-width: 450px;">
                            <span class="ms-2" style="font-size: 11px; margin-top: 10px;color:white;">
                                ${response.bestAnswer}
                            </span>
                        </li>
                    </div>`;

              // Remove the loader
              $('.chat-messages .loader').remove();
              // Append the reply
              $('.chat-messages').append(reply);
              $('.message-input').prop('disabled', false);
              $('#submit12').prop('disabled', false);


              scroll_bottom();
            }, 300);
          }
        });
      }

      function scroll_bottom() {

        $(".messages").animate({
          scrollTop: $('.chat-cover').height()
        }, "fast");
      }

      $(document).on('click', '.submit12', function() {
        newMessage();
      });


      $(window).on('keydown', function(e) {
        // alert('ok');
        if (e.which == 13) {

          newMessage();
          return false;
        }
      });

      // copy li / message and send to input field
      $(document).on('click', '#sending_auto', function() {
        var replyValue = $(this).text()
          .trim(); // fetch the text content of the clicked li element and remove any leading/trailing whitespace
        var str = $(".message-input").val(replyValue);
        newMessage();

      });
    });
    $(document).on('click', '#closebutton', function() {
      $('#chatContainer').fadeToggle().fadeOut();


    });
  </script>
  <script>
    // var durations = '2d01h43m45s';
    var durations = '{{ $diff_d }}d{{ $diff_H }}h{{ $diff_I }}m{{ $diff_S }}s';
    $('.timer-d').timer({
      countdown: true,
      duration: durations,
      format: '%d'
    });
    $('.timer-h').timer({
      countdown: true,
      duration: durations,
      format: '%h'
    });
    $('.timer-m').timer({
      countdown: true,
      duration: durations,
      format: '%m'
    });
    $('.timer-s').timer({
      countdown: true,
      duration: durations,
      format: '%s'
    });
  </script>

  {{-- End Message Blade code --}}
@endpush
