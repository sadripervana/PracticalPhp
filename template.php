<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Template for an interactive web page</title>
</head>
<body>
  <div id="container">
    <?php  include('header-for-template.php'); ?>
    <?php include('nav.php'); ?>
    <?php include('info-col.php'); ?>
    <div id="content"> <!--Start of page content.-->
      <h2>This is the Home Page</h2>
      <p>The homepage content. The homepage content. The home page content. The home page 
        content. The home page content. <br>The home page content. The home page content. The 
        home page content. The home page content. <br>The home page content. The home page 
        content. <br>The home page content. The home page content. The home page content. </p>
        <!-- End of the home page content.</p> -->
      </div>
    </div>
    <?php include('footer.php'); ?>
  </body>
  </html>