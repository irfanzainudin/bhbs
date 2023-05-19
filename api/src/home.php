<div class="container">
  <div id="header">
    <h1 class="text-center">Welcome to Bonda Homestay</h1>
    <div class="card-container">
      <div class="card">
        <img src="images/5.jpg" class="card-img-top" alt="Bonda Homestay">
        <div class="card-body">
          <h5 class="card-title">Amaryllis</h5>
          <p class="card-text">Beautiful pool</p>
          <p class="card-text">RM200/night</p>
        </div>
      </div>
      <div class="card">
        <img src="images/2.jpg" class="card-img-top" alt="Bonda Homestay">
        <div class="card-body">
          <h5 class="card-title">Bougenville</h5>
          <p class="card-text">Beautiful garden</p>
          <p class="card-text">RM200/night</p>
        </div>
      </div>
      <div class="card">
        <img src="images/3.jpg" class="card-img-top" alt="Bonda Homestay">
        <div class="card-body">
          <h5 class="card-title">Celosia</h5>
          <p class="card-text">Beautiful bed</p>
          <p class="card-text">RM200/night</p>
        </div>
      </div>
    </div>
  </div>
  <div id="content" class="row">
    <form method="POST" action="index.php?p=availability">
      <div class="mb-3">
        <label for="check_in">Check in: <span style="color: red;">*</span></label>
        <input type="date" id="check_in" name="check_in" value="<?php echo date('Y-m-d'); ?>">
        <label for="check_out">Check out: <span style="color: red;">*</span></label>
        <input type="date" id="check_out" name="check_out">
      </div>
      <div class="mb-3">
        <label for="accommodation" class="col-sm-2 col-form-label">Homestay</label>
        <div class="col-sm-10">
          <select id="accommodation" name="accommodation">
            <option value="Any">Any</option>
            <option value="Amaryllis">Amaryllis</option>
            <option value="Bougenville">Bougenville</option>
            <option value="Celosia">Celosia</option>
          </select>
        </div>
      </div>
      <input type="submit" role="button" class="btn btn-primary form-control" value="Search Available Homestays">
    </form>
  </div>
</div>