<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>@yield('title')</title>
  {{-- styles  --}}
   @include('components.admin.style')
  {{-- end styles  --}}
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    {{-- Sidebar --}}
      @include('components.admin.sidebar')
    {{-- end sidebar --}}

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        {{-- topbar --}}
          @include('components.admin.topbar')
        {{-- end topbar --}}

        {{-- main content  --}}
          @yield('content')
        {{-- end main content  --}}

      </div>
      <!-- End of Main Content -->

      {{-- footer --}}
        @include('components.admin.footer')
      {{-- end footer --}}

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <form class="form-inline" method="post" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-danger" type="submit">Logout</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  {{-- scripts  --}}
  @include('components.admin.script')
  {{-- end scripts --}}

</body>

</html>
