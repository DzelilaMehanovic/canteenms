$(document).ready(function() {

  $("main#spapp > section").height($(document).height() - 60);

  var app = $.spapp({pageNotFound : 'error_404'}); // initialize

  // define routes
  app.route({
    view: 'home',
    load: 'home.html'
  });

  app.route({
    view: 'menu',
    load: 'menu.html'
  });

  app.route({
    view: 'checkout',
    load: 'checkout.html'
  });

  app.route({
    view: 'employee',
    load: 'employee.html'
  });

  app.route({
    view: 'admin',
    load: 'admin.html'
  });

  app.route({
    view: 'login',
    load: 'login.html'
  });

  app.route({
    view: 'orders',
    load: 'orders.html'
  });

  app.route({
    view: 'statistics',
    load: 'statistics.html'
  });

  app.route({
    view: 'history',
    load: 'history.html'
  });

  app.route({
    view: 'logout',
    load: 'logout.html'
  });


  // run app
  app.run();

});
