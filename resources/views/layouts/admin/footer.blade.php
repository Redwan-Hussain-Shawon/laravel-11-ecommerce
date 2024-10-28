@auth
<footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 3.2.0
  </div>
  <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
</div>
@endauth
<!-- jQuery -->
<script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('backend/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('backend/plugins/sweetalert2.js')}}"></script>
<script src="{{asset('backend/plugins/notyf.min.js')}}"></script>

<!-- Check and display the session variable 'swl' -->

<script>
  document.addEventListener('DOMContentLoaded', function () {
         @if(session('swl'))
            Swal.fire({
               title: "{{ session('swl.title', 'Alert') }}",
               text: "{{ session('swl.message') }}",
                icon: "{{ session('swl.type', 'info') }}",
                confirmButtonText: "{{ session('swl.button', 'OK') }}"
            });
        @endif
  });
</script>

<script>
 $(document).ready(function(){
    $('#logout').click(function(e){
      e.preventDefault();
      let link = $(this).attr('href');
      Swal.fire({
        title: 'Are you sure you want to logout?',
        text: '',
        icon: 'warning',
        showDenyButton: true, // Display cancel button
        confirmButtonText: 'Yes, logout!',
        denyButtonText: `No, stay here!`
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = link; 
        } else {
          Swal.fire('Safe Data'); // Alert if not logging out
        }
      });
    });
  });
</script>


<script>
  document.addEventListener('DOMContentLoaded', function () {
      const notyf = new Notyf({
        position: { x: 'right', y: 'top' },
        duration: 4000 // Duration in milliseconds (3000ms = 3 seconds)

      });

      @if(session('notyf'))
          const notyfMessage = @json(session('notyf')); 


          if (notyfMessage.type === 'success') {
              notyf.success(notyfMessage.message); 
          } else if (notyfMessage.type === 'error') {
              notyf.error(notyfMessage.message);
          } else if (notyfMessage.type === 'warning') {
              notyf.warning(notyfMessage.message);
          } else {
              notyf.info(notyfMessage.message); 
          }
      @endif
  });
</script>





</body>

</html>