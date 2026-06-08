    <footer class="section white-text center" style="background-color: #1a237e;">
    <p class="flow-text">Journey Masters &copy; 2023</p>
    </footer>

    <!-- query -->
    <script src="js/jquery.js"></script>
    <!-- javascript -->
    <script src="js/materialize.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.scrollspy').scrollSpy();
            $('.slider').slider();
            $('.parallax').parallax();
            $('.tooltipped').tooltip();
            $('.dropdown-trigger').dropdown();
            $('.materialboxed').materialbox();
            $('select').formSelect();
            $('.datepicker').datepicker();
        })
        // sidenav for fixed navbar
        const sideNav = document.querySelector('.sidenav');
        M.Sidenav.init(sideNav, {});
    </script>
    <script>
        let faqs = document.querySelectorAll(".collapsible");
        let faqsInit = M.Collapsible.init(faqs, {
            accordion: false,
        });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var datepickerOptions = {
            format: 'yyyy-mm-dd', // Specify the date format you want
            autoClose: true,
            showClearBtn: true,
        };

        var departureDateInput = document.getElementById('departure_date');
        var returnDateInput = document.getElementById('return_date');

        M.Datepicker.init(departureDateInput, datepickerOptions);
        M.Datepicker.init(returnDateInput, datepickerOptions);
    });
    </script>
