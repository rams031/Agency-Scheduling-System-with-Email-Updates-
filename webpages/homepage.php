<?php include '../database/dbsql.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include 'csstags.php'; ?>
  <link rel="stylesheet" href="../modules/js/aos.css" />
<head>

<body>
  <nav class="parallax-window" data-parallax="scroll" data-image-src="../assets/images/career4.png"><?php include "navbar.php" ?></nav>
  <div class="container is-fullhd">
    <div class="section">
    </div>
    <div data-aos="fade-in" class="section ">
      <div class="columns">
        <div class="column">
          <div class="card is-shadowless">
            <div class="card-content">
              <p id="titles" class="title is-size-2">
                Apply Now
              </p>
              <div class="content is-size-5">
                You are on the first step of your potential future career. Our recruitment team is dedicated to ensuring that new transcribers are comfortable working with the company.
              </div>
            </div>
          </div>
        </div>
        <div class="is-divider-vertical"></div>
        <div class="column">
          <div class="card is-shadowless">
            <div class="card-content">
              <p id="titles" class="title is-size-2">
                Search a Job
              </p>
              <div class="content is-size-5">
                Search Job or Keywords that suits for you.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div data-aos="fade-in" id="category" class="section">
      <div id="category-list" class="card is-shadowless">
        <div class="columns">
          <div class="column is-two-thirds">
            <?php include 'searchengine.php'; ?>
          </div>
          <div class="column">
            <?php include 'searchenginefilter.php'; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'scripttags.php'; ?>
</body>
<?php include 'footer.php'; ?>
</html>

<script>
  AOS.init({
    duration: 500,
  });

  var options = {
    valueNames: ['jobname',
      'jobindustry',
      'jobsalary',
      'location',
      'jobtype',
      {
        data: ['location']
      }
    ],
    page: 4,
    pagination: true
  };
  var monkeylist = new List('test-list', options);
  $('.no-result').hide()

  function resetList() {
    monkeylist.search();
    monkeylist.filter();
    monkeylist.update();
    $(".filter-all").prop('checked', true);
    $('.filter').prop('checked', false);
    $('.search').val('');
  };

  function updateList() {
    var valueslocation = $("input[name=location]:checked").val();
    var valuesindustry = $("input[name=jobindustry]:checked").val();

    console.log(valueslocation, valuesindustry);
    monkeylist.filter(function(item) {
      var locationFilter = false;
      var industryFilter = false;

      if (valueslocation == 'all') {
        locationFilter = true;
      } else {
        locationFilter = item.values().location == valueslocation;
      }
      if (valuesindustry == null) {
        industryFilter = true;
      } else {
        industryFilter = item.values().jobindustry.indexOf(valuesindustry) >= 0;
      }
      return locationFilter && industryFilter
    });
    monkeylist.update();
    console.log('Filtered: ' + valueslocation);
  }

  $(function() {
    $("input[name=location]").change(updateList);
    $('input[name=jobindustry]').change(updateList);
    $('input[name=salary]').change(updateList);

    monkeylist.on('updated', function(list) {
      if (list.matchingItems.length > 0) {
        $('.no-result').hide()
      } else {
        $('.no-result').show()
      }
    });
  });

  $(document).ready(function() {
    $('.parallax').parallax();
    $(".navbar-burger").click(function() {
      $(".navbar-burger").toggleClass("is-active");
      $(".navbar-menu").toggleClass("is-active");
    });
  });
</script>