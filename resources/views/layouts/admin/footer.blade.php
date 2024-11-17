@auth
<footer class="bg-white  py-3 mx-3 px-4 text-center">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 3.2.0
  </div>
  <strong>Copyright &copy; 2014-2024 <a href="http://innovativeitsoft.com" class="text-center">Innovative It Soft</a>.</strong> All rights reserved.
</footer>



<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
</div>
@endauth
<!-- jQuery -->
<script src="{{asset('public/backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('public/backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('public/backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('public/backend/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('public/backend/plugins/sweetalert2.js')}}"></script>
<script src="{{asset('public/backend/plugins/notyf.min.js')}}"></script>

<!-- DataTables  & Plugins -->
<script src="{{asset('public/backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('public/backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/backend/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('public/backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/backend/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('public/backend/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('public/backend/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('public/backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

<script src="{{asset('public/backend/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('public/backend/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('public/backend/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>


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
  $(document).on('click', '#logout', function(e) {
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

    $(document).on('click', '#deleteBtn', function(e) {
      e.preventDefault();
      let link = $(this).attr('href');
      Swal.fire({
        title:'Are your Want to delete?',
        text:'Once Delete, This will be Permanently Delete!',
        icon:'warning',
        showDenyButton: true, // Display cancel button
        confirmButtonText: 'Yes, Deleted!',
        denyButtonText: `No, stay there!`
      }).then((result)=>{
        if(result.isConfirmed){
          window.location.href=link
        }else{
          Swal.fire('Safe Data')
        }
      })
    })
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {

      const notyf = new Notyf({
        position: { x: 'center', y: 'top' },
        duration: 4000 
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


<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>


@stack('script')

</body>

</html>