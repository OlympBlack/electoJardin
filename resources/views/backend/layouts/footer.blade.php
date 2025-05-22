<!-- Footer -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
            <span> &copy; Electro Jardin {{date('Y')}} &copy;</span>
    </div>
  </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top" aria-label="Scroll to top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutModalLabel">Prêt à partir ?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Fermer">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">Sélectionnez "Déconnexion" ci-dessous si vous souhaitez terminer votre session.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>

        <!-- Formulaire logout sécurisé Laravel -->
        <form method="POST" action="{{ route('logout') }}" class="d-inline">
          @csrf
          <button type="submit" class="btn btn-primary">Déconnexion</button>
        </form>

      </div>
    </div>
  </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('backend/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('backend/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
{{-- <script src="{{ asset('backend/js/demo/chart-area-demo.js') }}"></script> --}}
{{-- <script src="{{ asset('backend/js/demo/chart-pie-demo.js') }}"></script> --}}

@stack('scripts')

<script>
  setTimeout(function(){
    $('.alert').slideUp();
  }, 4000);
</script>
