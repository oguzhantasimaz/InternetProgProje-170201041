<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>

<div class="post">
<!--     
    <table style="margin-top: 15px;" class="table table-bordered table-hover">
  <thead class="thead-dark">
    <tr>
      <th style="color:gray; font-size:30px;" scope="col">Title</th>
      <th style="color:gray; font-size:30px;" scope="col">Content</th>
    </tr>
  </thead>
  <tbody>
    <tr>
     
      <td style="color:black; font-size:15px;"><?= Html::encode($model['title']) ?> </td>
      <td style="color:black; font-size:15px;"><?= Html::encode($model['content']) ?> </td>
    
    <tr>
  </tbody>
</table> -->
<ul class="post" >
        <li class="post" >
          <a class="post" href="#">
            <h1 class="post" ><?= Html::encode($model['title']) ?></h1>
            <p style="font-size: 24px;" class="post" ><?= Html::encode($model['content']) ?></p>
          </a>
        </li>
    
      </ul>
</div>

<style>


  u.post,li.post{
    list-style:none;
  }
  ul.post{
    
    padding:0em;
  }
  ul.post li.post a.post{
    text-decoration:none;
    color:#000;
    background:rgb(255, 200, 83);
    display:block;
    height:15em;
    width:15em;
    padding:1em;
  }
  ul.post li.post{
    margin:1em;
    float:left;
  }
      </style>