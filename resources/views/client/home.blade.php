<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Dice Roller</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        
		<link rel="stylesheet" type="text/css" href=" {{ asset( 'css/dice.css' ) }} " />
		<style>
        .modal-dialog  {
            max-width: 95% !important;
            height: 70% !important;
            }

            .modal-content{
            width: 100% !important;
            height: 70% !important;
            padding: 0% !important;
            }
        </style>
	</head>
	<body class="home-body">
        <?php echo view('template/modal-success-roll'); ?>

	<div class="container_dice list-inline">
        <div id="setting_dice" class="fixed-bottom">
            <button class="dice_btn btn btn-primary" id="roll_btn"> roll </button>
        </div>
        <div class="div_dise">
            <div class="cube1 cube list-inline-item" id="cube">
                <div class="front">
                </div>
                <div class="back">
                </div>
                <div class="top">
                </div>
                <div class="left">
                </div>
                <div class="right">
                </div>
                <div class="bottom">
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
        </div>
	</div>
    
	<script>
        $(document).ready(function() {

            var diceFacesHTML = $('.cube1').html();
            for(let i= 2; i<= 5; i++){
                $('.cube' + i).html(diceFacesHTML.repeat(1));
                $('.cube' + i).hide();
            }
            
            diceNum();

            $('#roll_btn').click(function(){
                getDiceResult();
                $(' #setting_dice ').hide();
                
                setTimeout(successModal,2500);

            });

            $('#modal-success-close2').click(function(){
                window.location.href = '{{ route('web._logout') }}';
            });

            function successModal() {
                for (let cubeIndex = 1; cubeIndex <= 5; cubeIndex++) {
                    $('.cube' + cubeIndex).css({
                        'animation-play-state': 'paused',
                    });
                }

                $('#successModal').show();

                const streamerscontainer_dice = document.getElementById('successModal');
                const startPosition = Math.random() > 0.5 ? 'left' : 'right'; 
                const colors = ['red', 'blue', 'green', 'yellow', 'orange'];

                for (let i = 0; i < 500; i++) {
                    const streamer = document.createElement('div');
                    streamer.classList.add('streamer');

                    const randomColor = colors[Math.floor(Math.random() * colors.length)];
                    streamer.style.backgroundColor = randomColor;

                    const startPosX = Math.random() > 0.5 ? -10 : window.innerWidth + 10;
                    const startPosY = window.innerHeight - 10;
                    streamer.style.left = `${startPosX}px`;
                    streamer.style.top = `${startPosY}px`;
                    streamerscontainer_dice.appendChild(streamer);

                    const targetPosX = window.innerWidth / 2 + (Math.random() * 3000 - 1500);
                    const targetPosY = window.innerHeight / 2 + (Math.random() * 3000 - 1500);

                    setTimeout(() => {
                        streamer.style.transition = 'left 3s ease-out, top 3s ease-out';
                        streamer.style.left = `${targetPosX}px`;
                        streamer.style.top = `${targetPosY}px`;
                    }, 100);

                    setTimeout(() => {
                        streamer.remove();
                    }, 500); 
                }
            }

            function getDiceResult(){

                $.ajax({
                    url: ' {{ route('web.getDiceResult') }} ',
                    method: 'GET',
                    success: function( response ){
                        updateRotation(response.data);
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
                        var numDice = response.data;
                        var diceFacesHTML = $('.cube1').html();
                        
                        for(let i= 2; i<= numDice; i++){
                            $('.cube' + i).show();
                        }
                    },
                    error: function( error ){
                        console.log( error );
                    }
                });
            }

            function updateRotation(result) {
                angleArray = [[0,0,0],[-310,-362,-38],[-400,-320,-2],[135,-217,-88],[-224,-317,5],[-47,-219,-81],[-133,-360,-53]];
                               
                $.each( result, function( index, value ) {
                    cubeIndex = index + 1;
                    $('.cube' + cubeIndex).css('transform', 'rotateX('+angleArray[value][0]+'deg) rotateY('+angleArray[value][1]+'deg) rotateZ('+angleArray[value][2]+'deg)');
                });

                angleArray = [[0,0,0],[-310,-362,-38],[-400,-320,-2],[135,-217,-88],[-224,-317,5],[-47,-219,-81],[-133,-360,-53]];

                $.each(result, function(index, value) {
                    cubeIndex = index + 1;
                    var rotation = angleArray[value];
                    var animationName = 'rotateAnimation' + cubeIndex; 
                    
                    var keyframes = '@keyframes ' + animationName + ' {\
                                        50% { transform: rotateX(145deg) rotateY(165deg) rotateZ(135deg); top: 20%; }\
                                        100% { transform: rotateX(' + rotation[0] + 'deg) rotateY(' + rotation[1] + 'deg) rotateZ(' + rotation[2] + 'deg); top: 40%; }\
                                    }';
                    
                    $('head').append('<style>' + keyframes + '</style>');
                    
                    $('.cube' + cubeIndex).css({
                        'animation-name': animationName,
                        'animation-duration': '2s', 
                        'animation-timing-function': 'linear'
                    });
                });
            }
        });

    </script>
    
	</body>
</html>