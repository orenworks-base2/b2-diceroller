<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button id="close_btn" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <img src="{{ asset( 'photo/sucessful-icon.png?v=1.1' ) }}" id="modal_icon" alt="" class="block w-[5.313rem] h-auto mt-6 mb-6 mx-auto">

          <div class="">
            <div class="mb-2 text-[16px] font-bold text-[#FF446B]" id="modal_subject"></div>
            <div class="text-[11px] text-[#8A94B8] px-4" id="modal_desc"></div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button id="close_btn" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function () {


    $('#close_btn').on('click', function (){
      $('#exampleModal').addClass('hidden');
    });
  });
</script>

