<!-- Début de la newsletter du magasin -->
<section class="shop-newsletter section" style="background-color: rgb(18, 96, 18);">
    <div class="container">
        <div class="inner-top">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-12">
                    <!-- Début de la partie interne de la newsletter -->
                    <div class="inner text-white">
                        <h1>Newsletter</h1>
                        <p style="font-size: 20px; color: white">Soyez les premiers à profiter de nos offres exclusives</p>
                        <form action="{{route('newsletter.store')}}" method="POST" class="newsletter-inner">
                            @csrf
                            <input name="email" placeholder="Votre adresse email" required="" type="email">
                            <button class="btn" type="submit">S'abonner</button>
                        </form>
                    </div>
                    <!-- Fin de la partie interne de la newsletter -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Fin de la newsletter du magasin -->
