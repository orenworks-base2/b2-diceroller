<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Dice Roller</title>

	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        
		<link rel="stylesheet" type="text/css" href=" {{ asset( 'css/dice.css' ) }} " />
		
	</head>
	<body>
		<?php 
            $num1 = rand(1,100);
            $num2 = rand(1,100);
            $num3 = rand(1,100);
            $num4 = rand(1,100);
            $num5 = rand(1,100);
        ?>
	<div class="container list-inline">
		<div class="cube1 cube list-inline-item" id="cube">
			<div class="front">
				<span class="fas fa-circle"></span>
			</div>
			<div class="back">
					<pre class="firstPre"><span class="fas fa-circle"></span>    <span class="fas fa-circle"></span>    <span class="fas fa-circle"></span></pre><br>
					<pre class="secondPre"><span class="fas fa-circle"></span>    <span class="fas fa-circle"></span>    <span class="fas fa-circle"></span></pre>
			</div>
			<div class="top">
				<span class="fas fa-circle"></span>
				<span class="fas fa-circle"></span>
			</div>
			<div class="left">
				<span class="fas fa-circle"></span>
				<span class="fas fa-circle"></span>
				<span class="fas fa-circle"></span>

			</div>
			<div class="right">
				<span class="fas fa-circle"></span>
				<span class="fas fa-circle"></span>
				<span class="fas fa-circle"></span>
				<span class="fas fa-circle"></span>
				<span class="fas fa-circle"></span>

			</div>
			<div class="bottom">
				<span class="fas fa-circle"></span>
				<span class="fas fa-circle"></span>
				<span class="fas fa-circle"></span>
				<span class="fas fa-circle"></span>

			</div>
		</div>
		<div class="cube2 cube list-inline-item" id="cube">
        </div>
        <div class="cube3 cube list-inline-item" id="cube">
        </div>
        <div class="cube4 cube list-inline-item" id="cube">
        </div>
        <div class="cube5 cube list-inline-item" id="cube">
        </div>
        <div class=" fixed-bottom">
            <select id="num_dice">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <button id="roll_btn"> roll </button>
        </div>
	</div>
    
	<script>
        $(document).ready(function() {

            $('#num_dice').change(function(){
                var numDice = $(this).val();
                var diceFacesHTML = $('.cube1').html();
                for(let i= 2; i<= 5; i++){
                    $('.cube' + i).html('');
                }
                for(let i= 2; i<= numDice; i++){
                    $('.cube' + i).html(diceFacesHTML.repeat(numDice));
                }
            });


            $('#roll_btn').click(function(){
                
                $('.cube').css('animation', 'animate 2s linear');

                diceNum = $('#num_dice').val();
                updateRotation( diceNum );

            });

            function updateRotation(cubenum) {
                angleArray = [[0,0,0],[-310,-362,-38],[-400,-320,-2],[135,-217,-88],[-224,-317,5],[-47,-219,-81],[-133,-360,-53]];
                
                
                for(var i=1; i<=cubenum; i++){

                    num1 = {{ App\Helpers\Helper::percentageDice($num1,1) }};
                    num2 = {{ App\Helpers\Helper::percentageDice($num2,2) }};
                    num3 = {{ App\Helpers\Helper::percentageDice($num3,3) }};
                    num4 = {{ App\Helpers\Helper::percentageDice($num4,4) }};
                    num5 = {{ App\Helpers\Helper::percentageDice($num5,5) }};
                    
                    switch(i){
                        case 1:
                        num = num1;
                        break;
                        case 2:
                        num = num2;
                        break;
                        case 3:
                        num = num3;
                        break;
                        case 4:
                        num = num4;
                        break;
                        case 5:
                        num = num5;
                        break;
                        case 6:
                        num = num6;
                        break;
                    }


                    $('.cube' + i).css('transform', 'rotateX('+angleArray[num][0]+'deg) rotateY('+angleArray[num][1]+'deg) rotateZ('+angleArray[num][2]+'deg)');
                }
                
                console.log(num1,num2,num3,num4,num5);
            }
        });

    </script>
    
	</body>
</html>