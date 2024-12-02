<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Rental Mobil</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{asset('frontend/css/styles.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('frontend/css/custom.css')}}" />
  </head>
  <body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{route('homepage')}}"><strong>RentalIn</strong></a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" href="{{route('homepage')}}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('contact')}}">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </body>

 {{-- INVOICE --}}
 <section class="py-5">
  <div class="card-body card-body-custom pt-10">
    <div class="invoice-border mx-auto" style="max-width: 450px; border: 2px solid #000; border-radius: 5px; padding: 20px;">
    <div class="text-center">
      <h3 class="mb-4">INVOICE</h3>
      <!-- Mobil -->
      <ul class="list-unstyled list-style-group mx-auto" style="max-width: 400px;">
        <li class="border-bottom p-2 d-flex justify-content-between">
          <span>Nama</span>
          <span style="font-weight: 600">{{ $bayars->nama }}</span>
        </li>
        <li class="border-bottom p-2 d-flex justify-content-between">
          <span>Nomor handphone</span>
          <span style="font-weight: 600">{{ $bayars->nomor }}</span>
        </li>
        <li class="border-bottom p-2 d-flex justify-content-between">
          <span>Mobil </span>
          <span style="font-weight: 600">{{ $bayars->mobil }}</span>
        </li>
        <li class="border-bottom p-2 d-flex justify-content-between">
          <span>Harga </span>
          <span style="font-weight: 600">Rp.{{ $bayars->harga }}</span>
        </li>
        <li class="border-bottom p-2 d-flex justify-content-between">
          <span>Hari </span>
          <span style="font-weight: 600">{{ $bayars->hari }}</span>
        </li>
        <li class="border-bottom p-2 d-flex justify-content-between">
          <span>Total Harga </span>
          <span style="font-weight: 600">Rp.{{ $bayars->harga_total}}</span>
        </li>
        <li class="border-bottom p-2 d-flex justify-content-between">
          <span>Satus</span>
          <span style="font-weight: 600">{{ $bayars->status }}</span>
        </li>
      </ul>
    </div>
  </div>

</html>
