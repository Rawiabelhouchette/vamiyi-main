<style>
    /* if mobile */
    @media (max-width: 768px) {
        #footer-div {
            display: none;
        }

        #footer-div-sm {
            display: block !important;
            height: 50px !important;
        }
    }

    /* if desktop */
    @media (min-width: 769px) {
        #footer-div {
            display: block !important;
        }

        #footer-div-sm {
            display: none;
        }
    }
</style>

<footer class="main-footer" id="footer-div" style="z-index: 1;">
    <div class="row">
        <div class="col-md-6 col-sm-12" style="text-align: left !important;">
            <strong>&copy; Copyright {{ date('Y') }} <a href="{{ route('accueil') }}" style="color: #ff3a72;">Numrod</a> </strong> Tous droits réservés.
        </div>

        <div class="col-md-6 col-sm-12" style="text-align: right !important;">
            <strong>Version Janvier 2023</strong>
        </div>
    </div>
</footer>

<footer class="main-footer" id="footer-div-sm" style="z-index: 1; display: none;">
    <div class="row">
        <div class="col-12 text-center">
            <strong>&copy; Copyright {{ date('Y') }} <a href="{{ route('accueil') }}" style="color: #ff3a72;">Numrod</a> </strong> Tous droits réservés.
        </div>

        <div class="col-12 text-center" style="padding-top: 13px;">
            <strong>Version Janvier 2023</strong>
        </div>
    </div>
</footer>
