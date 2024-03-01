<style>

body, html {
    height: 100%;
    margin: 0;
    overflow: hidden;
}

.streamer {
    position: absolute;
    width: 2px;
    height: 10px;
    background-color: red;
    pointer-events: none;
    transition: transform 0.5s ease, opacity 0.5s ease;
}


.streamer {
    position: absolute;
    width: 2px;
    height: 10px;
    background-color: red;
    pointer-events: none;
}

.modal {
  display: none; 
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgb(0,0,0);
  background-color: rgba(0,0,0,0.4);
}

.modal-content {
  background-color: #fefefe;
  margin: 15% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

.confetti-left,
.confetti-right {
  position: absolute;
  width: 2px;
  height: 10px;
  background-color: red;
  pointer-events: none;
}

.confetti-left {
  left: -10px;
}

.confetti-right {
  right: -10px;
}
.streamer {
    position: absolute;
    width: 2px;
    height: 10px;
    background-color: red;
    pointer-events: none;
    transition: transform 0.5s ease, opacity 0.5s ease;
}

.modal-body {
    padding: 0% !important;
}
.btn_div{
    margin:20px;
}
</style>

<div id="successModal" class="modal">
        
    <div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-body text-center container_dice" >
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
            <div  class="modal-body text-center btn_div">
				<button id="modal-success-close2" class="btn btn-success" data-dismiss="success-modal"><span>Continue</span> </button>
            </div>
		</div>
	</div>
</div>