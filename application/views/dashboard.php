
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
  

</head>
<body>

<style>

input {
  width: 40%;
  padding-right: 40px;
  margin-bottom: 19px;
}

button {
  width: 100px;
  position: absolute;
  
}
.float-container {
    border: 3px solid #fff;
    padding: 20px;
}

.float-child {
    width: 50%;
    float: left;
    padding: 20px;
    border: 2px solid red;
}  
</style>

<div class="container-fluid" style="background: powderblue;">
  <h1>Enter Url</h1>

  <input type="text" autocomplete="false" name="search-str" id="urlData" placeholder="Ex.https://www.google.com" value=""/>
      <button id="submitUrl" clss="btn  btn-info" >Submit</button>

      <div class="card" id="card" style="    background-color: #e5e4e4;width: 25rem;margin-bottom:44px;float: right;margin-right: 31px;margin-top: -34px;">
        <img src="..." id="image" class="card-img-top" style="    width: 253px;
          height: 99px;" alt="...">
        <div class="card-body" id="card-body" >
          <h5 class="card-title" id="title">Card title</h5>
          <p class="card-text" id="description">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          <button id="saveBtn" clss="btn  btn-info" style="background-color: #2591ff;margin-top:24px" >Save</button>
        </div>
</div>

</div>
<table id="dTable" class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
    </tr>
  </thead>
  <tbody id="tBody">
  <?php
 foreach($data as $key){ ?>
    <tr>
      <th scope="col"><?= $key->s_id?></th>
      <th scope="col"><img src='<?= $key->image_url?>' alt="" height=30 width=30></img></th>
      <th scope="col"><?= $key->title?></th>
      <th scope="col"><?= $key->description?></th>
    </tr>
   
<?php }?>
  </tbody>
</table>

</body>
</html>


<script>

$(document).ready(function() {
    var table=$('#dTable').DataTable();
} );

    $('#submitUrl').click(function(){
       var urlData= $('#urlData').val();
        $.ajax({
            type: "POST",
            url: 'test/getCard',
            data:{
                urlData:urlData 
            },
            
            success: function(data) {
                data=JSON.parse(data);
                
                $('#title').text(data.title);
                $('#description').text(data.description);
                $('#image').attr('src',data.imageUrl)
            }
        });
    })
    $('#saveBtn').click(function(){
       var title= $('#title').text();
       var description= $('#description').text();
       var image= $('#image').attr('src');

        $.ajax({
            type: "POST",
            url: 'test/dbInsert',
            data:{
              title:title,
              description:description,
              image:image
            },
            
            success: function(data) {
                data=JSON.parse(data);
                $('#tBody').empty(); 

                $('#dTable').DataTable().destroy();
 
                $('tBody').html(data);
                $('#dTable').DataTable();

            }
        });
       
      
    })
</script>