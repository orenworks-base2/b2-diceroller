
<!-- Modal HTML -->
<div id="error-modal" class="modal fade">
	<div class="modal-dialog modal-dialog-error modal-confirm modal-confirm-error">
		<div class="modal-content modal-content-error">
			<div class="modal-header modal-header-error justify-content-center">
				<div class="icon-box">
					<i class="material-icons">&#xE5CD;</i>
				</div>
				<button id="modal-error-close" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body text-center">
				<h4>Ooops!</h4>	
				<p id="modal_error_body"></p>
				<button id="modal-error-close2" class="btn btn-success" data-dismiss="modal">Try Again</button>
			</div>
		</div>
	</div>
</div>     

<script>
    $(document).ready(function() {
        $( '#modal-error-close' ).click(function(){
            $('#error-modal').modal('hide');
        }); 
		$( '#modal-error-close2' ).click(function(){
            $('#error-modal').modal('hide');
        });
    });
</script>

<style>
body {
	font-family: 'Varela Round', sans-serif;
}
.modal-confirm-error {		
	color: #434e65;
	width: 525px;
}
.modal-confirm-error .modal-content-error {
	padding: 20px;
	font-size: 16px;
	border-radius: 5px;
	border: none;
}
.modal-confirm-error .modal-header-error {
	background: #e85e6c;
	border-bottom: none;   
	position: relative;
	text-align: center;
	margin: -20px -20px 0;
	border-radius: 5px 5px 0 0;
	padding: 35px;
}
.modal-confirm-error h4 {
	text-align: center;
	font-size: 36px;
	margin: 10px 0;
}
.modal-confirm-error .form-control, .modal-confirm-error .btn {
	min-height: 40px;
	border-radius: 3px; 
}
.modal-confirm-error .close {
	position: absolute;
	top: 15px;
	right: 15px;
	color: #fff;
	text-shadow: none;
	opacity: 0.5;
}
.modal-confirm-error .close:hover {
	opacity: 0.8;
}
.modal-confirm-error .icon-box {
	color: #fff;		
	width: 95px;
	height: 95px;
	display: inline-block;
	border-radius: 50%;
	z-index: 9;
	border: 5px solid #fff;
	padding: 15px;
	text-align: center;
}
.modal-confirm-error .icon-box i {
	font-size: 58px;
	margin: -2px 0 0 -2px;
}
.modal-confirm-error .modal-dialog-error {
	margin-top: 80px;
}
.modal-confirm-error .btn, .modal-confirm-error .btn:active {
	color: #fff;
	border-radius: 4px;
	background: #eeb711 !important;
	text-decoration: none;
	transition: all 0.4s;
	line-height: normal;
	border-radius: 30px;
	margin-top: 10px;
	padding: 6px 20px;
	min-width: 150px;
	border: none;
}
.modal-confirm-error .btn:hover, .modal-confirm-error .btn:focus {
	background: #eda645 !important;
	outline: none;
}
.trigger-btn {
	display: inline-block;
	margin: 100px auto;
}
</style>