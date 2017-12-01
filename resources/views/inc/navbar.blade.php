<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/">ChatBot</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="{{Request::is('/') ? 'active' : ''}}"><a href="/">Home</a></li>
      <li class="{{Request::is('about') ? 'active' : ''}}"><a href="/about">About</a></li>
      <li class="{{Request::is('contact') ? 'active' : ''}}"><a href="/contact">Contact</a></li>
      <li class="{{Request::is('messages') ? 'active' : ''}}"><a href="/messages">Messages</a></li>
    </ul>
  </div>
</nav>