<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Twitter -->
        <meta name="twitter:site" content="@themepixels">
        <meta name="twitter:creator" content="@themepixels">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Starlight">
        <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
        <meta name="twitter:image" content="http://themepixels.me/starlight/img/starlight-social.png">

        <!-- Facebook -->
        <meta property="og:url" content="http://themepixels.me/starlight">
        <meta property="og:title" content="Starlight">
        <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

        <meta property="og:image" content="http://themepixels.me/starlight/img/starlight-social.png">
        <meta property="og:image:secure_url" content="http://themepixels.me/starlight/img/starlight-social.png">
        <meta property="og:image:type" content="image/png">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="600">

        <!-- Meta -->
        <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
        <meta name="author" content="ThemePixels">

        <title>Admin Template</title>

        <!-- vendor css -->
        <link href="{{ asset('backend') }}/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="{{ asset('backend') }}/lib/Ionicons/css/ionicons.css" rel="stylesheet">
        <link href="{{ asset('backend') }}/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
        <link href="{{ asset('backend') }}/lib/highlightjs/github.css" rel="stylesheet">
        <link href="{{ asset('backend') }}/lib/datatables/jquery.dataTables.css" rel="stylesheet">
        <link href="{{ asset('backend') }}/lib/select2/css/select2.min.css" rel="stylesheet">
        <link href="{{ asset('backend') }}/lib/rickshaw/rickshaw.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="{{ asset('backend') }}/lib/medium-editor/medium-editor.css" rel="stylesheet">
        <link href="{{ asset('backend') }}/lib/medium-editor/default.css" rel="stylesheet">
        <link href="{{ asset('backend') }}/lib/summernote/summernote-bs4.css" rel="stylesheet">
        <link href="{{ asset('backend') }}/lib/spectrum/spectrum.css" rel="stylesheet">
    
        <!-- Starlight CSS -->
        <link rel="stylesheet" href="{{ asset('backend') }}/css/starlight.css">
        <link href="{{ asset('backend') }}/css/tagsinput.css" rel="stylesheet">
        
        <!-- Sweetalert -->
        <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
        <script src="{{ asset('backend') }}/js/sweetalert.js" type="text/javascript"></script>
        <link rel="stylesheet" href="{{ asset('backend') }}/css/sweetalert.css">
    </head>

    <body>

        <!-- ########## START: LEFT PANEL ########## -->
        @include('backend.partials.sidebar')
        <!-- ########## END: LEFT PANEL ########## -->

        <!-- ########## START: HEAD PANEL ########## -->
        @include('backend.partials.header')
        
        <!-- ########## END: RIGHT PANEL ########## --->

        <!-- ########## START: MAIN PANEL ########## -->
        <div class="sl-mainpanel">
            
            @yield('content')
            
            @include('backend.partials.footer')
        </div><!-- sl-mainpanel -->
        <!-- ########## END: MAIN PANEL ########## -->

        <script src="{{ asset('backend') }}/lib/jquery/jquery.js"></script>
        <script src="{{ asset('backend') }}/lib/popper.js/popper.js"></script>
        <script src="{{ asset('backend') }}/lib/bootstrap/bootstrap.js"></script>
        <script src="{{ asset('backend') }}/lib/jquery-ui/jquery-ui.js"></script>
        <script src="{{ asset('backend') }}/js/tagsinput.min.js"></script>
        <script src="{{ asset('backend') }}/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
        <script src="{{ asset('backend') }}/lib/datatables/jquery.dataTables.js"></script>
        <script src="{{ asset('backend') }}/lib/datatables-responsive/dataTables.responsive.js"></script>
        <script src="{{ asset('backend') }}/lib/select2/js/select2.min.js"></script>
        <script src="{{ asset('backend') }}/lib/spectrum/spectrum.js"></script>
        
        <script>
            $(function(){

              'use strict';

              $('.select2').select2({
                minimumResultsForSearch: Infinity
              });

              // Select2 by showing the search
              $('.select2-show-search').select2({
                minimumResultsForSearch: ''
              });

              // Select2 with tagging support
              $('.select2-tag').select2({
                tags: true,
                tokenSeparators: [',', ' ']
              });

              // Datepicker
              $('.fc-datepicker').datepicker({
                showOtherMonths: true,
                selectOtherMonths: true
              });

              $('#datepickerNoOfMonths').datepicker({
                showOtherMonths: true,
                selectOtherMonths: true,
                numberOfMonths: 2
              });

              // Color picker
              $('#colorpicker').spectrum({
                color: '#17A2B8'
              });

              $('#showAlpha').spectrum({
                color: 'rgba(23,162,184,0.5)',
                showAlpha: true
              });

              $('#showPaletteOnly').spectrum({
                  showPaletteOnly: true,
                  showPalette:true,
                  color: '#DC3545',
                  palette: [
                      ['#1D2939', '#fff', '#0866C6','#23BF08', '#F49917'],
                      ['#DC3545', '#17A2B8', '#6610F2', '#fa1e81', '#72e7a6']
                  ]
              });

            });
          </script>
        
        @yield('admin_script')
        
        <!-- Sweet Alert Delete Post method -->
        <script type="text/javascript">
          $(document).ready(function(){
            $(document).on('click', '#delete', function(){
              var actionTo = $(this).attr('href');
              var token = $(this).attr('data-token');
              var id = $(this).attr('data-id');

              swal({
                title: "Are You Sure?",
                type: "success",
                showCancelButton: true,
                confirmButtonClass: 'btn-success',
                confirmButtonText: 'Yes',
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: false
              },
            function(isConfirm){
              if (isConfirm) {
                $.ajax({
                  url:actionTo,
                  type: 'post',
                  data: {id:id, _token:token},
                  success: function(data){
                    swal({
                      title: "Deleted!",
                      type: "success"
                    },
                    function(isConfirm){
                      if (isConfirm) {
                        $('.' + id).fadeOut();
                      }
                    });
                  }
                });
              }else{
                swal("Cancelled", "", "error");
              }
            });
              return false;
            });
          });
        </script>
        
        <!-- Sweet Alert Confirm Post method -->
        <script type="text/javascript">
          $(document).ready(function(){
            $(document).on('click', '#confirm', function(){
              var actionTo = $(this).attr('href');
              var token = $(this).attr('data-token');
              var id = $(this).attr('data-id');

              swal({
                title: "Are You Sure?",
                type: "success",
                showCancelButton: true,
                confirmButtonClass: 'btn-success',
                confirmButtonText: 'Yes',
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: false
              },
            function(isConfirm){
              if (isConfirm) {
                $.ajax({
                  url:actionTo,
                  type: 'post',
                  data: {id:id, _token:token},
                  success: function(data){
                    swal({
                      title: "Confirm!",
                      type: "success"
                    },
                    function(isConfirm){
                      if (isConfirm) {
                        $('.' + id).fadeOut();
                      }
                    });
                  }
                });
              }else{
                swal("Cancelled", "", "error");
              }
            });
              return false;
            });
          });
        </script>
        
        <script>
            $(function() {
                'use strict';

                $('#datatable1').DataTable({
                    responsive: true,
                    language: {
                        searchPlaceholder: 'Search...',
                        sSearch: '',
                        lengthMenu: '_MENU_ items/page',
                    }
                });

                // $('#datatable2').DataTable({
                //   bLengthChange: false,
                //   searching: false,
                //   responsive: true
                // });

                // // Select2
                // $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

            });

        </script>
        
        <script src="{{ asset('backend') }}/lib/jquery.sparkline.bower/jquery.sparkline.min.js"></script>
        <script src="{{ asset('backend') }}/lib/d3/d3.js"></script>
        <script src="{{ asset('backend') }}/lib/rickshaw/rickshaw.min.js"></script>
        <script src="{{ asset('backend') }}/lib/chart.js/Chart.js"></script>
        <script src="{{ asset('backend') }}/lib/Flot/jquery.flot.js"></script>
        <script src="{{ asset('backend') }}/lib/Flot/jquery.flot.pie.js"></script>
        <script src="{{ asset('backend') }}/lib/Flot/jquery.flot.resize.js"></script>
        <script src="{{ asset('backend') }}/lib/flot-spline/jquery.flot.spline.js"></script>
        <script src="{{ asset('backend') }}/lib/summernote/summernote-bs4.min.js"></script>
        <script>
            $(function() {
                'use strict';
                // Summernote editor
                $('#summernote').summernote({
                    height: 150,
                    tooltip: false
                })

                $('#summernote2').summernote({
                    height: 150,
                    tooltip: false
                })

                $('#summernote3').summernote({
                    height: 150,
                    tooltip: false
                })

                $('#summernote4').summernote({
                    height: 150,
                    tooltip: false
                })
            });

        </script>

        <script src="{{ asset('backend') }}/js/starlight.js"></script>
        <script src="{{ asset('backend') }}/js/ResizeSensor.js"></script>
        <script src="{{ asset('backend') }}/js/dashboard.js"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            @if (Session::has('message'))
                var type ="{{ Session::get('alert-type', 'info') }}"
                switch(type){
                case 'info':
                toastr.info(" {{ Session::get('message') }} ");
                break;

                case 'success':
                toastr.success(" {{ Session::get('message') }} ");
                break;

                case 'warning':
                toastr.warning(" {{ Session::get('message') }} ");
                break;

                case 'error':
                toastr.error(" {{ Session::get('message') }} ");
                break;
                }
            @endif

        </script>
        
        
        
        
    </body>
</html>
