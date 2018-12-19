<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SekolahQ</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('tampilan3/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('tampilan3/css/portfolio-item.css') }}" rel="stylesheet">

  </head>

  <body>
  @foreach ($result as $data)

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">SekolahQ</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('lihatPeta')}}">Peta
                <span class="sr-only">(current)</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

      <!-- Portfolio Item Heading -->
      <h1 class="my-4">{{ $data->nama_sekolah}}
        <small><small>(Akreditas {{ $data->akreditasi}})</small></small>
      </h1>

      <!-- Portfolio Item Row -->
      <div class="row">

        <div class="col-md-7">
        @if ($data->jenjang === 'SD')
          <img width="300" class="img-fluid" src="https://2.bp.blogspot.com/-DOIsRcSUX5E/VxuPo9iYEyI/AAAAAAAAW_Q/x6_cRKiKG80gOIQ6-3rLFtTcaGyTiYXEwCLcB/s1600/Logo%2BOSIS%2BSD.png" alt="">
        @elseif ($data->jenjang === 'SMP')
        <img width="300" class="img-fluid" src="https://upload.wikimedia.org/wikipedia/id/2/23/LOGO_OSIS_SMP.png" alt="">
        @else
          <img width="300" class="img-fluid" src="https://upload.wikimedia.org/wikipedia/id/e/ef/LOGO_OSIS_SMA.png" alt="">
        @endif        
        </div>

        <div class="col-md-5">
          <div class="row">
            <div class="col-4"><h6 class="my-3">Alamat</h6></div>
            <div class="col-1">:</div>
            <div class="col">{{ $data->alamat_sekolah}}</div>

            <div class="w-100"></div>
            <div class="col-4"><h6 class="my-3">Telepon</h6></div>
            <div class="col-1">:</div>
            <div class="col">{{ $data->no_telp}}</div>

            <div class="w-100"></div>
            <div class="col-4"><h6 class="my-3">Email</h6></div>
            <div class="col-1">:</div>
            <div class="col">{{ $data->email}}</div>

            <div class="w-100"></div>
            <div class="col-4"><h6 class="my-3">Jenjang</h6></div>
            <div class="col-1">:</div>
            <div class="col">{{ $data->jenjang}}</div>

            <div class="w-100"></div>
            <div class="col-4"><h6 class="my-3">Status</h6></div>
            <div class="col-1">:</div>
            @if ($data->status === '1')
              <div class="col">Negeri</div>
            @else
              <div class="col">Negeri</div>
            @endif  


            <div class="w-100"></div>
            <div class="col-4"><h6 class="my-3">Kurikulum</h6></div>
            <div class="col-1">:</div>
            <div class="col">{{ $data->kurikulum}}</div>

            <div class="w-100"></div>
            <div class="col-4"><h6 class="my-3">Kepala Sekolah</h6></div>
            <div class="col-1">:</div>
            <div class="col">{{ $data->kepala_sekolah}}</div>

            <div class="w-100"></div>
            <div class="col-4"><h6 class="my-3">Total Siswa</h6></div>
            <div class="col-1">:</div>
            <div class="col">{{ $data->total_siswa}} Siswa</div>
          </div>

          <!-- <h3 class="my-3">Project Details</h3>
          <ul>
            <li>Lorem Ipsum</li>
            <li>Dolor Sit Amet</li>
            <li>Consectetur</li>
            <li>Adipiscing Elit</li>
          </ul> -->
        </div>

      </div>
      <!-- /.row -->

      <!-- Related Projects Row -->
      <!-- <h3 class="my-4">Informasi Lainnya</h3>

      <div class="row">

<div class="col-md-3 col-sm-6 mb-4">
  <a href="#">
    <img class="img-fluid" src="http://placehold.it/500x300" alt="">
  </a>
</div>

<div class="col-md-3 col-sm-6 mb-4">
  <a href="#">
    <img class="img-fluid" src="http://placehold.it/500x300" alt="">
  </a>
</div>

<div class="col-md-3 col-sm-6 mb-4">
  <a href="#">
    <img class="img-fluid" src="http://placehold.it/500x300" alt="">
  </a>
</div>

<div class="col-md-3 col-sm-6 mb-4">
  <a href="#">
    <img class="img-fluid" src="http://placehold.it/500x300" alt="">
  </a>
</div> -->

</div>
      <!-- /.row -->

    </div>
    <!-- /.container -->
    @endforeach

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; SekolahQ 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('tampilan3/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('tampilan3/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  </body>

</html>
