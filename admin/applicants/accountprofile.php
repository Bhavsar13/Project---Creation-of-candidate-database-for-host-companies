  <?php 
    $applicant = new Applicants();
    $appl = $applicant->single_applicant($_SESSION['APPLICANTID']);
  ?>
  <style type="text/css">
      .form-group {
          margin-bottom: 5px;
      }

  </style>
  <form class="form-horizontal" method="POST" action="controller.php?action=edit">
      <div class="container">
          <div class="box-header with-border">
              <h3 class="box-title">Account</h3>

              <!-- /.box-tools -->
          </div>
          <div class="form-group">
              <div class="col-md-7">
                  <label class="col-md-4 control-label" for="FNAME">Firstname:</label>

                  <div class="col-md-8">
                      <input name="JOBID" type="hidden" value="<?php echo $_GET['job'];?>">
                      <input class="form-control input-sm" id="FNAME" name="FNAME" placeholder="Firstname" type="text" value="<?php echo $appl->FNAME;?>" onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off">
                  </div>
              </div>
          </div>

          <div class="form-group">
              <div class="col-md-7">
                  <label class="col-md-4 control-label" for="LNAME">Lastname:</label>

                  <div class="col-md-8">
                      <input class="form-control input-sm" id="LNAME" name="LNAME" placeholder="Lastname" onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" value="<?php echo $appl->LNAME;?>">
                  </div>
              </div>
          </div>

          <div class="form-group">
              <div class="col-md-7">
                  <label class="col-md-4 control-label" for="MNAME">Middle Name:</label>

                  <div class="col-md-8">
                      <input class="form-control input-sm" id="MNAME" name="MNAME" placeholder="Middle Name" onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off" value="<?php echo $appl->MNAME;?>">
                  </div>
              </div>
          </div>

          <div class="form-group">
              <div class="col-md-7">
                  <label class="col-md-4 control-label" for="ADDRESS">Address:</label>

                  <div class="col-md-8">

                      <textarea class="form-control input-sm" id="ADDRESS" name="ADDRESS" placeholder="Address" type="text" value="" required onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off"><?php echo $appl->ADDRESS;?></textarea>
                  </div>
              </div>
          </div>

          <div class="form-group">
              <div class="col-md-7">
                  <label class="col-md-4 control-label" for="Gender">Sex:</label>

                  <div class="col-md-8">
                      <div class="col-lg-5">
                          <div class="radio">
                              <label><input checked id="optionsRadios1" checked="True" name="optionsRadios" type="radio" value="Female">Female</label>
                          </div>
                      </div>

                      <div class="col-lg-4">
                          <div class="radio">
                              <label><input id="optionsRadios2" name="optionsRadios" type="radio" value="Male"> Male</label>
                          </div>
                      </div>

                  </div>
              </div>
          </div>

          <div class="form-group">
              <div class="col-md-7">
                  <label class="col-md-4 control-label" for="BIRTHDATE">Date of Birth:</label>

                  <div class="col-md-8">
                      <div class="input-group">
                          <span class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                          </span>
                          <input class="form-control input-sm date_picker" id="BIRTHDATE" name="BIRTHDATE" placeholder="Date of Birth" type="text" value="<?php echo date_format(date_create($appl->BIRTHDATE),'m/d/Y');?>" required autocomplete="off">
                      </div>
                  </div>
              </div>
          </div>

          <div class="form-group">
              <div class="col-md-7">
                  <label class="col-md-4 control-label" for="BIRTHPLACE">Place of Birth:</label>

                  <div class="col-md-8">
                      <input class="form-control input-sm" id="BIRTHPLACE" name="BIRTHPLACE" placeholder="Place of Birth" type="text" value="<?php echo $appl->BIRTHPLACE;?>" required onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off">
                  </div>
              </div>
          </div>


          <div class="form-group">
              <div class="col-md-7">
                  <label class="col-md-4 control-label" for="TELNO">Contact No:</label>

                  <div class="col-md-8">

                      <input class="form-control input-sm" id="TELNO" name="TELNO" placeholder="Contact No." type="text" any value="<?php echo $appl->CONTACTNO;?>" required onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off">
                  </div>
              </div>
          </div>


          <div class="form-group">
              <div class="col-md-7">
                  <label class="col-md-4 control-label" for="EMAILADDRESS">Email Address:</label>
                  <div class="col-md-8">
                      <input type="Email" class="form-control input-sm" id="EMAILADDRESS" name="EMAILADDRESS" placeholder="Email Address" autocomplete="off" value="<?php echo $appl->EMAILADDRESS;?>" />
                  </div>
              </div>
          </div>

          <div class="form-group">
              <div class="col-md-7">
                  <label class="col-md-4 control-label" for="DEGREE">Work Experience</label>

                  <div class="col-md-8">
                      <textarea class="form-control input-sm" id="DEGREE" name="DEGREE" placeholder="Educational Attainment" onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off"><?php echo $appl->DEGREE;?></textarea>
                  </div>
              </div>
          </div>

          <div class="form-group">
              <div class="col-md-7">
                  <label class="col-md-4 control-label" for="submit"></label>

                  <div class="col-md-8">
                      <button class="btn btn-primary btn-sm" name="submit" type="submit"><span class="fa fa-save"></span> Submit </button>
                  </div>
              </div>
          </div>

      </div>
  </form>
