/* みつくる LP — interactions */
(function () {
  "use strict";

  /* ---- ヘッダー：ハンバーガーメニュー開閉 ---- */
  (function () {
    var header = document.querySelector(".site-header");
    var toggle = document.querySelector(".nav-toggle");
    var nav = document.getElementById("primary-nav");
    if (!header || !toggle || !nav) return;

    function setOpen(open) {
      header.classList.toggle("is-nav-open", open);
      toggle.setAttribute("aria-expanded", open ? "true" : "false");
      toggle.setAttribute("aria-label", open ? "メニューを閉じる" : "メニューを開く");
    }

    toggle.addEventListener("click", function () {
      setOpen(!header.classList.contains("is-nav-open"));
    });

    // ナビ内リンクをタップしたら閉じる
    nav.addEventListener("click", function (e) {
      if (e.target.closest("a")) setOpen(false);
    });

    // Escで閉じる
    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape") setOpen(false);
    });

    // タブレット幅以上に戻ったら状態リセット
    window.matchMedia("(min-width: 768px)").addEventListener("change", function (e) {
      if (e.matches) setOpen(false);
    });
  })();

  /* ---- FAQ：アコーディオン（JSで開閉） ---- */
  (function () {
    var items = document.querySelectorAll(".faq__item");
    if (!items.length) return;

    items.forEach(function (item) {
      var btn = item.querySelector(".faq__q");
      if (!btn) return;
      btn.addEventListener("click", function () {
        var open = item.classList.contains("is-open");
        // 1つずつ開く（手風琴）。複数同時に開きたい場合はこのループを外す
        items.forEach(function (other) {
          if (other !== item) {
            other.classList.remove("is-open");
            var b = other.querySelector(".faq__q");
            if (b) b.setAttribute("aria-expanded", "false");
          }
        });
        item.classList.toggle("is-open", !open);
        btn.setAttribute("aria-expanded", open ? "false" : "true");
      });
    });
  })();

  /* ---- スクロールで各セクションを淡くフェードアップ ---- */
  (function () {
    var reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    var targets = document.querySelectorAll(".section");
    if (reduce || !("IntersectionObserver" in window) || !targets.length) return;

    targets.forEach(function (el) {
      el.classList.add("reveal");
    });
    var obs = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (en) {
          if (en.isIntersecting) {
            en.target.classList.add("is-in");
            obs.unobserve(en.target);
          }
        });
      },
      { threshold: 0.12, rootMargin: "0px 0px -8% 0px" },
    );

    targets.forEach(function (el) {
      obs.observe(el);
    });
  })();

  /* ---- サブタイトルの‐削除 ---- */
  (function () {
    document.addEventListener("DOMContentLoaded", () => {
      const el = document.querySelector(".c-pageTitle__subTitle");

      if (el) {
        el.textContent = el.textContent.replace(/^–\s*/, "").replace(/\s*–$/, "");
      }
    });
  })();
})();

/* ============ 下層ページ共通：gnav ハンバーガー＆style-hover ============ */
(function () {
  "use strict";

  /* gnav ハンバーガー開閉（モバイル） */
  var burger = document.querySelector(".gnav-burger");
  var panel = document.querySelector(".gnav-mobile");
  if (burger && panel) {
    function setOpen(open) {
      burger.setAttribute("aria-expanded", open ? "true" : "false");
      panel.classList.toggle("is-open", open);
    }
    burger.addEventListener("click", function () {
      setOpen(burger.getAttribute("aria-expanded") !== "true");
    });
    panel.addEventListener("click", function (e) {
      if (e.target.closest("a")) setOpen(false);
    });
    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape") setOpen(false);
    });
    window.matchMedia("(min-width: 1025px)").addEventListener("change", function (e) {
      if (e.matches) setOpen(false);
    });
  }

  /* style-hover 属性 → ホバー時にインラインスタイルを合成（dc-runtime の挙動を再現） */
  var hoverEls = document.querySelectorAll("[style-hover]");
  hoverEls.forEach(function (el) {
    var hover = el.getAttribute("style-hover");
    if (!hover) return;
    var base = el.getAttribute("style") || "";
    var joined = base && !/;\s*$/.test(base) ? base + "; " + hover : base + hover;
    el.addEventListener("mouseenter", function () {
      el.setAttribute("style", joined);
    });
    el.addEventListener("mouseleave", function () {
      el.setAttribute("style", base);
    });
    el.addEventListener(
      "focus",
      function () {
        el.setAttribute("style", joined);
      },
      true,
    );
    el.addEventListener(
      "blur",
      function () {
        el.setAttribute("style", base);
      },
      true,
    );
  });
})();
