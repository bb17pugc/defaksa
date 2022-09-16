


<!DOCTYPE html>
<html>
<head>
<title>{{$rastuarant->name}}</title>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<style>
body
{
    background-image:url('/{{$links->features["selected"]}}');
    background-size:cover;
    background-color:{{$links->features["selected"]}};
    color:white;

}
.logo img
{
    width: 150px;
    height: 150px;
    border-radius: 400px;
    padding: {{!isset($links->features["switch_frame_color"]) ? '0px' : ($links->features["switch_frame_color"] == 'on'?'5px' : '0px')   }} ;
    background-color: {{!isset($links->features["frame_color"]) ? 'black' : $links->features["frame_color"]}};
}
.container
{
    padding:100px;
}
.container-links
{
    display:grid;
    text-align:center;
}
.container-links a
{
    padding: 10px;
    border: solid 2px #fbfbfb;
    margin: 10px;
    border-radius: 50px;
    color: white;
    font-size: 15px;
    background-color: {{!isset($links->features["link_color"]) ? 'black' : $links->features["link_color"]}};
}
.fa-share
{
    background-color: white;
    border: solid 1px #979797;
    font-size: 60px;
    padding: 10px;
    margin: 10px;
    border-radius: 10px;
    color: black;
    float: right;
}
</style>
</head>
<body>

<div class="col-md-12 col-sm-12 col-lg-4 offset-lg-4" >

<br>
<br>
<br>
<div class="logo text-center" >
    <img src="/{{$rastuarant->logo}}" alt="" class="logo" >
</div>
<div class="text-center lbl-link-restaurant-name" >
<label>
{{$rastuarant->name}}
</label>
</div>
<div class="container-links" >

    @if(count((array)json_decode($links->links)) > 0)
        @foreach(json_decode($links->links) as $index=>$item)
            <a href="{{$item[1]}}">{{$item[0]}}</a>
        @endforeach
    @endif
</div>

</div>

</body>
</html>

<script>

  $('#share-this-link').on('click', () => {
      var link = window.location.origin.split(".")[0].split("//")[1];
      alert(window.location.href)

  if (navigator.share) {
    navigator.share({
        title: 'Share this Menu',
        text: 'Take a look at this',
        url:  window.location.href.includes("?name=") == 0 ? window.location.href+"?name="+link : window.location.href ,
      })
      .then(() => console.log('Successful share'))
      .catch((error) => console.log('Error sharing', error));
  } else {
    console.log('Share not supported on this browser, do it the old way.');
  }
});
</script>
