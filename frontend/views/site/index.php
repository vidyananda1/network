<?php
use app\models\OrderDetail;
use app\models\Items;
use app\models\Employee;
//use app\models\Counterno;

$this->title = '';

$emp = Employee::find()->where(['record_status'=>'1'])->count();
$itm = Items::find()->where(['OR',['quantity'=>'FULL'],['quantity'=>'NONE']])->count();
$cus = OrderDetail::find()->where(['record_status'=>'1'])->count();
$sale = OrderDetail::find()->where(['record_status'=>'1'])->sum('total');

?>

<H2 style="text-align:center;color:#7665ad;"><b> CAFE MANAGEMENT SYSTEM </b></H2>
  <br>
  <br>
  
<?php
date_default_timezone_set('Asia/Kolkata');
setlocale(LC_MONETARY, 'en_IN');  


$today = date('Y-m-d');



?>
<div class="row">
    <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box" style="background-color:#8df28e">
            <div class="inner">
              <h4 style="text-align:center;"><b>NO OF EMPLOYEES</b></h4>
            </div>
            <div><h4 style="text-align:center;"><b><?= $emp ?></b></h4></div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            
                <a href="index.php?r=employee/index" class="small-box-footer">ADD +<i class="fa fa-arrow-circle-right"></i></a> 
          </div>
    </div>
    <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box" style="background-color:#96cafa">
            <div class="inner">
              <h4 style="text-align:center;"><b>NO OF ITEMS</b></h4>
            </div>
            <div><h4 style="text-align:center;"><b> <?= $itm ?></b></h4></div>
            <div class="icon">
              <i class="fa fa-cutlery"></i>
            </div>
            
                <a href="index.php?r=items/index" class="small-box-footer">ADD +<i class="fa fa-arrow-circle-right"></i></a> 
          </div>
    </div>
 </div>
 <br>
 <div class="row">
    <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box" style="background-color:#ffd359">
            <div class="inner">
              <h4 style="text-align:center;"><b>TOTAL CUSTOMERS</b></h4>
            </div>
            <div><h4 style="text-align:center;"><b><?= $cus ?></b></h4></div>
            <div class="icon">
              <i class="fa fa-user-plus"></i>
            </div>
            
                <a  class="small-box-footer"> </a> 
          </div>
    </div>
    <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box" style="background-color:#a489f5">
            <div class="inner">
              <h4 style="text-align:center;"><b>TOTAL SALES</b></h4>
            </div>
            <div><h4 style="text-align:center;"><b>Rs </b></h4></div>
            <div class="icon">
              <i class="fa fa-money"></i>
            </div>
            
                <a  class="small-box-footer"> </a> 
          </div>
    </div>
 </div>
 

    

<style type="text/css">
  .card {
    margin-top: 12px;
    border: thin solid #ccc;
    border-radius: 4px;
}
.card-body, .card-header, .card-footer {
    padding: 12px;
}
.card-label {
    text-transform: uppercase;
    font-size: 12px;
    font-family: 'IBM Plex Sans', sans-serif;
    min-height: 34px;
}
.card-value {
    font-size: 36px;
}
.card-summary {
    font-size: 10px;
    padding-left: 8px;
}
.card-header {
    border-bottom: thin solid #ccc;
}
.card-footer {
    border-top: thin solid #ccc;
}
.c1 {color: #2196f3;}
.c2 {color: #69b2f8;}
.c3 {color: #f18fb3;}
.c4 {color: #4db6ac;}
.c5 {color: #81c784;}
.male {color: #42a5f5;}
.female {color: #f48fb1;}
.footer-value {
    font-size: 28px;
}
.footer-value small {
    font-size: 50%;
}
.col-xs-5th-1, .col-xs-5th-2, .col-xs-5th-3, .col-xs-5th-4 {
  float: left;
}

.col-xs-5th-5 {
  float: left;
  width: 100%;
}

.col-xs-5th-4 {
  width: 80%;
}

.col-xs-5th-3 {
  width: 60%;
}

.col-xs-5th-2 {
  width: 40%;
}

.col-xs-5th-1 {
  width: 20%;
}

.col-xs-5th-pull-5 {
  right: 100%;
}

.col-xs-5th-pull-4 {
  right: 80%;
}

.col-xs-5th-pull-3 {
  right: 60%;
}

.col-xs-5th-pull-2 {
  right: 40%;
}

.col-xs-5th-pull-1 {
  right: 20%;
}

.col-xs-5th-pull-0 {
  right: auto;
}

.col-xs-5th-push-5 {
  left: 100%;
}

.col-xs-5th-push-4 {
  left: 80%;
}

.col-xs-5th-push-3 {
  left: 60%;
}

.col-xs-5th-push-2 {
  left: 40%;
}

.col-xs-5th-push-1 {
  left: 20%;
}

.col-xs-5th-push-0 {
  left: auto;
}

.col-xs-5th-offset-5 {
  margin-left: 100%;
}

.col-xs-5th-offset-4 {
  margin-left: 80%;
}

.col-xs-5th-offset-3 {
  margin-left: 60%;
}

.col-xs-5th-offset-2 {
  margin-left: 40%;
}

.col-xs-5th-offset-1 {
  margin-left: 20%;
}

.col-xs-5th-offset-0 {
  margin-left: 0%;
}

@media (min-width: 768px) {
  .col-sm-5th-1, .col-sm-5th-2, .col-sm-5th-3, .col-sm-5th-4 {
    float: left;
  }

  .col-sm-5th-5 {
    float: left;
    width: 100%;
  }

  .col-sm-5th-4 {
    width: 80%;
  }

  .col-sm-5th-3 {
    width: 60%;
  }

  .col-sm-5th-2 {
    width: 40%;
  }

  .col-sm-5th-1 {
    width: 20%;
  }

  .col-sm-5th-pull-5 {
    right: 100%;
  }

  .col-sm-5th-pull-4 {
    right: 80%;
  }

  .col-sm-5th-pull-3 {
    right: 60%;
  }

  .col-sm-5th-pull-2 {
    right: 40%;
  }

  .col-sm-5th-pull-1 {
    right: 20%;
  }

  .col-sm-5th-pull-0 {
    right: auto;
  }

  .col-sm-5th-push-5 {
    left: 100%;
  }

  .col-sm-5th-push-4 {
    left: 80%;
  }

  .col-sm-5th-push-3 {
    left: 60%;
  }

  .col-sm-5th-push-2 {
    left: 40%;
  }

  .col-sm-5th-push-1 {
    left: 20%;
  }

  .col-sm-5th-push-0 {
    left: auto;
  }

  .col-sm-5th-offset-5 {
    margin-left: 100%;
  }

  .col-sm-5th-offset-4 {
    margin-left: 80%;
  }

  .col-sm-5th-offset-3 {
    margin-left: 60%;
  }

  .col-sm-5th-offset-2 {
    margin-left: 40%;
  }

  .col-sm-5th-offset-1 {
    margin-left: 20%;
  }

  .col-sm-5th-offset-0 {
    margin-left: 0%;
  }
}
@media (min-width: 992px) {
  .col-md-5th-1, .col-md-5th-2, .col-md-5th-3, .col-md-5th-4 {
    float: left;
  }

  .col-md-5th-5 {
    float: left;
    width: 100%;
  }

  .col-md-5th-4 {
    width: 80%;
  }

  .col-md-5th-3 {
    width: 60%;
  }

  .col-md-5th-2 {
    width: 40%;
  }

  .col-md-5th-1 {
    width: 20%;
  }

  .col-md-5th-pull-5 {
    right: 100%;
  }

  .col-md-5th-pull-4 {
    right: 80%;
  }

  .col-md-5th-pull-3 {
    right: 60%;
  }

  .col-md-5th-pull-2 {
    right: 40%;
  }

  .col-md-5th-pull-1 {
    right: 20%;
  }

  .col-md-5th-pull-0 {
    right: auto;
  }

  .col-md-5th-push-5 {
    left: 100%;
  }

  .col-md-5th-push-4 {
    left: 80%;
  }

  .col-md-5th-push-3 {
    left: 60%;
  }

  .col-md-5th-push-2 {
    left: 40%;
  }

  .col-md-5th-push-1 {
    left: 20%;
  }

  .col-md-5th-push-0 {
    left: auto;
  }

  .col-md-5th-offset-5 {
    margin-left: 100%;
  }

  .col-md-5th-offset-4 {
    margin-left: 80%;
  }

  .col-md-5th-offset-3 {
    margin-left: 60%;
  }

  .col-md-5th-offset-2 {
    margin-left: 40%;
  }

  .col-md-5th-offset-1 {
    margin-left: 20%;
  }

  .col-md-5th-offset-0 {
    margin-left: 0%;
  }
}
@media (min-width: 1200px) {
  .col-lg-5th-1, .col-lg-5th-2, .col-lg-5th-3, .col-lg-5th-4 {
    float: left;
  }

  .col-lg-5th-5 {
    float: left;
    width: 100%;
  }

  .col-lg-5th-4 {
    width: 80%;
  }

  .col-lg-5th-3 {
    width: 60%;
  }

  .col-lg-5th-2 {
    width: 40%;
  }

  .col-lg-5th-1 {
    width: 20%;
  }

  .col-lg-5th-pull-5 {
    right: 100%;
  }

  .col-lg-5th-pull-4 {
    right: 80%;
  }

  .col-lg-5th-pull-3 {
    right: 60%;
  }

  .col-lg-5th-pull-2 {
    right: 40%;
  }

  .col-lg-5th-pull-1 {
    right: 20%;
  }

  .col-lg-5th-pull-0 {
    right: auto;
  }

  .col-lg-5th-push-5 {
    left: 100%;
  }

  .col-lg-5th-push-4 {
    left: 80%;
  }

  .col-lg-5th-push-3 {
    left: 60%;
  }

  .col-lg-5th-push-2 {
    left: 40%;
  }

  .col-lg-5th-push-1 {
    left: 20%;
  }

  .col-lg-5th-push-0 {
    left: auto;
  }

  .col-lg-5th-offset-5 {
    margin-left: 100%;
  }

  .col-lg-5th-offset-4 {
    margin-left: 80%;
  }

  .col-lg-5th-offset-3 {
    margin-left: 60%;
  }

  .col-lg-5th-offset-2 {
    margin-left: 40%;
  }

  .col-lg-5th-offset-1 {
    margin-left: 20%;
  }

  .col-lg-5th-offset-0 {
    margin-left: 0%;
  }
}
</style>




