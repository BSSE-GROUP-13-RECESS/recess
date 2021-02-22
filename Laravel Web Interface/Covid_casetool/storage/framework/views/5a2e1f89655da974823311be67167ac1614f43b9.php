

<?php $__env->startSection('content'); ?>
  <div id="lop">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card mt-5">
          <div class="card-header"><h3><?php echo e(__('Health Officer Registration')); ?></h3></div>
          <div class="card-body">
            <form>
              <?php echo csrf_field(); ?>
              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Name')); ?></label>
                <div class="col-md-6">
                  <input id="name" type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" required autocomplete="name" autofocus oninput="verify()">
                  <small style="color: red" id="warn1"></small>
                </div>
              </div>

              <div class="form-group row">
                <label for="username" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Username')); ?></label>

                <div class="col-md-6">
                  <input id="username" type="text" class="form-control" name="username" value="<?php echo e(old('username')); ?>" required oninput="verify()">
                  <small style="color: red" id="warn2"></small>
                </div>
              </div>
              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary" id="regOff" disabled>
                    <?php echo e(__('Register')); ?>

                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card mt-5">
          <div class="card-header"><h3><?php echo e(__('Register Hospital Heads')); ?></h3></div>
          <div class="card-body">
            <p id="gens" hidden><?php echo e($generals); ?></p>
            <p id="regs" hidden><?php echo e($regionals); ?></p>
            <form class="form-group">
              <?php echo csrf_field(); ?>
              <label for="type">Type: </label><select id="type" onchange="choose()">
                <option value="Regional_Referral_Hospital">Regional Referral Hospital</option>
                <option value="General_Hospital">General Hospital</option>
              </select>
              <label for="hospital">Hospital: </label><select id="hospital" onchange="listdoctors()">
              </select>
              <label for="current">Current: </label><input type="text" id="current" disabled>
              <label for="new">New head: </label><select id="new"></select><br>
                <button type="button" class="btn btn-outline-primary" onclick="promote()" id="prom">
                  <?php echo e(__('Promote')); ?>

                </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script>
    verify();
    choose();
    function verify(){
      let nm = document.getElementById("name");
      let user = document.getElementById("username");
      let warn1 = document.getElementById("warn1");
      let warn2 = document.getElementById("warn2");
      let regbtn = document.getElementById("regOff");

      warn1.innerText = "";
      warn2.innerText = "";
      regbtn.disabled = false;
      user.value = user.value.trim();

      if(user.value.length<3){
        warn2.innerText += "username must contain atleast 3 characters\n";
        regbtn.disabled = true;
      }

      if(nm.value.length<3){
        warn1.innerText += "name must contain atleast 3 characters\n";
        regbtn.disabled = true;
      }

      if(nm.value.match(/[^A-z ]/gi)){
        warn1.innerText = "only letters and spaces allowed here\n";
        regbtn.disabled = true;
      }

      $.ajaxSetup({
        heders: {
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
        }
      });

      $.ajax({
        url: "<?php echo e(url('/regOfficer')); ?>",
        method: "GET",
        data:{username:user.value},
        success:function (response){
            if(response<0){
                warn2.innerText += "This username is already taken";
                regbtn.disabled = true;
            }
        }
      });

    }

    $("#regOff").click(function (event){
      event.preventDefault();

      let username = $("input[name=username]").val();
      let name = $("input[name=name]").val();

      $.ajaxSetup({
        heders: {
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
        }
      });

      $.ajax({
        url: "<?php echo e(url('/inpOfficer')); ?>",
        method: "GET",
        data:{
          username:username,
          name:name
        },
        success:function (response){
          document.getElementById("name").value ="";
          document.getElementById("username").value ="";
          $.notify(response,"success");
          verify();
        }
      });
    });
    function choose(){
      let value = document.getElementById('type').value;
      let hospital = document.getElementById('hospital');
      if (value === "General_Hospital"){
        hospital.innerHTML = "";
        let gens = JSON.parse(document.getElementById('gens').innerText);
        for (let gen of gens){
            hospital.innerHTML += "<option value="+gen.hospitalId+">"+gen.hospitalName+"</option>"
        }
      }else{
        hospital.innerHTML = "";
        let regs = JSON.parse(document.getElementById('regs').innerText);
        for (let reg of regs){
            hospital.innerHTML += "<option value="+reg.hospitalId+">"+reg.hospitalName+"</option>"
        }
      }
      listdoctors();
    }
    function listdoctors(){
        let id = document.getElementById('hospital').value;
        let type = document.getElementById('type').value;
        let drs = document.getElementById('new');
        let cur = document.getElementById('current');
        let prombtn = document.getElementById('prom');

        $.ajax({
          url: "<?php echo e(url('/getdrs')); ?>",
          method: "GET",
          data:{
              id:id,
              type:type
          },
          success:function (response){
              let result = JSON.parse(response);
              console.log(result);
              drs.innerHTML = "";
              if(result[0][0]===undefined){
                  drs.innerHTML = "<option>None</option>";
                  prombtn.disabled = true;
              }else {
                  for (let dr of result[0]){
                      drs.innerHTML += "<option value="+dr.username+">"+dr.fullname+"</option>";
                  }
                  prombtn.disabled = false;
              }
              if(result[1][0]===undefined){
                  cur.value = "None"
              }else {
                  cur.value = result[1][0]['fullName'];
              }
          }
        });
    }
    function promote(){
        let id = document.getElementById('hospital').value;
        let newhead = document.getElementById('new').value;
        $.ajax({
            url: "<?php echo e(url('/promote')); ?>",
            method: "GET",
            data:{
                id:id,
                username:newhead
            },
            success:function (response){
              $.notify(response,"success");
            }
        });
    }
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.adminLTE', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/timothy/Desktop/Covid_casetool/resources/views/officerRegistration.blade.php ENDPATH**/ ?>