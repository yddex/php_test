<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel='stylesheet' href='/View/style.css' media='all'>
    <title>Search Form</title>
</head>
<body>


  <form class="search__form" action="/">
        <input class="search__input" name="search" type="text" minlength=3 placeholder="Найти в комментариях..."/>
        <button class="search__submit" type="submit">Найти</button>
  </form>

  <?php if($error!==null): ?>
    <p class="error">
        <?php echo $error; ?>
    </p>
  <?php endif; ?>
  

  <?php if($notfound): ?>
    <h3 class="error">
        По данному запросу ничего не найдено!
    </h3>
  <?php endif; ?>


  <?php if(count($response)>0): ?>
    <section class="found">
    <?php foreach($response as $key => $found): ?>
            <div class="found__post">
                <h2 class="found__post_title">
                   Запись № <?php echo $key; ?>
                </h2>
                <h2 class="found__post_title">
                   Заголовок: <?php echo $found["post_title"]; ?>
                </h2>
                <div class="found__comments">
                    <h3 class="comments__heading">
                        Найденные комментарии:
                    </h3>
                    <?php foreach($found["comments"] as $comment): ?>
                        <div class="found__comment">
                            <h4 class="found__comment_id">
                               Комментарий № <?php echo $comment["id"] ?>
                            </h4>
                            <p class="found__comment_name">
                                <b>Название:</b>  <?php echo $comment["name"] ?>
                            </p>
                            <p class="found__comment_email">
                                <b>Email:</b>  <?php echo $comment["email"] ?>
                            </p>
                            <p class="found__comment_body">
                               <b>Текст:</b> <?php echo $comment["body"] ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </section>

  <?php endif; ?>


</body>
</html>