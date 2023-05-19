<!DOCTYPE html>
<html>
<head>
<style>
/* div.gallery {
  border: 1px solid #ccc;
}

div.gallery:hover {
  border: 1px solid #777;
} */

div.gallery img {
  width: 100%;
  height: auto;
}

div.desc {
  padding: 15px;
  text-align: center;
}

* {
  box-sizing: border-box;
}

.responsive {
  padding: 0 6px;
  float: left;
  width: 24.99999%;
}

@media only screen and (max-width: 700px) {
  .responsive {
    width: 49.99999%;
    margin: 6px 0;
  }
}

@media only screen and (max-width: 500px) {
  .responsive {
    width: 100%;
  }
}

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}
</style>
</head>
<body>

<h2>Bonda Homestay Gallery</h2>

<div class="responsive">
  <div class="gallery">
    <img src="images/1.jpg" alt="Bonda Homestay" width="600" height="400">
    <!-- <div class="desc">Add a description of the image here</div> -->
  </div>
</div>


<div class="responsive">
  <div class="gallery">
    <img src="images/2.jpg" alt="Bonda Homestay" width="600" height="400">
    <!-- <div class="desc">Add a description of the image here</div> -->
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <img src="images/3.jpg" alt="Bonda Homestay" width="600" height="400">
    <!-- <div class="desc">Add a description of the image here</div> -->
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <img src="images/4.jpg" alt="Bonda Homestay" width="600" height="400">
    <!-- <div class="desc">Add a description of the image here</div> -->
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <img src="images/5.jpg" alt="Bonda Homestay" width="600" height="400">
    <!-- <div class="desc">Add a description of the image here</div> -->
  </div>
</div>

<div class="clearfix"></div>

<!-- <div style="padding:6px;">
  <p>This example use media queries to re-arrange the images on different screen sizes: for screens larger than 700px wide, it will show four images side by side, for screens smaller than 700px, it will show two images side by side. For screens smaller than 500px, the images will stack vertically (100%).</p>
  <p>You will learn more about media queries and responsive web design later in our CSS Tutorial.</p>
</div> -->

</body>
</html>


