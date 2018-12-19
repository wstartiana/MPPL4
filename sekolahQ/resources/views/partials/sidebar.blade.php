<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
   
      <!-- search form -->
      <!-- <form name="form1" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="jenjang" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <!-- <li class="header"> -->
            <h3 style="color:white;padding-left:8px;padding-top:16px">Filter Berdasarkan:</h3>
        
        <br>

        

        <form name="form1" style="padding-left:16px">
          <li>
          <div class="text-left row">
            <div class="col-md-11" style="margin-bottom:5px;">
							<b><font color="white">Status Sekolah</font></b>
						</div>
            <div class="col-md-10 pull-left">
                <label><input type="radio" name="status" value="2" checked><font color="white">All</font></label>
                <label><input type="radio" name="status" value="1"><font color="white">Negeri</font></label>
                <label><input type="radio" name="status" value="0" ><font color="white">Swasta</font></label>
                <!-- <label><input type="radio" name="optradio" value="SMK" checked><font color="white">SMK</font></label> -->
              </div>
              </div>
          </li>
          <br>
          <br>
          <li>
              <div class="text-left row">
              <div class="col-md-11" style="margin-bottom:5px;">
							  <b><font color="white">Jenjang</font></b>
						  </div>
                <div class="col-md-10 pull-left">
                  <label><input type="radio" name="optradio" value="SD" checked><font color="white">SD</font></label>
                  <label><input type="radio" name="optradio" value="SMP" ><font color="white">SMP</font></label>
                  <label><input type="radio" name="optradio" value="SMA" ><font color="white">SMA</font></label>
                  <!-- <label><input type="radio" name="optradio" value="SMK" checked><font color="white">SMK</font></label> -->
                </div>
              </div>
          </li>
          <br>
          <br>
          <li>
            <div class="text-left row">
						<div class="col-md-11" style="margin-bottom:5px;">
							<b><font color="white">Radius Pencarian</font></b>
						</div>
						<div class="col-md-1 pull-left">
							&nbsp;
						</div>
						<div class="col-md-8 pull-left">
            <div class="slidecontainer">
              <input type="range" name="radius" min="1" max="20" value="10" class="slider" id="myRange">
            </div>
						</div>
						<div class="col-md-2 pull-left">
							<p id="radnum" class="text-left">17Km</p>
						</div>
					</div>
            </li>
          </ul>
        </li>
</form>
        
      </ul>
    </section>
    <!-- <input type="button" name="dsfd" value="cari" onclick="getXML()"  > -->
    <!-- /.sidebar -->
  </aside>
