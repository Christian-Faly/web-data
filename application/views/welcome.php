            <br/><br/>

        <div class="span12">
  
  	        
        
        <?php if ($this->session->userdata('role_id')!='')
                              echo'
                  <div class="row">

                      <div class="span7">

                          <!-- Area Chart -->
                          <div class="card shadow mb-4">
                              <div class="card-header py-3">
                                  <h6 class="m-0 font-weight-bold text-primary">Nb de MER appuyés par année et par genre (sans répetition)</h6>
                              </div>
                              <div class="card-body">
                                  <form action="" class="chart_form"> 
                                      <select name="" id="select_region_benef">
                                          <option selected value="National">National</option>
                                          <option value="4">Analamanga</option>
                                          <option value="13">Analanjirofo</option>
                                          <option value="12">Atsinanana</option>
                                          <option value="8">Boeny</option>
                                          <option value="6">Bongolava</option>
                                          <option value="15">Haute Matsiatra</option>
                                          <option value="3">Itasy</option>
                                          <option value="7">Sofia</option>
                                          <option value="16">V7V</option>
                                      </select> 
                                  </form>
                                  <div class="row">
                                      <div class="span4">
                                          <div class="chart-area">
                                              <canvas id="myAreaChart" ></canvas>
                                          </div>
                                      </div>
                                      <div class="span2">
                                          <div class="chart-pie pt-4"> 
                                              <canvas id="myPieChart"></canvas>
                                          </div>
                                      </div>
                                  </div>
                                  
                                  <hr>
                              </div>
                          </div>
                      </div>

                      <div class="span5">

                          <!-- Bar Chart -->
                          <div class="card shadow mb-4">
                              <div class="card-header py-3">
                                  <h6 class="m-0 font-weight-bold text-primary">Nb de MER bénéficiaires des formations par type de formation (sans répétition)</h6>
                              </div>
                              <div class="card-body">
                                  <form action="" class="chart_form"> 
                                      <select name="" id="select_region_benef_formation">
                                          <option selected value="National">National</option>
                                          <option value="4">Analamanga</option>
                                          <option value="13">Analanjirofo</option>
                                          <option value="12">Atsinanana</option>
                                          <option value="8">Boeny</option>
                                          <option value="6">Bongolava</option>
                                          <option value="15">Haute Matsiatra</option>
                                          <option value="3">Itasy</option>
                                          <option value="7">Sofia</option>
                                          <option value="16">V7V</option>
                                      </select> 
                                  </form>
                                  
                                  <div class="chart-bar">
                                      <canvas id="myBarChart" ></canvas>
                                  </div>
                                  <hr>
                              </div>
                          </div>
                      </div>
                  </div>

                      
                  <div class="row">   
                      <!-- Donut Chart -->
                      <div class="span6">
                          <div class="card shadow mb-4">
                              <!-- Card Header - Dropdown -->
                              <div class="card-header py-3">
                                  <h6 class="m-0 font-weight-bold text-primary">Nb de MER bénéficiaires des foires par type de foire (sans répétition)</h6>
                              </div>
                              <!-- Card Body -->
                              <div class="card-body">
                                  <div class="row">
                                      <div class="span2">
                                          <form action="" class="chart_form"> 
                                              <select name="" id="select_region_benef_foire">
                                                  <option selected value="National">National</option>
                                                  <option value="4">Analamanga</option>
                                                  <option value="13">Analanjirofo</option>
                                                  <option value="12">Atsinanana</option>
                                                  <option value="8">Boeny</option>
                                                  <option value="6">Bongolava</option>
                                                  <option value="15">Haute Matsiatra</option>
                                                  <option value="3">Itasy</option>
                                                  <option value="7">Sofia</option>
                                                  <option value="16">V7V</option>
                                              </select> 
                                          </form>
                                      </div>
                                      <div class="span3">
                                          <div class="chart-pie pt-4"> 
                                              <canvas id="myPieChart_benef_foireHF"></canvas>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="chart-bar">
                                      <canvas id="myBarChart_benef_foire" ></canvas>
                                  </div>
                                  <hr>
                              </div>
                          </div>
                      </div>

                      <!-- Line Chart -->
                      <div class="span6">
                          <div class="card shadow mb-4">
                              <!-- Card Header - Dropdown -->
                              <div class="card-header py-3">
                                  <h6 class="m-0 font-weight-bold text-primary">Nb de MER bénéficiaires des Services Financiers par année (sans répétition)</h6>
                              </div>
                              <!-- Card Body -->
                              <div class="card-body">

                                  <form action="" class="chart_form"> 
                                      <select name="" id="select_region_benef_sf">
                                          <option selected value="National">National</option>
                                          <option value="4">Analamanga</option>
                                          <option value="13">Analanjirofo</option>
                                          <option value="12">Atsinanana</option>
                                          <option value="8">Boeny</option>
                                          <option value="6">Bongolava</option>
                                          <option value="15">Haute Matsiatra</option>
                                          <option value="3">Itasy</option>
                                          <option value="7">Sofia</option>
                                          <option value="16">V7V</option>
                                      </select> 
                                  </form>
                                  <div class="chart-pie pt-4">
                                      <canvas id="canvas" style="display: block; width: 100%; height: 255px;"
                                          class="chartjs-render-monitor">
                                      </canvas>
                                  </div>
                                  <hr>
                              </div>
                          </div>
                      </div>
                  </div>'
          ?>
</div>

<!-- end span12 -->
