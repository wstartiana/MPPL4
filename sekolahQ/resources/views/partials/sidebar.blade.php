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
        <li class="header">
          <ulclass="list-group"><li class="list-group-item list-group-item-info"><h5>Lokasi Saat Ini</h5></li>
          <li class="list-group-item list-group-item-info">Jl. lalalala no segini, bogor, jawa barat</li></ul>
        </li>
        <form name="form1" class="sidebar-form">
        <li>
            <div class="text-left row">
            <div class="col-md-10 pull-left">
              <label><input type="radio" name="optradio" value="SD" checked><font color="white">SD</font></label>
              <label><input type="radio" name="optradio" value="SMP" checked><font color="white">SMP</font></label>
              <label><input type="radio" name="optradio" value="SMA" checked><font color="white">SMA</font></label>
              <!-- <label><input type="radio" name="optradio" value="SMK" checked><font color="white">SMK</font></label> -->
            </div>
            </div>
            </li>
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
              <input type="range" name="radius" min="1" max="20" value="50" class="slider" id="myRange">
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
    <input type="button" name="dsfd" value="cari" onclick="getXML()"  >
    <!-- /.sidebar -->
  </aside>
