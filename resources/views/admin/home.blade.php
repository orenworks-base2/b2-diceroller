
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Dice Roller Home</title>
    
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
        <!-- End fonts -->

        {{-- datatable --}}
        <link href="{{ asset( 'css/bootstrap.min.css' ) }}" rel="stylesheet" />
        <link href="{{ asset( 'css/bootstrap-extended.css' ) }}" rel="stylesheet" />
        <link href="{{ asset( 'css/dataTables.bootstrap5.min.css' ) }}" rel="stylesheet">
        <link href="{{ asset( 'css/custom.css' ) }}" rel="stylesheet" />
        {{-- End datatable --}}
        <link href="{{ asset( 'css/dice.css' ) }}" rel="stylesheet" />

        {{-- date --}}
        <link href="{{ asset( 'css/flatpickr.min.css' ) }}" rel="stylesheet">
        {{-- End date --}}
        
    </head>
<?php
    $columns = [
            [
                'type' => 'input',
                'placeholder' => 'Search Phone Number',
                'id' => 'phone_number',
                'title' => 'Phone Number' 
            ],
            [
                'type' => 'default',
                'id' => 'result',
                'title' => 'Result' 
            ],
            [
                'type' => 'date',
                'placeholder' => 'Search Create Date',
                'id' => 'created_at',
                'title' => 'Create Date' 
            ],
        ];
?>
    <body> 
        <?php echo view('template/nav'); ?>

        <main class="main_datatable">
            
            <section class="table_phone_number_session">
                <div class="">
                    <div class="table_phone_number_div">
                        <x-data-tables id="result_table" enableFilter="true" enableFooter="false" columns="{{ json_encode( $columns ) }}" />
                     </div>
                </div>
            </section>
            
        </main>
    
    <script>
        window['columns'] = @json( $columns );
        window['ids'] = [];
        
        @foreach ( $columns as $column )
        @if ( $column['type'] != 'default' )
        window['{{ $column['id'] }}'] = '';
        @endif
        @endforeach
        
        var dt_table,
            dt_table_name = '#result_table',
            dt_table_config = {
                ajax: {
                    url: '{{ route( 'admin.getResultUser' ) }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                    },
                    dataSrc: 'user',
                },
                lengthMenu: [
                    [ 15, 25, 50, 999999 ],
                    [ 15, 25, 50, 'all' ]
                ],
                order: [[ 1, 'desc' ]],
                columns: [
                    { data: 'phone_number' },
                    { data: 'result' }, 
                    { data: 'created_at' },
                ],
                columnDefs: [
                    {
                        targets: parseInt('{{ App\Helpers\Helper::columnIndex( $columns, "phone_number" ) }}'),
                        render: function( data, type, row, meta ) {
                            return data ?? '-';
                        },
                    },
                    {
                        targets: parseInt('{{ App\Helpers\Helper::columnIndex( $columns, "result" ) }}'),
                        render: function( data, type, row, meta ) {
                            var dataArray = JSON.parse(data);
                            if (Array.isArray(dataArray)) {
                                return dataArray.join(',');
                            }
                            return '-';
                        },
                    },
                    {
                        targets: parseInt('{{ App\Helpers\Helper::columnIndex( $columns, "created_at" ) }}'),
                        className: 'text-end',
                        render: function( data, type, row, meta ) {
                            if (type === 'display' && data) {
                                var date = new Date(data);
                                
                                var year = date.getFullYear();
                                var month = ('0' + (date.getMonth() + 1)).slice(-2);
                                var day = ('0' + date.getDate()).slice(-2);
                                var hours = ('0' + date.getHours()).slice(-2);
                                var minutes = ('0' + date.getMinutes()).slice(-2);
                                
                                return year + ' ' + month + ' ' + day + ' ' + hours + ':' + minutes;
                            } else {
                                return data; 
                            }
                        },
                    },
                ],
            },
            table_no = 0,
            timeout = null;
    </script>

    {{-- dataTable --}}
    <script src="{{ asset( 'js/dataTable.init.js' ) }}"></script>
    <script src="{{ asset( 'js/jquery-3.5.1.js' ) }}"></script>
    <script src="{{ asset( 'js/jquery.dataTables.min.js' ) }}"></script>
    <script src="{{ asset( 'js/dataTables.bootstrap5.min.js' ) }}"></script>
    <script src="{{ asset( 'js/lucide.min.js' ) }}"></script>
    {{-- End datatable --}}

    <script src="{{ asset( 'js/flatpickr-4.6.13.js' ) }}"></script>


    <script>
        document.addEventListener( 'DOMContentLoaded', function() {
            window['createdDate'] = $( '#created_at' ).flatpickr( {
                mode: 'range',
                disableMobile: true,
                onClose: function( selected, dateStr, instance ) {
                    window[$( instance.element ).data('id')] = $( instance.element ).val();
                    dt_table.draw( false );
                }
            } );
        } );
    </script>
    </body>
</html>


