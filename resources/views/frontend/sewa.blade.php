@extends('layouts.frontend')

@section('content')

<header class="bg-dark py-5">
  <div class="container px-4 px-lg-5 my-5">
    <div class="text-center text-white">
      <h1 class="display-4 fw-bolder">Pembayaran</h1>
    </div>
  </div>
</header>
<!-- Section-->
<section class="py-5">
  <div class="card-body card-body-custom pt-10">
    <div class="text-center">
      <h3 class="mb-4">Detail Penyewaan</h3>
      <!-- Mobil -->
      <ul class="list-unstyled list-style-group mx-auto" style="max-width: 400px;">
        <li class="border-bottom p-2 d-flex justify-content-between">
          <span>Mobil </span>
          <span style="font-weight: 600">{{ $bayars->mobil }}</span>
        </li>
        <li class="border-bottom p-2 d-flex justify-content-between">
          <span>Total Harga </span>
          <span style="font-weight: 600">Rp.{{ $bayars->harga_total}}</span>
        </li>
        <li class="border-bottom p-2 d-flex justify-content-between">
          <span>Nama</span>
          <span style="font-weight: 600">{{ $bayars->nama }}</span>
        </li>
        <li class="border-bottom p-2 d-flex justify-content-between">
          <span>Nomor handphone</span>
          <span style="font-weight: 600">{{ $bayars->nomor }}</span>
        </li>
      </ul>
      <button
        type="submit"
        style="height: 50px; width: 400px; margin: 0 auto"
        class="d-block btn btn-primary" id="pay-button">Bayar Sekarang
    </button>
    </div>
  </div>
  

  <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{config('midtrans.clientKey')}}"></script>

  <script type="text/javascript">
  
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');

    payButton.addEventListener('click', function () {
      event.preventDefault();
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token.
      
      window.snap.pay('{{$snapToken}} ', {
        onSuccess: function (result) {
          /* You may add your own implementation here */
          // alert("payment success!"); 
          window.location.href = '/invoice/{{$bayars->orders_id}}'
          console.log(result);
        },
        onPending: function (result) {
          /* You may add your own implementation here */
          alert("wating your payment!"); console.log(result);
        },
        onError: function (result) {
          /* You may add your own implementation here */
          alert("payment failed!"); console.log(result);
        },
        onClose: function () {
          /* You may add your own implementation here */
          alert('you closed the popup without finishing the payment');
        }
      });
    });
  </script>

</section>

@endsection
