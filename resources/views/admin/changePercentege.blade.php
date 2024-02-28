<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Dice Roller Controller</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<link rel="stylesheet" type="text/css" href=" {{ asset( 'css/dice.css' ) }} " />
		
	</head>
	<body>
        <h2 class="text-center">Dice Roller Controller</h2>
        <div id="diceController" class="container">
            <div class="row">
                <label class="col-sm">Dice Number</label>
                <label class="col-sm">Percentage Number 1</label>
                <label class="col-sm">Percentage Number 2</label>
                <label class="col-sm">Percentage Number 3</label>
                <label class="col-sm">Percentage Number 4</label>
                <label class="col-sm">Percentage Number 5</label>
                <label class="col-sm">Percentage Number 6</label>
                <label class="col-sm">Total</label>
            </div>
            <div class="dice row" id="dice1">
                <input class="col-sm" type="text" id="dice1_num" value="1" readonly>
                <input class="col-sm dice_input" type="text" id="dice1_num1">
                <input class="col-sm dice_input" type="text" id="dice1_num2">
                <input class="col-sm dice_input" type="text" id="dice1_num3">
                <input class="col-sm dice_input" type="text" id="dice1_num4">
                <input class="col-sm dice_input" type="text" id="dice1_num5">
                <input class="col-sm dice_input" type="text" id="dice1_num6">
                <input class="col-sm" type="text" id="dice1_total" readonly>
            </div>
            <div class="row" id="dice2">
                <input class="col-sm" type="text" id="dice2_num" value="2" readonly>
                <input class="col-sm dice_input" type="text" id="dice2_num1">
                <input class="col-sm dice_input" type="text" id="dice2_num2">
                <input class="col-sm dice_input" type="text" id="dice2_num3">
                <input class="col-sm dice_input" type="text" id="dice2_num4">
                <input class="col-sm dice_input" type="text" id="dice2_num5">
                <input class="col-sm dice_input" type="text" id="dice2_num6">
                <input class="col-sm" type="text" id="dice2_total" readonly>
            </div>
            <div class="row" id="dice3">
                <input class="col-sm" type="text" id="dice3_num" value="3" readonly>
                <input class="col-sm dice_input" type="text" id="dice3_num1">
                <input class="col-sm dice_input" type="text" id="dice3_num2">
                <input class="col-sm dice_input" type="text" id="dice3_num3">
                <input class="col-sm dice_input" type="text" id="dice3_num4">
                <input class="col-sm dice_input" type="text" id="dice3_num5">
                <input class="col-sm dice_input" type="text" id="dice3_num6">
                <input class="col-sm" type="text" id="dice3_total" readonly>
            </div>
            <div class="row" id="dice4">
                <input class="col-sm" type="text" id="dice4_num" value="4" readonly>
                <input class="col-sm dice_input" type="text" id="dice4_num1">
                <input class="col-sm dice_input" type="text" id="dice4_num2">
                <input class="col-sm dice_input" type="text" id="dice4_num3">
                <input class="col-sm dice_input" type="text" id="dice4_num4">
                <input class="col-sm dice_input" type="text" id="dice4_num5">
                <input class="col-sm dice_input" type="text" id="dice4_num6">
                <input class="col-sm" type="text" id="dice4_total" readonly>
            </div>
            <div class="row" id="dice5">
                <input class="col-sm" type="text" id="dice5_num" value="5" readonly>
                <input class="col-sm dice_input" type="text" id="dice5_num1">
                <input class="col-sm dice_input" type="text" id="dice5_num2">
                <input class="col-sm dice_input" type="text" id="dice5_num3">
                <input class="col-sm dice_input" type="text" id="dice5_num4">
                <input class="col-sm dice_input" type="text" id="dice5_num5">
                <input class="col-sm dice_input" type="text" id="dice5_num6">
                <input class="col-sm" type="text" id="dice5_total" readonly>
            </div>

            <select id="num_dice">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>

            <form id="form_dice" onsubmit=" event.preventDefault(); ">
                <button class="btn" id="save_btn"> Save </button>
            </form>

        </div>
        
    </body>
    <script>
        $(document).ready(function() {
            getDicePercentage();
            diceNum();
            $( '#save_btn' ).click(function(){
                calTotal();
                if( checkTotal() ){
                    storeDicePercentage();
                }else{
                    alert('each dice must have total 100 percentage.');
                }
            });

            let debounceTimer;
            $( '.dice_input' ).on( 'keydown keypress', function(e) {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(calTotal, 300); 
            } );

        });

        
        function getDicePercentage(){

            $.ajax({
                url: ' {{ route('admin.getPercentage') }} ',
                method: 'get',
                success: function( response ){

                    $.each( response.data, function( index, value ) {

                        num1 = value.num1;
                        num2 = value.num2 - value.num1;
                        num3 = value.num3 - value.num2;
                        num4 = value.num4 - value.num3;
                        num5 = value.num5 - value.num4;
                        num6 = value.num6 - value.num5;

                        diceIndex= index + 1;

                        $( '#dice' + diceIndex +'_num1' ).val(num1);
                        $( '#dice' + diceIndex +'_num2' ).val(num2);
                        $( '#dice' + diceIndex +'_num3' ).val(num3);
                        $( '#dice' + diceIndex +'_num4' ).val(num4);
                        $( '#dice' + diceIndex +'_num5' ).val(num5);
                        $( '#dice' + diceIndex +'_num6' ).val(num6);

                    });

                    calTotal();
                },
                error: function( error ){
                    console.log( error );
                }
            });
        }

        function diceNum(){
            $.ajax({
                url: ' {{ route('web.getDiceNumber') }} ',
                method: 'GET',
                success: function( response ){
                    $( '#num_dice' ).val( response.data );
                },
                error: function( error ){
                    console.log( error );
                }
            });
        }

        function storeDicePercentage(){
            var diceNum = $( '#num_dice' ).val();
            var diceData = {
                num1: [
                    $('#dice1_num1').val(),
                    $('#dice2_num1').val(),
                    $('#dice3_num1').val(),
                    $('#dice4_num1').val(),
                    $('#dice5_num1').val()
                ],
                num2: [
                    $('#dice1_num2').val(),
                    $('#dice2_num2').val(),
                    $('#dice3_num2').val(),
                    $('#dice4_num2').val(),
                    $('#dice5_num2').val()
                ],
                num3: [
                    $('#dice1_num3').val(),
                    $('#dice2_num3').val(),
                    $('#dice3_num3').val(),
                    $('#dice4_num3').val(),
                    $('#dice5_num3').val()
                ],
                num4: [
                    $('#dice1_num4').val(),
                    $('#dice2_num4').val(),
                    $('#dice3_num4').val(),
                    $('#dice4_num4').val(),
                    $('#dice5_num4').val()
                ],
                num5: [
                    $('#dice1_num5').val(),
                    $('#dice2_num5').val(),
                    $('#dice3_num5').val(),
                    $('#dice4_num5').val(),
                    $('#dice5_num5').val()
                ],
                num6: [
                    $('#dice1_num6').val(),
                    $('#dice2_num6').val(),
                    $('#dice3_num6').val(),
                    $('#dice4_num6').val(),
                    $('#dice5_num6').val()
                ]
            };

            $.ajax({
                url: ' {{ route('admin.changedicePercentage') }} ',
                method: 'POST',
                data: {
                    diceData: diceData,
                    diceNum: diceNum,
                    _token: '{{ csrf_token() }}',
                },
                success: function( response ){
                    alert(" Save percentage successful. ");
                },
                error: function( error ){
                    console.log( error );
                }
            });
            
        }

        function calTotal(){
            for(let i = 1; i <= 5; i++){

                let total = 0;

                for (let j = 1; j <= 6; j++) {
                    total += parseInt($('#dice' + i + '_num' + j).val()) || 0;
                }

                $( '#dice' + i + '_total' ).val( total );
            }
        }

        function checkTotal(){
            let checkTotal = true;
            for(let i = 1; i <= 5; i++){
                if ( $( '#dice' + i + '_total' ).val() != 100){
                    checkTotal = false;
                }
            }
            return checkTotal;
        }

    </script>
</html>