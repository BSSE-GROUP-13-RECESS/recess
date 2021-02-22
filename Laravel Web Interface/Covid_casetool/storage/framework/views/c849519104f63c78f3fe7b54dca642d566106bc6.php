

<?php $__env->startSection('content'); ?>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card mt-5">
          <div class="card-header"><h2>Register Funds Or Distribute Cash</h2></div>
          <div class="card-body">
            <form>
              <div class="form-group row">
                <label for="donor" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Donor')); ?></label>
                <div class="col-md-6">
                  <input id="donor" type="text" class="form-control" name="donor" required autocomplete="donor" autofocus oninput="verify()">
                  <small style="color: red" id="warn1"></small>
                </div>
              </div>
              <div class="form-group row">
                <label for="amount" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Amount')); ?></label>
                <div class="col-md-6">
                  <input id="amount" type="text" class="form-control" name="amount" value="<?php echo e(old('amount')); ?>" required autocomplete="amount" oninput="verify()">
                  <small style="color: red" id="warn2"></small>
                </div>
              </div>
              <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary" id="regbtn">
                    <?php echo e(__('Submit')); ?>

                  </button><br><br>
                </div>
                <div class="col-md-6 offset-md-4">
                  <button type="button" class="btn btn-outline-success" id="dist" onclick="distribute()">
                    <?php echo e(__('Distribute available funds')); ?>

                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    verify();
    function verify(){
      let nm = document.getElementById("donor");
      let user = document.getElementById("amount");
      let warn1 = document.getElementById("warn1");
      let warn2 = document.getElementById("warn2");
      let regbtn = document.getElementById("regbtn");

      warn1.innerText = "";
      warn2.innerText = "";
      regbtn.disabled = false;
      user.value = user.value.trim();

      if(user.value.length<3){
        warn2.innerText += "amount must contain atleast 3 figures\n";
        regbtn.disabled = true;
      }

      if(nm.value.length<3){
        warn1.innerText += "donor name must contain atleast 3 characters\n";
        regbtn.disabled = true;
      }

      if(isNaN(user.value)){
        warn2.innerText = "only numeric characters allowed here\n";
        regbtn.disabled = true;
      }
    }

    $("#regbtn").click(function (event){
      event.preventDefault();

      let name = $("input[name=donor]").val();
      let amount = $("input[name=amount]").val();

      $.ajaxSetup({
        heders: {
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
        }
      });

      $.ajax({
        url: "<?php echo e(url('/fundRegistration')); ?>",
        method: "GET",
        data:{
          name:name,
          amount:amount
        },
        success:function (response){
          document.getElementById("donor").value ="";
          document.getElementById("amount").value ="";
          $.notify(response,"success");
          verify();
        }
      });
    });
    function distribute(){
      if (confirm("Are you sure?")){
        $.ajax({
          url: "<?php echo e(url('/distribute')); ?>",
          method: "GET",
          success:function (response){
            $.notify(response,"success");
          }
        });
      }
    }
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.adminLTE', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/timothy/Desktop/Covid_casetool/resources/views/funds.blade.php ENDPATH**/ ?>