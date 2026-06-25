/* みつくる LP — interactions */
(function () {
  'use strict';

  /* ---- ヘッダー：ハンバーガーメニュー開閉 ---- */
  (function () {
    var header = document.querySelector('.site-header');
    var toggle = document.querySelector('.nav-toggle');
    var nav = document.getElementById('primary-nav');
    if (!header || !toggle || !nav) return;

    function setOpen(open) {
      header.classList.toggle('is-nav-open', open);
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
      toggle.setAttribute('aria-label', open ? 'メニューを閉じる' : 'メニューを開く');
    }

    toggle.addEventListener('click', function () {
      setOpen(!header.classList.contains('is-nav-open'));
    });

    // ナビ内リンクをタップしたら閉じる
    nav.addEventListener('click', function (e) {
      if (e.target.closest('a')) setOpen(false);
    });

    // Escで閉じる
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') setOpen(false);
    });

    // タブレット幅以上に戻ったら状態リセット
    window.matchMedia('(min-width: 768px)').addEventListener('change', function (e) {
      if (e.matches) setOpen(false);
    });
  })();

  /* ---- FAQ：アコーディオン（JSで開閉） ---- */
  (function () {
    var items = document.querySelectorAll('.faq__item');
    if (!items.length) return;

    items.forEach(function (item) {
      var btn = item.querySelector('.faq__q');
      if (!btn) return;
      btn.addEventListener('click', function () {
        var open = item.classList.contains('is-open');
        // 1つずつ開く（手風琴）。複数同時に開きたい場合はこのループを外す
        items.forEach(function (other) {
          if (other !== item) {
            other.classList.remove('is-open');
            var b = other.querySelector('.faq__q');
            if (b) b.setAttribute('aria-expanded', 'false');
          }
        });
        item.classList.toggle('is-open', !open);
        btn.setAttribute('aria-expanded', open ? 'false' : 'true');
      });
    });
  })();

  /* ---- スクロールで各セクションを淡くフェードアップ ---- */
  (function () {
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var targets = document.querySelectorAll('.section');
    if (reduce || !('IntersectionObserver' in window) || !targets.length) return;

    targets.forEach(function (el) { el.classList.add('reveal'); });
    var obs = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (en.isIntersecting) {
          en.target.classList.add('is-in');
          obs.unobserve(en.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -8% 0px' });

    targets.forEach(function (el) { obs.observe(el); });
  })();
})();
