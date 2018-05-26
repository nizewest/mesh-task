<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Mesh Task</title>
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
<div id="app">
  <section class="section">
    <div class="container">
      <div class="columns">
        <div class="column is-one-quarter">
          <aside class="menu">
            <p class="menu-label" v-html="categories.length ? 'Категории товаров' : 'Загрузка...'"></p>
            <categories :categories="categories"></categories>
          </aside>
        </div>
        <div class="column">
          <router-view></router-view>
        </div>
      </div>
    </div>
  </section>
</div>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>