<script type="text/javascript">
  $(function(){
    $('.details').click(function(){
      alert('Sorry, this link is under Development');
    });
  });
</script>
<style>
 #carousel{padding:10px;}
 .caption{background: rgba(0,0,0,0.7);  left:0px;width: 300px;height: 100px;}
 .h3{color: yellow;float: left;margin-top: -5px;margin-left: 50px;text-shadow:5px 5px 5px black}
 .details{color: skyblue}
 .text{text-shadow:5px 5px 5px black}
 .details:hover{color: white;cursor: pointer;}
 .img_slide{width:1200px;height:500px;border-radius: 3px;}
 .class_col_1{background:red ;padding:0px;width: 100px;float: right;}
 .img_col1{width:;height:115px;border-radius: 3px;background: skyblue}
</style>

     <div id="carousel">
      <h4>PROJECT</h4>
      <p>WE ARE GREAT LISTENERS, PERFECT PERFORMERS, AND SKILLED PROBLEM
          SOLVERS. OUR BUSINESS IS YOUR SUCCESS</p>
          <div id="myCarousel" class="carousel slide class_col_2" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>
          <div class="carousel-inner" role="listbox">
            <?php
              $count = 0;
              foreach ($projects_page as $value) { 
                $count++;
                ?>
                  <div class="item <?php echo ($count== 1) ? 'active' : '' ;?>">
                    <img src="<?=base_url();?>img/project_slides/<?=$value->img_thumb_link;?>" style="position: relative;width: 100%;height: 400px;">
                    <div class="carousel-caption caption">
                      <span class="h3"><?=$value->name;?></span>
                      <p class="text">House Area: <?=$value->house_area;?> m²</p>
                      <a class="details">Details</a>

                  </div>
                </div>
                <?php
              }
            ?>
            </div>
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
               <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
      </div>