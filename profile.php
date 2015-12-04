<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="//d3js.org/d3.v3.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<style>
.show-hide{
    display: none;
    width: 100px;
    padding:15px;
    border: 1px solid #000;
}
    
.active{
    background: green !important;
}
</style>
<title>Profile Page</title>

</head>

<body>
<div class="container">

<?php
if($_COOKIE['currentUser']) {
    echo "<a href='index.php'><div class='row btn coolBtn' type='button'>Go Back</div></a>";
    $curEmail = $_COOKIE['currentUser'];
    $username = "whatscoo_site";
    $password = "cookdb411pass/";
    $hostname = "localhost";
    $dbconn = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");
    
    $db = mysql_select_db("whatscoo_maindb",$dbconn) or die("Could not select examples");
    $query = "SELECT username FROM Users
        WHERE email='".$curEmail."'";
        
    $result = mysql_query($query);
    $name = mysql_fetch_assoc($result);
    
    echo "<h1 class='row'> Welcome,  " . $name['username'] . "!</h1>";
}
?>

<h3 class='row'>Take a look at all of the items you have rated</h3>
<p class='row'>To see what all users have rated, use the toggle buttons below.</p>
<!--toggle button-->
<div class="row">
    <div class="btn-group" data-toggle="buttons">
        <label class="btn btn-primary active" id='opt1'>
            <input type="radio" name="options" id="option1" checked> Show my ratings
        </label>
        <label class="btn btn-primary" id='opt2'>
            <input type="radio" name="options" id="option2"> Show all ratings
        </label>
    </div>
</div>
</div>
</body>
</html>

<script>
    //code for d3 visualization
    var screenWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth; //cross-browser width of screen
    var width = screenWidth*.8,
        height = 500,
        padding = 1.5, // separation between same-color circles
        clusterPadding = 6, // separation between different-color circles
        maxRadius = 4;
    
    //Each palette will be a cluster - need to map to this to determine the cluster
    var palettes = ['Garlicky', 'Healthy', 'Savoury', 'Spicy', 'Sweet', 'Unrated']; 
    var color = ['#3182bd', '#756bb1', '#31a354', '#fd8d3c', '#e377c2', '#e7ba52'];

    var m = palettes.length; // number of distinct clusters = number of palettes
    
    //Set up data for current user's ratings
    var currRatings = [];
    var index = 0;
    <?php
    $query = "SELECT Platters.name AS 'name', Restaurants.name AS 'rname', cost, Platters.rating AS 'rating', garlicky, healthy, savouriness, spiciness, sweetness FROM Platters, Rating, Restaurants WHERE Platters.platterID = Rating.dish_id AND Platters.RestaurantID = Restaurants.YelpID AND Rating.user_email='".$curEmail."'"; ?>
    console.log("query for current user is " + " <?php printf('%s', $query) ?> ");
    <?php $result = mysql_query($query);            
    //build array myRatings from the query results 
    while($row = mysql_fetch_array($result, MYSQL_ASSOC)){ ?>
        currRatings.push({name: "<?php echo $row['name'] ?>", rating: "<?php echo $row['rating'] ?>", garlic: "<?php echo $row['garlicky'] ?>", healthy: "<?php echo $row['healthy'] ?>", savoury: "<?php echo $row['savouriness'] ?>", sweet: "<?php echo $row['sweetness'] ?>", spicy: "<?php echo $row['spiciness'] ?>"});
        index++;
    <?php } ?>
    
    //set up data for all user ratings
    var allRatings = [];
    index = 0;
    <?php
    $query2 = "SELECT Platters.name AS 'name', Restaurants.name AS 'rname', cost, Platters.rating AS 'rating', garlicky, healthy, savouriness, spiciness, sweetness FROM Platters, Rating, Restaurants WHERE Platters.platterID = Rating.dish_id AND Platters.RestaurantID = Restaurants.YelpID"; ?>
    console.log("query for all users is " + " <?php printf('%s', $query2) ?> ");
    <?php $result2 = mysql_query($query2);            
    //build array myRatings from the query results 
    while($row = mysql_fetch_array($result2, MYSQL_ASSOC)){ ?>
        allRatings.push({name: "<?php echo $row['name'] ?>", rating: "<?php echo $row['rating'] ?>", garlic: "<?php echo $row['garlicky'] ?>", healthy: "<?php echo $row['healthy'] ?>", savoury: "<?php echo $row['savouriness'] ?>", sweet: "<?php echo $row['sweetness'] ?>", spicy: "<?php echo $row['spiciness'] ?>"});
        index++;
    <?php } ?>

    //make the graphs when toggled, start with current user
    makeD3Graph(currRatings);
    $('input[type=radio]').change(function(){
        if($('#option2').is(':checked')){
            $('#opt2').addClass("active");
            $('#opt1').removeClass("active");
            d3.selectAll('svg').remove();
            makeD3Graph(allRatings);
         } else{
            $('#opt1').addClass("active");
            $('#opt2').removeClass("active");
            d3.selectAll('svg').remove();
            makeD3Graph(currRatings);
         }
    })

    function makeD3Graph(myRatings){
        // The largest node for each cluster
        var clusters = new Array(m);
        n = myRatings.length;

        if(n < 40){
            maxRadius = 5;
            height = 550;
        } else {
            maxRadius = 3;
            height = 900;
        }
        //my mapping
        var iterator = 0;
        nodes = d3.range(n).map(function() {
          var i = mapToClusters(myRatings[iterator]);
          var r = i < 6? myRatings[iterator].rating*1.7 * maxRadius: 4*maxRadius;
          var a = myRatings[iterator].name;
          var dxx = a.length < 5? -15: -20;
          var d = {cluster: i,
            radius: r,
            name: a,
            x: Math.cos(i / m * 2 * Math.PI) * 200 + width / 2 + Math.random(),
            y: Math.sin(i / m * 2 * Math.PI) * 200 + height / 2 - 100 + Math.random(),
            dx: dxx
            };
          if (!clusters[i] || (r > clusters[i].radius)) clusters[i] = d;
          iterator++;
          return d;
        });
        
        var force = d3.layout.force()
            .nodes(nodes)
            .size([width, height])
            .gravity(.02) 
            .charge(0)
            .on("tick", tick)
            .start();
        
        var svg = d3.select("body").append("svg")
            .attr("width", width)
            .attr("height", height);
        
        var legend = svg.selectAll('g')
            .data(palettes)
            .enter()
            .append('g')
            .attr("class", "legend");
          
        legend.append('rect')
            .attr('x', width - 90)
            .attr('y', function(d, i){ return i * 25 + 20})
            .attr('width', 10)
            .attr('height', 10)
            .attr('fill', function(d,i){ return color[i]});
            
        legend.append('text')
             .attr("x", width - 72)
             .attr("y", function(d,i){ return i * 25 + 29})
             .attr("height",30)
             .attr("width",100)
             .text(function(d,i) { return palettes[i] });
            
        
        var node = svg.selectAll("circle")
            .data(nodes)
            .enter()
            .append("g")
            .call(force.drag);
        //add circle to the group
        node.append("circle")
            .style("fill", function (d) { return color[d.cluster];})
            .attr("r", function(d){ return d.radius})
        //add text to the group    
        node.append("text")
            .text(function (d) { return d.name;})
            //.attr("dx", -15)
            .attr("dx", function(d){return d.dx})
            .attr("dy", ".35em");
        
        function tick(e) {
            node.each(cluster(10 * e.alpha * e.alpha))
                .each(collide(.5))
                .attr("transform", function (d) {
                    var k = "translate(" + d.x + "," + d.y + ")";
                    return k;
                })
        }
        
        // Move d to be adjacent to the cluster node.
        var cluster = function (alpha) {
          return function(d) {
            var cluster = clusters[d.cluster],
                k = 1;
        
            // For cluster nodes, apply custom gravity.
            if (cluster === d) {
              cluster = {x: width / 2, y: height / 2, radius: -d.radius};
              k = .1 * Math.sqrt(d.radius);
            }
        
            var x = d.x - cluster.x,
                y = d.y - cluster.y,
                l = Math.sqrt(x * x + y * y),
                r = d.radius + cluster.radius;
            if (l != r) {
              l = (l - r) / l * alpha * k;
              d.x -= x *= l;
              d.y -= y *= l;
              cluster.x += x;
              cluster.y += y;
            }
          };
        };
        
        // Resolves collisions between d and all other circles.
        var collide = function(alpha) {
          var quadtree = d3.geom.quadtree(nodes);
          return function(d) {
            var r = d.radius + maxRadius + Math.max(padding, clusterPadding),
                nx1 = d.x - r,
                nx2 = d.x + r,
                ny1 = d.y - r,
                ny2 = d.y + r;
            quadtree.visit(function(quad, x1, y1, x2, y2) {
              if (quad.point && (quad.point !== d)) {
                var x = d.x - quad.point.x,
                    y = d.y - quad.point.y,
                    l = Math.sqrt(x * x + y * y),
                    r = d.radius + quad.point.radius + (d.cluster === quad.point.cluster ? padding : clusterPadding);
                if (l < r) {
                  l = (l - r) / l * alpha;
                  d.x -= x *= l;
                  d.y -= y *= l;
                  quad.point.x += x;
                  quad.point.y += y;
                }
              }
              return x1 > nx2 || x2 < nx1 || y1 > ny2 || y2 < ny1;
            });
          };
        }
    }
    //var palettes = ['garlicky', 'healthy', 'savouriness', 'spiciness', 'sweetness', 'unrated']; 
    //Return number of cluster it should go in based on highest rating
    function mapToClusters(rating){
        var max = Math.max(rating.sweet, rating.spicy, rating.garlic, rating.healthy, rating.savoury);
        
        if (rating.sweet == max) return 4;
        else if (rating.savoury == max) return 2;
        else if (rating.spicy == max) return 3;
        else if (rating.garlic == max) return 0;
        else if (rating.healthy == max) return 1;
        else return 5; //unrated, hopefully doesn't happen
    }
</script>