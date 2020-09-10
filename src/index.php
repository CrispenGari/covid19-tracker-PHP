<?php
    include "../data/server.php";
    if($not_found_error){
    include_once('./error.php');
    return;
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <script src="https://kit.fontawesome.com/c8de22c177.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 
    <title>Covid-19 Tracker</title>
</head>
<body>
<div class="container">
<div class="header">
<div class="header__left">
<img src="https://i2.wp.com/amref.org/wp-content/uploads/2019/11/Amref-Logo.png?w=516&ssl=1" alt="">
</div>
<div class="header__center">
<div class="search">
<form action="index.php" method="get" type="submit" onsubmit="func()">
<input placeholder="Search country" type="text" name="country" class="search__input" id="search_"> 
<button type="submit" name="submit" class="btn-submit">
<i class="fas fa-search"></i>
</button>
</form>
</div>
</div>
<div class="header__right">
    <div class="header__rightbtn">
    <i class="fas fa-bell"></i>
    <p>Notifications</p>
    </div>
    <div class="header__rightbtn">
    <i class="fas fa-sign-in-alt"></i>
    <p>SignIn</p>
    </div>
    <div class="header__rightbtn">
    <i class="fas fa-sign-out-alt"></i>
    <p>SignOut</p>
    </div>
</div>
<div class="header__menu">
<div class="header__rightbtn">
<i class="fas fa-bars"></i>
</div>
</div>
</div>

<div class="results">
<h1><?php echo $country_name; ?></h1>
<div class="results__cards">
<div class="reasults__confirmed">
    <h2>Confirmed</h2>
     <?php echo $confirmed;?>
</div>
<div class="reasults__recoveries">
<h2>Recoveries</h2>
<?php echo $recovered;?>
</div>
<div class="reasults__deaths">
<h2>Deaths</h2>
<?php echo $deaths;?>
</div>
</div>
<h1>Charts</h1>
<div class="results__chart">
    <h3>Pie Chart</h3>
    <div class="results__chart--piechart">
    </div>
</div>
<div class="results__chart">
<h3>Bar Chart Of 10 Randomly Selected Countries (Statistics Of Covid-19)</h3>
<div class="results__chart--barchart">
</div>
</div>
</div>
<div class="footer">
    <div class="footer__info">
        
    </div>
</div>
</div>
<script>
    google.charts.load("current", { packages: ["corechart"] });
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
  const data = new google.visualization.DataTable(
    ['Element',  { role: 'style' }],
         ['Deaths', 'red'],     
         ['Confirmed',  'yellow'],       
         ['Recovered',  'green'],
      
  );
  data.addColumn("string", "Topping");
  data.addColumn("number", "Slices");
  data.addColumn("string", "Colors");
  const death = Number.parseInt("<?php echo $deaths?>");
  const confirmed = Number.parseInt("<?php echo $confirmed?>");
  const recovered = Number.parseInt("<?php echo $recovered?>");
  console.log(death);
  data.addRows([
    ["Deaths", death, "red"],
    ["Confirmed", confirmed, "yellow"],
    ["Recovered", recovered, "green"],
  ]);
//   country name
const country_name = "<?php echo $country_name;?>"
  const options = {
    title: `Pie Chart of Covid-19  ${country_name !== "Globally" ? " in ": ""} ${country_name}`,
    slices: {0: {color: 'red'}, 1:{color: 'yellow'}, 2:{color: 'green'}},
    is3D: true,
    chartArea: {
      // leave room for y-axis labels
      width: '100%',
      top: "40"
    },
    legend: {
      position: 'top'
    },
  };
  const chart = new google.visualization.PieChart(
    document.querySelector(".results__chart--piechart")
  );
  chart.draw(data, options);
}
// A bar Chart

google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawAnnotations);

function drawAnnotations() {
      const data_ = eval(`<?php echo(json_encode($death_array)); ?>`);
      console.log(data_)
    let i = Math.floor(Math.random()*1000 )% data_.length +1;;
    let j = Math.floor(Math.random()*1000 )% data_.length +1;
    let k = Math.floor(Math.random()*1000 )% data_.length +1;;
    let l = Math.floor(Math.random()*1000 )% data_.length +1;
    let m = Math.floor(Math.random()*1000 )% data_.length +1;;
    let n = Math.floor(Math.random()*1000 )% data_.length +1;
    let o = Math.floor(Math.random()*1000 )% data_.length +1;;
    let p = Math.floor(Math.random()*1000 )% data_.length +1;
    let q = Math.floor(Math.random()*1000 )% data_.length +1;;
    let r = Math.floor(Math.random()*1000 )% data_.length +1;

      let data;
     
         data=google.visualization.arrayToDataTable([
        ['Country', 'Deaths', 'Confirmed', "Recovered"],
          [data_[i].name, data_[i].deaths, data_[i].confirmed, data_[i].recovered],
          [data_[j].name, data_[j].deaths, data_[j].confirmed, data_[j].recovered],
          [data_[k].name, data_[k].deaths, data_[k].confirmed, data_[k].recovered],
          [data_[m].name, data_[m].deaths, data_[m].confirmed, data_[m].recovered],
          [data_[n].name, data_[n].deaths, data_[n].confirmed, data_[n].recovered],
          [data_[n].name, data_[n].deaths, data_[n].confirmed, data_[n].recovered],
          [data_[o].name, data_[o].deaths, data_[o].confirmed, data_[o].recovered],
          [data_[p].name, data_[p].deaths, data_[p].confirmed, data_[p].recovered],
          [data_[r].name, data_[r].deaths, data_[r].confirmed, data_[r].recovered],
      ]);
     


      var options = {
        title: 'Covid-19 Stats of 10 randomly selected countries',
        chartArea: {width: '50%'},
        annotations: {
          alwaysOutside: true,
          textStyle: {
            fontSize: 12,
            auraColor: 'none',
            color: '#555'
          },
          boxStyle: {
            stroke: '#ccc',
            strokeWidth: 1,
            gradient: {
              color1: '#f3e5f5',
              color2: '#f3e5f5',
              x1: '0%', y1: '0%',
              x2: '100%', y2: '100%'
            }
          }
        },
        legend: {
      position: 'top'
    },
        hAxis: {
          title: 'Population',
          minValue: 0,
        },
        vAxis: {
          title: 'Countries'
        },
        width: 550,
        height: 260
      };
      const chart = new google.visualization.BarChart(document.querySelector('.results__chart--barchart'));
      chart.draw(data, options);
    }
</script>
</body>
</html>