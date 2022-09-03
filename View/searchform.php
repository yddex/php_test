<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel='stylesheet' href='/View/style/style.css' media='all'>
    <title>Search Form</title>
</head>
<body>


  <form class="search__form" action="/">
        <input class="search__input" name="search" type="text" minlength=3 placeholder="Найти в комментариях..." autocomplete="off"/>
        <button class="search__submit" type="submit">Найти</button>
  </form>

  
    <p class="alert"></p>
  


 
    <section class="found">        
    </section>



   <script src="./View/scripts/searchform.js"></script>

</body>
</html>