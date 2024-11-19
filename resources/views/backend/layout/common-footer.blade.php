<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
<script src="{{ asset('/assets/js/jquery.multi-select.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#branch_list').multiSelect();
        $('#updateBranch').multiSelect();
        $('#filterBranch').multiSelect();
        $('#filterShipmentBranch').multiSelect();

    });
</script>
<!-- Include DataTables JS -->

<script src="https://cdn.datatables.net/v/bs5/dt-2.1.3/datatables.min.js"></script>

<!-- Initialize DataTable -->


<script>
    $(document).ready(function() {
        var tableExample = $('#example').DataTable({
            "pagingType": "simple_numbers",
            "pageLength": 5,
            "language": {
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Prev"
                },
                "emptyTable": "No records available",
                "infoEmpty": "",
                "infoFiltered": ""
            },
            "lengthChange": false,
            "searching": false,
            "info": false,
            "serverSide": false
        });

        
        // DataTable initialization for #shipmentsTable table
      var tableShipments = $('#shipmentsTable').DataTable({
          "pagingType": "simple_numbers",
          "pageLength": 5,
          "language": {
              "paginate": {
                  "first": "First",
                  "last": "Last",
                  "next": "Next",
                  "previous": "Prev"
              },
              "emptyTable": "No records available",
              "infoEmpty": "",
              "infoFiltered": ""
          },
          "lengthChange": false,
          "searching": false,
          "info": false,
           "serverSide": false,

      });
       // Hide the default search box
    //    $('#shipmentsTable_filter').hide(); 

      // Common function to handle custom search and clear actions
      function handleSearchAndClear(table, searchInputSelector, clearIconSelector) {
          $(searchInputSelector).on('keyup', function() {
              table.search(this.value).draw();
              $(this).siblings(clearIconSelector).toggle(!!this.value);
          });

          $(clearIconSelector).on('click', function() {
              var $input = $(this).siblings(searchInputSelector);
              $input.val('');
              table.search('').draw();
              $(this).hide();
          });
      }

      // Apply custom search and clear functionality to #example table
      handleSearchAndClear(tableExample, '#searchInputExample', '.fa-times');

      // Apply custom search and clear functionality to #shipmentsTable
      handleSearchAndClear(tableShipments, '#searchInputShipments', '.fa-times');

   
        
    });
</script>

<!--   Core JS Files   -->

<script src="{{ asset('/assets/js/core/popper.min.js') }}"></script>

<script src="{{ asset('/assets/js/core/bootstrap.min.js') }}"></script>

<script src="{{ asset('/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>

{{-- /* drag and touch scroll plugin js is here  important*/ --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/dragscroll/0.0.8/dragscroll.min.js"></script>

<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('/assets/js/soft-ui-dashboard.min.js?v=1.0.7') }}"></script>
