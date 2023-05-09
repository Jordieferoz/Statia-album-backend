    </main>
    <footer>
      <div class="container">
        <p class="paragraph2 border-top">© <?= date("Y") ?> Statia-tourism. All Rights
          Reserved.</p>
      </div>
    </footer>
  </body>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha256-m81NDyncZVbr7v9E6qCWXwx/cwjuWDlHCMzi9pjMobA="
    crossorigin="anonymous"></script>
  <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
  <script>


  function hasClass(ele, cls) {
    return !!ele.className.match(new RegExp('(\\s|^)' + cls + '(\\s|$)'));
  }
  function addClass(ele, cls) {
    if (!hasClass(ele, cls)) ele.className += " " + cls;
  }
  function removeClass(ele, cls) {
    if (hasClass(ele, cls)) {
      var reg = new RegExp('(\\s|^)' + cls + '(\\s|$)');
      ele.className = ele.className.replace(reg, ' ');
    }
  }
  function init() {
    document.getElementById("open-sidebar").addEventListener("click", toggleMenu);
    document.getElementById("sidebar-overlay").addEventListener("click", toggleMenu);
    document.getElementById("sidebar-close-icon").addEventListener("click", toggleMenu);
  }
  function toggleMenu() {
    var ele = document.getElementsByTagName('body')[0];

    if (!hasClass(ele, "sidebar-menu-open")) {
      addClass(ele, "sidebar-menu-open"); s
    } else {
      removeClass(ele, "sidebar-menu-open");
    }
  }
  document.addEventListener('readystatechange', function () {
    if (document.readyState === "complete") {
      init();
    }
  });
  var elem = document.querySelector('.grid');
  var masonry = new Masonry(elem, {
    itemSelector: '.grid-item',
    columnWidth: 200,
  });
  var masonry = new Masonry('.grid.odd-row', {
    cols: 2
  });
  var masonry = new Masonry('.grid.even-row', {
    cols: 3
  });
</script>

</html>