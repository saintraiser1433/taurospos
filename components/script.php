  <!-- Libs JS -->
  <script src="../dist/js/jquery-3.5.1.js" type="text/javascript"></script>
  <script src="../dist/libs/list.js/dist/list.min.js?1684106062" defer></script>
  <!-- Tabler Core -->
  <script src="../dist/js/tabler.min.js?1684106062" defer></script>
  <script src="../dist/js/demo.min.js?1684106062" defer></script>
  <script src="../dist/js/list-datable.js"></script>
  <script src="../dist/libs/litepicker/dist/litepicker.js?1692870487"></script>
  <script src="../dist/libs/sweetalert/sweetalert.js"></script>
  <script src="../dist/libs/toastr/toastr.min.js"></script>
  <script src="../dist/libs/litepicker/dist/litepicker.js?1692870487" defer></script>
  <script>
    $(document).ready(function() {
      if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
      }
    });

    document.addEventListener("DOMContentLoaded", function() {
      window.Litepicker && (new Litepicker({
        element: document.getElementById('datepicker-icon-prepend'),
        buttonText: {
          previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
          nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
        },
      }));

      window.Litepicker && (new Litepicker({
        element: document.getElementById('datepicker-to'),
        buttonText: {
          previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
          nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
        },
      }));
    });
  </script>