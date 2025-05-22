<!-- Pied de page -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Droits d'auteur &copy; <a href="https://github.com/Prajwal100" target="_blank">Prajwal R.</a> {{date('Y')}}</span>
    </div>
  </div>
</footer>
<!-- Fin du pied de page -->

</div>
<!-- Fin du conteneur de contenu -->

</div>
<!-- Fin du conteneur principal -->

<!-- Bouton pour remonter en haut de la page -->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Modal de déconnexion -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Prêt à partir ?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Fermer">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Sélectionnez "Déconnexion" ci-dessous si vous êtes prêt à mettre fin à votre session actuelle.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
        <a class="btn btn-primary" href="login.html">Déconnexion</a>
      </div>
    </div>
  </div>
</div>

<!-- Scripts JavaScript Bootstrap de base -->
<script src="{{asset('backend/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Plugin JavaScript principal -->
<script src="{{asset('backend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Scripts personnalisés pour toutes les pages -->
<script src="{{asset('backend/js/sb-admin-2.min.js')}}"></script>

<!-- Plugins de niveau page -->
<script src="{{asset('backend/vendor/chart.js/Chart.min.js')}}"></script>

<!-- Scripts personnalisés de niveau page -->
{{-- <script src="{{asset('backend/js/demo/chart-area-demo.js')}}"></script> --}}
<script src="{{asset('backend/js/demo/chart-pie-demo.js')}}"></script>

@stack('scripts')

<script>
  // Masquer les alertes après 4 secondes
  setTimeout(function(){
    $('.alert').slideUp();
  },4000);
</script>
